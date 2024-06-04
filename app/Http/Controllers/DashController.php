<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index(){
        $revController = new ReviewController();
        return view('dashboard',[
            'reviewsNumber' => $revController->countUserReviews(),
            'userAvg' => $revController->averageUserRating()
        ]);
    }
    public function myReviews(){
        $revController = new ReviewController();
        return view('myreviews',[
            'reviews' => $revController->getUserReviews()
        ]);
    }
    public function about(){
        return view('about');
    }

}
