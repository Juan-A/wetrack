<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Track;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Creativeorange\Gravatar\Facades\Gravatar as FacadesGravatar;
use Creativeorange\Gravatar\Gravatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $avg = null;
        $total = null;
        $usrReview = null;
        $spotifyController = new SpotifyController();
        $id = $request->route('track');
        $reviews = Review::with('user')->where('spotify_id','=',$id);
        $usrReview = Review::with('user')->where('spotify_id','=',$id)->where('user_id','=',Auth::id())->first();
        $rews = $reviews->get();
        if($reviews->exists()){
            $total = $rews->count();
            $sum = 0.0;
            foreach ($rews as $review) {
                $sum += $review['calification'];
            }
            $avg = $sum/$total;

        }
        //$avatars = FacadesGravatar::get('juan13herrero@gmail.com');
        //return print_r($rews);
        $avatars =[];
        foreach ($rews as $rewUser) {
            $avatarUrl = FacadesGravatar::get($rewUser->user->email);
            $avatars[$rewUser->user->id] = $avatarUrl;
        };
        

        return view('track.index',[
            'track' => $spotifyController->getTrack($id,Auth::check()),
            'avg' => $avg,
            'total' => $total,
            'avatars' => $avatars,
            'reviews' => $rews,
            'usrReview' => $usrReview
        ]);

        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function add(Track $track, Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Track $track)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        //
    }
}
