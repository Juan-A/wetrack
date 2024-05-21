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
                    <x-application-logo class="w-28" />
                </div>
                <div id="post-logo" class="w-1/4 text-right self-center">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end mr-3">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 bg-amber-700 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
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
        </header>
        <div class="w-full flex justify-center mt-10" id="searchContainer">
            <form action="{{ route('search.index') }}" method='GET'
                class="flex items-center bg-white w-4/6 rounded-lg">
                <input name="query" type="text" class="w-11/12 rounded-lg border-none"
                    placeholder="Buscar una canción..."
                    @if ($searching) value=" {{ $query }} " @endif>
                <div class="w-1/12 flex justify-center">
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </a>
                </div>
            </form>
        </div>
        @if ($searching)
            <div class="w-2/3 rounded-lg bg-white bg-opacity-40 mt-10 self-center">
                <div class="flex flex-wrap justify-center">
                    @foreach ($results['albums']['items'] as $item)
                            <div
                                class="p-2 m-3 bg-white rounded-lg  basis-1/4 lg:basis-1/6 flex flex-col justify-between">
                                <a href="#">
                                <img src="{{ $item['images'][1]['url'] }}">
                                <span class="text-xs">
                                    <span class="font-extrabold">{{ $item['name'] }}</span>
                                </span>
                                <div class="justify-self-end flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                    </svg>
                                </div>
                                </a>
                            </div>
                    @endforeach
                </div>
                <div class="#">
                    @foreach ($results['tracks']['items'] as $item)
                        <a href="" class="">
                            <div class="p-2 m-3 bg-white rounded-lg flex">
                                <img src="{{ $item['album']['images'][2]['url'] }}">
                                <div class="flex self-start ml-4">
                                    <span class="text-xs ">
                                        <span>
                                            <span class="font-extrabold">{{ $item['name'] }}</span>
                                            <ul>
                                                @foreach ($item['artists'] as $artist)
                                                    <li class="italic">{{ $artist['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </span>
                                    </span>
                                </div>
                                <div class="ml-auto flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163Zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553Z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>

</html>
