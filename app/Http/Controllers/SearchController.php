<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request):View{
        $query = "";
        $searching = false;
        $results = null;
        if($request->input('query')){
            $query = $request->input('query');
            $searching = true;
            if(Auth()->check()){
                $spotifyController = new SpotifyController();
                $results = $spotifyController->search($query,true);
            }else{
                $spotifyController = new SpotifyController();
                $results = $spotifyController->search($query,false);
            }
        }

        return view('search.index', [
            'query' => $query,
            'searching' => $searching,
            'results' => $results

        ]);
    }

}
