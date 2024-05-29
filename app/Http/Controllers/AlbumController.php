<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function show(Request $request){
        $spotifyController = new SpotifyController();
        $id = $request->route('album');
        return view('album.index',[
            'album' => $spotifyController->getAlbum($id,Auth::check()),
            'tracks' => $spotifyController->getAlbumTracks($id,Auth::check())
        ]);
    }
}
