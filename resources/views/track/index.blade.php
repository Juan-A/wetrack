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
                            <div>

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
                            </div>
                        </nav>
                    @endif
                </div>
            </div>
        </header>

        <div class="w-11/12 lg:w-3/5 rounded-lg bg-white bg-opacity-40 mt-10 self-center flex">
            <div class="p-4">
                <img src="{{ $track['album']['images'][1]['url'] }}" class="rounded-lg">
            </div>
            <div class="flex flex-col items-center basis-full">
                <span class="text-3xl font-bold mt-4 text-center">{{ $track['name'] }}</span>
                <span class="text-center mt-0">
                    @php
                        $artistNumber = count($track['artists']);
                        $counter = 0;
                    @endphp

                    @foreach ($track['artists'] as $artist)
                        De {{ $artist['name'] }}
                        @php
                            $counter++;
                        @endphp
                        @if ($counter < $artistNumber - 1)
                            ,
                        @elseif ($counter == $artistNumber - 1)
                            &amp;
                        @endif
                    @endforeach
                </span>
                <span class="italic mt-2">
                    @php
                        $milliseconds = $track['duration_ms'];
                        $interval = \Carbon\CarbonInterval::milliseconds($milliseconds);
                        $formattedTime = $interval->cascade()->format('%I:%S');
                    @endphp
                    {{ $formattedTime }}
                </span>
                <span id="album">
                    @if ($track['album']['album_type'] == 'single')
                        {{ __('Single') }}
                    @else
                        {{ __('Del álbum ') }} {{ $track['album']['name'] }}
                    @endif
                </span>
                <div class="rating rating-lg rating-half">
                    <input type="radio" name="rating-10" class="rating-hidden" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" checked />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" />
                    <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" />
                  </div>
            </div>




        </div>
    </div>
</body>

</html>
