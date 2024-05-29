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
            <div class="flex justify-between sticky">
                <div id="pre-logo" class="w-1/4">
                    <h1>Test</h1>
                </div>
                <div id="logo" class="w-1/2 flex justify-center">
                    <x-application-logo />
                </div>
                <div id="post-logo" class="w-1/4 text-right self-center">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end mr-3">
                            @auth
                            <details class="dropdown dropdown-end mr-20 mt-2">
                                <summary class="m-1 btn w-0">
                                    <div class="avatar">
                                        <div class="w-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                            <img src="{{$myavatar}}" />
                                        </div>
                                    </div>
                                </summary>
                                <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52 text-white">
                                    <li><a href="{{ url('/dashboard') }}"
                                        class="bg-amber-700">Dashboard</a></li>                                        </ul>
                            </details>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 mr-4 bg-amber-700 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 bg-amber-700 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
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
            class=" mt-24 pt-5 pb-5 mb-10 self-center bg-opacity-25 bg-slate-200 rounded-xl flex flex-col flex-wrap w-11/12 lg:w-11/12">
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
