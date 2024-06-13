<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
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
        class="bg-gradient-to-b from-slate-50 via-amber-300 to-red-400 dark:from-slate-900 dark:via-amber-800 dark:to-red-900 min-h-full flex flex-col">
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
        <div class="flex justify-around flex-wrap items-start mt-20 ">
            <div id="trends"
                class="pt-5 pb-5 mb-10 bg-opacity-25 bg-slate-200 rounded-xl flex flex-col flex-wrap w-11/12 lg:w-1/4 h-full">
                <div class="flex ml-9">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <span class="text-xl ml-1 font-bold"> Últimas tendencias</span>
                </div>
                <div class="flex justify-around flex-wrap w-11/12 lg:w-11/12 self-center h-full">
                    <!--Tracks top-->
                    @foreach ($trends as $track)
                        <a href="{{ route('track.show', $track['id']) }}"
                            class="bg-slate-200 bg-opacity-15 p-2 rounded-lg m-2 lg:max-w-60 mr-1 w-2/5">
                            <div class="flex flex-col w-full">
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
                        </a>
                    @endforeach
                </div>
            </div>
            <div id="topCommented"
                class="pt-5 pb-5 mb-10 bg-opacity-25 bg-slate-200 rounded-xl flex flex-col flex-wrap w-11/12 lg:w-1/4">
                <div class="flex ml-9">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>
                    <span class="text-xl ml-1 font-bold"> Más comentadas</span>
                </div>
                <div class="flex justify-around flex-wrap w-11/12 lg:w-11/12">
                    <!--Tracks most commented-->
                    @foreach ($topCommented as $reviewed)
                        <a href="{{ route('track.show', $reviewed->track->spotify_id) }}"
                            class="bg-slate-200 bg-opacity-15 p-2 rounded-lg m-2 lg:max-w-60 mr-1 w-2/5">
                            <div class="flex flex-col w-full">
                                <div class="flex justify-center mt-3"><img
                                        src={{ $reviewed->track->json['album']['images'][1]['url'] }}
                                        class="w-full rounded-lg"></div>
                                <span class="font-bold text-lg">{{ $reviewed->track->name }}</span>
                                <span>
                                    Con una nota de {{ $reviewed->average_rating }}
                                </span>
                                <span> Basada en @if ($reviewed->number_of_reviews > 1)
                                        {{ $reviewed->number_of_reviews }} calificaciones.
                                    @else
                                        {{ $reviewed->number_of_reviews }} calificación.
                                    @endif

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div id="topRated"
                class="pt-5 pb-5 mb-10 bg-opacity-25 bg-slate-200 rounded-xl flex flex-col flex-wrap w-11/12 lg:w-1/4">
                <div class="flex ml-9">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    <span class="text-xl ml-1 font-bold"> Mejor Valoradas</span>
                </div>
                <div class="flex justify-around flex-wrap w-11/12 lg:w-11/12 self-center">
                    <!--Tracks Top Rated-->
                    @foreach ($topRated as $reviewed)
                        <a href="{{ route('track.show', $reviewed->track->spotify_id) }}"
                            class="bg-slate-200 bg-opacity-15 p-2 rounded-lg m-2 lg:max-w-60 mr-1 w-2/5">
                            <div class="flex flex-col w-full">
                                <div class="flex justify-center mt-3"><img
                                        src={{ $reviewed->track->json['album']['images'][1]['url'] }}
                                        class="w-full rounded-lg"></div>
                                <span class="font-bold text-lg">{{ $reviewed->track->name }}</span>
                                <span>
                                    Con una nota de {{ $reviewed->average_rating }}
                                </span>
                                <span> Basada en @if ($reviewed->number_of_reviews > 1)
                                        {{ $reviewed->number_of_reviews }} calificaciones.
                                    @else
                                        {{ $reviewed->number_of_reviews }} calificación.
                                    @endif

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')

</html>
