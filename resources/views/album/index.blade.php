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
        class="bg-gradient-to-b from-slate-50 via-amber-300 to-red-400 dark:from-slate-700 dark:via-amber-700 dark:to-red-700 min-h-full flex flex-col">
        @include('layouts.navigation')
        <div class="card w-11/12 md:w-2/5 lg:w-3/5 lg:card-side bg-base-100 shadow-xl self-center mt-5">
            <figure><img class="w-full h-full" src="{{ $album['images'][1]['url'] }}" alt="Album" />
            </figure>
            <div class="card-body dark:text-slate-300">
                <h2 class="card-title">{{ $album['name'] }}</h2>
                <span>@php
                    $artistNumber = count($album['artists']);
                    $counter = 0;
                @endphp

                    @foreach ($album['artists'] as $artist)
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
                <span id="tracksNumber">
                    @if ($album['album_type'] == 'single')
                        {{ __('El álbum tiene 1 canción') }}
                    @else
                    {{ __('El álbum tiene ') }}{{ $album['total_tracks'] }}{{ __(' canciones.') }} 
                    @endif
                </span>
                <div class="flex items-center">
                </div>



                <div class="card-actions justify-end mt-auto">
                    <a class="btn" href="{{ $album['external_urls']['spotify'] }}">
                        Ver en Spotify
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-black dark:fill-slate-200" width="24"
                            height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;">
                            <path
                                d="M12.01 2.019c-5.495 0-9.991 4.496-9.991 9.991 0 5.494 4.496 9.99 9.991 9.99 5.494 0 9.99-4.496 9.99-9.99 0-5.495-4.446-9.991-9.99-9.991zm4.595 14.436c-.199.299-.549.4-.85.201-2.349-1.45-5.296-1.75-8.793-.951-.348.102-.648-.148-.748-.449-.101-.35.149-.648.45-.749 3.795-.85 7.093-.499 9.69 1.1.35.149.4.548.251.848zm1.2-2.747c-.251.349-.7.499-1.051.249-2.697-1.646-6.792-2.148-9.939-1.148-.398.101-.85-.1-.949-.498-.101-.402.1-.852.499-.952 3.646-1.098 8.143-.548 11.239 1.351.3.149.45.648.201.998zm.099-2.799c-3.197-1.897-8.542-2.097-11.59-1.146a.938.938 0 0 1-1.148-.6.937.937 0 0 1 .599-1.151c3.547-1.049 9.392-.85 13.089 1.351.449.249.599.849.349 1.298-.25.35-.849.498-1.299.248z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-11/12 lg:w-3/5 mt-5 shadow-lg card bg-base-300 rounded-box self-center flex flex-col">
            <h2 class="card-title ml-4 mt-4 dark:text-slate-200">Canciones del Álbum
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163Zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553Z" />
                  </svg>                  
            </h2>
@foreach ($tracks['items'] as $item)
<a href="/track/{{ $item['id'] }}" class="">
    <div class="p-2 m-3 bg-white rounded-lg flex items-center">
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
    </div>

</body>

</html>
