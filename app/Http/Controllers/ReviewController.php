<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Track;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Exists;

class ReviewController extends Controller
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
    public function create(Track $track, Request $request)
    {
    }
    public function getReviews($spotifyTrackId)
    {
        return Review::with('user')->where('spotify_id', '=', $spotifyTrackId);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->request->add([
            'spotify_id' => $request->route('track'),
        ]);
        $validated = $request->validate([
            'calification' => ['lte:5.0', 'gte:0.0', 'nullable'],
            'review' => ['max:500', 'nullable'],
            'spotify_id' => [],
        ]);
        if (Review::where('user_id', Auth::id())->where('spotify_id', $validated['spotify_id'])->exists()) {
            $old = Review::where('user_id', Auth::id())->where('spotify_id', $validated['spotify_id'])->first();
            Gate::authorize('update', $old);
            $old->update([
                'calification' => $validated['calification'],
                'review' => $validated['review']
            ]);
        } else {
            if (!Track::where('spotify_id', $validated['spotify_id'])->exists()) {
                $spotify = new SpotifyController();
                $track = $spotify->getTrack($validated['spotify_id'], Auth::check());
                $addTrack = [
                    'spotify_id' => $track['id'],
                    'name' => $track['name'],
                    'description' => null,
                ];
                Track::create($addTrack);
            }
            Review::create([
                'user_id' => Auth::id(),
                'spotify_id' => $validated['spotify_id'],
                'review' => $validated['review'],
                'calification' => $validated['calification']
            ]);
        }


        return redirect(route('track.show', $validated['spotify_id']));
    }
    public function topCommented()
    {
        return Review::selectRaw('spotify_id, COUNT(id) as number_of_reviews, calification')->with('track')
            ->groupBy('spotify_id')
            ->orderByDesc('number_of_reviews')
            ->limit(5)
            ->get();
    }
    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
