<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Exists;

class ReviewController extends Controller
{
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
            'calification' => ['lte:5.0', 'gte:0.5'],
            'review' => ['max:500', 'nullable'],
            'spotify_id' => [],
        ],[
            'calification.gte' => 'La calificación debe ser superior a 0.',
            'review.max' => 'La review puede tener como máximo 500 caracteres.'
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
                    'json' => $track,
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
        return Review::selectRaw('spotify_id, COUNT(id) as number_of_reviews, AVG(calification) as average_rating')->with('track')->groupBy('spotify_id')->orderByDesc('number_of_reviews')->limit(config('spotify.topCommentedNumber'))->get();
    }
    public function topRated()
    {
        return Review::selectRaw('spotify_id, COUNT(id) as number_of_reviews, AVG(calification) as average_rating')
            ->with('track')
            ->groupBy('spotify_id')
            ->orderByDesc('average_rating')
            ->limit(config('spotify.topRatedMax'))
            ->get();
    }
    public function getUserReviews()
    {
        $userId = Auth::id();
        $reviewsPerPage = config('spotify.perPageMy');

        return Review::with('track')->where('user_id', $userId)->orderBy('updated_at', 'desc')->paginate($reviewsPerPage);
    }

    public function countUserReviews()
    {
        $userId = Auth::id();

        return Review::where('user_id', $userId)->count();
    }
    public function averageUserRating()
    {
        $userId = Auth::id();

        $averageRating = Review::where('user_id', $userId)->avg('calification');

        return round($averageRating, 2);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review):RedirectResponse
    {
        Gate::authorize('delete',$review);
        $review->delete();
        return redirect()->back();
    }
}
