<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&display=swap" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    <style>
    </style>
</head>

<body class="font-sans antialiased  dark:text-slate-700 h-dvh">
    <div
        class="bg-gradient-to-b from-slate-50 via-amber-300 to-red-400 dark:from-slate-700 dark:via-amber-700 dark:to-red-700 min-h-full flex flex-col">
        <header>
            <!--Header Nav-->
            @include('layouts.navigation')
            <!--Hero Section-->

            <div class="flex items-center flex-col">
                <span class="text-6xl md:text-8xl font-bold text-center dark:text-gray-200 mt-10 font-hero">
                    Comparte la música
                </span>
                <span class="text-2xl font-thin dark:text-white font-hero">
                    ¡Opina, puntúa y descubre!
                </span>
            </div>
        </header>
        <div id="trends"
            class=" mt-24 pt-5 pb-5 mb-10 self-center bg-opacity-25 bg-slate-200 rounded-xl flex flex-col flex-wrap w-11/12 lg:w-2/5">
            <div class="flex ml-9">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                </svg>
                <span class="text-xl ml-1 font-bold"> Últimas tendencias</span>
            </div>
            <div class="flex justify-around flex-wrap w-11/12 lg:w-11/12 self-center">
                <!--Tracks-->
                @foreach ($trends as $track)
                    <div class="flex flex-col w-2/5 md:max-w-40 lg:max-w-44 mr-1">
                        <div class="flex justify-center mt-3"><img src={{ $track['image300'] }}
                                class="w-full rounded-lg"></div>
                        <span class="font-bold text-lg">{{ $track['name'] }}</span>
                        <span>
                            <ul class="">
                                @foreach ($track['artists'] as $artist)
                                    <li>{{ $artist['name'] }}</li>
                                @endforeach
                                <ul>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
