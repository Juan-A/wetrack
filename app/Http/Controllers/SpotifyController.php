<?php

namespace App\Http\Controllers;

use App\Models\SpotifyToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SpotifyController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $redirectUri = 'http://localhost:8000/spotifyAuthorize';

    public function __construct()
    {
        $this->clientId = config('spotify.clientId');
        $this->clientSecret = config('spotify.clientSecret');
    }

    public function login()
    {
        $scopes = 'user-read-private user-read-email';
        return redirect(
            'https://accounts.spotify.com/authorize' .
                '?response_type=code' .
                '&client_id=' . $this->clientId .
                ($scopes ? '&scope=' . urlencode($scopes) : '') .
                '&redirect_uri=' . urlencode($this->redirectUri)
        );
    }
    public function authorize()
    {
        $code = $_GET['code'];

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)
        ])->asForm()
            ->post('https://accounts.spotify.com/api/token', [
                'code' => trim($code),
                'redirect_uri' => $this->redirectUri,
                'grant_type' => 'authorization_code',
            ]);
        json_decode($response, true); //Contains refresh and access tokens.

        //User Data
        $acc_token = json_decode($response, true)['access_token'];
        $refresh_token = json_decode($response, true)['refresh_token'];

        $profile = Http::withHeaders([
            'Authorization' => 'Bearer ' . $acc_token
        ])
            ->get('https://api.spotify.com/v1/me');
        $json = json_decode($profile,true);
        $email = $json['email'];
        $name = $json['display_name'];
        
        if(!User::where('email',$email)->exists()){
            $newUser =User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make(Str::password(16, true, true, false, false)),
            ]);
            Auth::login($newUser);
        }

        SpotifyToken::create([
            'authToken' => $acc_token,
            'refreshToken' => $refresh_token,
            'user' => User::where('email',$email)->first()->id
        ]);
        return redirect(route('spotify.profile'));
    }


    public function refreshToken()
    {
        $user = User::find(Auth::user()->id)->with('spotify')->first();
        $spotify = $user->spotify;
        if(Carbon::parse($spotify->updated_at)->diffInMinutes() > 59){
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                'Content-Type'=> 'application/x-www-form-urlencoded'
            ])->asForm()
                ->post('https://accounts.spotify.com/api/token', [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => trim($spotify->refreshToken),
                ]);
                $acc_token = json_decode($response, true)['access_token'];
                $spotify->update([
                    'authToken' => $acc_token,
                    'refreshToken' => $spotify->refreshToken,
                ]);
        }
        
        return $user;
    }
    public function getUser()
    {
        $user = $this->refreshToken();
        $spotify = $user->spotify;


        $profile = Http::withHeaders([
            'Authorization' => 'Bearer ' . $spotify->authToken,
        ])
            ->get('https://api.spotify.com/v1/me');

        return view('spotifyProfile')->with(['profile' => $profile->json()]);
    }
}
