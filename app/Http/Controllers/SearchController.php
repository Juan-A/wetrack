<?php

namespace App\Http\Controllers;

use Exception;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = "";
        $page = 1;
        $searching = false;
        $results = null;
        if ($request->input('page')) {
            $page = (intval($request->input('page')) == 0) ? 1 : intval($request->input('page'));
        }
        if ($request->input('query')) {
            $query = $request->input('query');
            $searching = true;
            if (Auth()->check()) {
                $spotifyController = new SpotifyController();
                $results = $spotifyController->search($query, true, $page);
            } else {
                $spotifyController = new SpotifyController();
                $results = $spotifyController->search($query, false, $page);
            }
        }
         return view('search.index', [
            'query' => $query,
            'searching' => $searching,
            'results' => $results,
            'page'  => $page

        ]); 
    }
}
