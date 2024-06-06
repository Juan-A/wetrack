<?php

use Illuminate\Support\Str;

return [
    'clientId' => env('SPOTIFY_CLIENT_ID'),
    'clientSecret' => env('SPOTIFY_CLIENT_SECRET'),
    'resultsPerPage' => env('PER_PAGE_RESULTS'),
    'trendsNumber' => env("TRENDS_NUMBER"),
    'topCommentedNumber' => env("TOP_COMMENTED_NUMBER"),
    'topRatedMax' => env('TOP_RATED_MAX_NUMBER'),
    'perPageMy' => env('PER_PAGE_MYREVIEWS'),
];
