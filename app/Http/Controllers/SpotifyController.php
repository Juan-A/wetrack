<?php

namespace App\Http\Controllers;

use App\Models\SpotifyToken;
use App\Models\User;
use Carbon\Carbon;
use Creativeorange\Gravatar\Facades\Gravatar as FacadesGravatar;
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
    public function landingPage()
    {
        $reviewsController = new ReviewController();
        $mostCommented= $reviewsController->topCommented();
        $topRated = $reviewsController->topRated();

        
        return view('welcome', [
            'trends' => $this->getGlobalTrends(),
            'topCommented' => $mostCommented,
            'topRated' => $topRated
        ]);
    }

    //Generic API functions
    private function getPubToken()
    {
        if (!SpotifyToken::find(1)->authToken) {
            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => "client_credentials",
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret
            ]);
            SpotifyToken::find(1)->update([
                'authToken' => json_decode($response, true)['access_token'],
            ]);
        } else if (Carbon::now()->diffInMinutes(SpotifyToken::find(1)->updated_at) * -1 >= 58) {
            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => "client_credentials",
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret
            ]);
            SpotifyToken::find(1)->update([
                'authToken' => json_decode($response, true)['access_token'],
            ]);
        }

        return SpotifyToken::find(1)->authToken;
    }
    public function getGlobalTrends()
    {
        $token = $this->getPubToken();
        $globalPlaylist = "https://api.spotify.com/v1/playlists/37i9dQZEVXbMDoHDwVN2tF";
        /*
        curl -X "GET" "https://api.spotify.com/v1/playlists/37i9dQZEVXbMDoHDwVN2tF" -H "Accept: application/json" -H 
        "Content-Type: application/json" -H "Authorization: Bearer XXX"
        */
        $songs = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])
            ->get($globalPlaylist);

        $tracks = [];
        $json = json_decode($songs, 1)['tracks']['items'];
        for ($i = 0; $i < config('spotify.trendsNumber'); $i++) {
            $tracks[$i]['image300'] = $json[$i]['track']['album']['images']['1']['url'];
            $tracks[$i]['image64'] = $json[$i]['track']['album']['images']['2']['url'];
            $tracks[$i]['name'] = $json[$i]['track']['name'];
            $tracks[$i]['artists'] = $json[$i]['track']['artists'];
            $tracks[$i]['uri'] = $json[$i]['track']['external_urls']['spotify'];
            $tracks[$i]['id'] = $json[$i]['track']['id'];
        }
        return $tracks;
    }
    public function search($query, $isAuth, $page)
{
    // Número de resultados por página desde la configuración
    $perPage = config('spotify.resultsPerPage');

    // Calcula el offset basado en la página actual
    $offset = ($page - 1) * $perPage;
    // Verifica si el usuario está autenticado y tiene un token de Spotify
    if ($isAuth && SpotifyToken::where('user', Auth::id())->exists()) {
        $user = $this->refreshToken();
        $spotify = $user->spotify;
        $token = $spotify->authToken;
    } else {
        // Obtén el token público si el usuario no está autenticado
        $token = $this->getPubToken();
    }
    
    // Codifica la consulta de búsqueda
    $query = urlencode($query);
    
    // Construye la URL de solicitud con los parámetros limit y offset
    $url = "https://api.spotify.com/v1/search?q=$query&type=album%2Ctrack&limit=$perPage&offset=$offset";
    
    // Realiza la solicitud a la API de Spotify
    $results = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ])->get($url);
    
    // Devuelve los resultados decodificados como un array
    return json_decode($results, true);
}
    public function getTrack($id, $isAuth)
    {
        if ($isAuth && SpotifyToken::where('user', Auth::id())->exists()) {
            $user = $this->refreshToken();
            $spotify = $user->spotify;
            $token = $spotify->authToken;
        } else {
            $token = $this->getPubToken();
        }
        $query = urlencode($id);
        $url = "https://api.spotify.com/v1/tracks/$query";

        return json_decode(Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])
            ->get($url), 1);
    }
    public function getAlbum($id, $isAuth)
    {
        if ($isAuth && SpotifyToken::where('user', Auth::id())->exists()) {
            $user = $this->refreshToken();
            $spotify = $user->spotify;
            $token = $spotify->authToken;
        } else {
            $token = $this->getPubToken();
        }
        $query = urlencode($id);
        $url = "https://api.spotify.com/v1/albums/$query";
        return json_decode(Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])
            ->get($url), 1);
    }
    public function getAlbumTracks($id, $isAuth)
    {
        if ($isAuth && SpotifyToken::where('user', Auth::id())->exists()) {
            $user = $this->refreshToken();
            $spotify = $user->spotify;
            $token = $spotify->authToken;
        } else {
            $token = $this->getPubToken();
        }
        $query = urlencode($id);
        $url = "https://api.spotify.com/v1/albums/$query/tracks";
        return json_decode(Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])
            ->get($url), 1);
    }

    //User releated functions.
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
        $json = json_decode($profile, true);
        $email = $json['email'];
        $name = $json['display_name'];

        if (!User::where('email', $email)->exists()) {
            $newUser = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make(Str::password(16, true, true, false, false)),
            ]);
            Auth::login($newUser);
        }
        Auth::login(User::where('email', $email)->first());

        SpotifyToken::create([
            'authToken' => $acc_token,
            'refreshToken' => $refresh_token,
            'user' => User::where('email', $email)->first()->id
        ]);
        return redirect(route('landingPage'));
    }


    public function refreshToken()
    {
        $user = User::with('spotify')->find(Auth::user()->id);
        $spotify = $user->spotify;
        if (Carbon::parse($spotify->updated_at)->diffInMinutes() > 59) {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                'Content-Type' => 'application/x-www-form-urlencoded'
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
