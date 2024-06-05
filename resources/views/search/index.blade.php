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
        class="bg-gradient-to-b from-slate-50 via-amber-300 to-red-400 dark:from-slate-900 dark:via-amber-800 dark:to-red-900 min-h-full flex flex-col pb-5">
        @include('layouts.navigation')
        <div class="w-full flex justify-center mt-10" id="searchContainer">
            <form action="{{ route('search.index') }}" method='GET' class=" w-1/2 rounded-lg"
                onsubmit="toggleSearchAnimation();">
                <label class="input input-bordered flex items-center gap-2">
                    <input name="query" type="text" class="grow dark:text-white" placeholder="Búsqueda"
                        @if ($searching) value=" {{ $query }} " @endif />
                    <a href="#"
                        class="-ml-14 sm:-ml-0 sm:bg-transparent rounded-lg sm:rounded-none appearance-none"
                        onclick="event.preventDefault(); this.closest('form').submit(); toggleSearchAnimation();">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 opacity-70 dark:fill-white">
                            <path fill-rule="evenodd"
                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </label>
            </form>

        </div>
        <div class="flex justify-center mt-4">
            <span id="loadingSearch" class="loading loading-dots loading-lg text-white hidden"></span>
        </div>
        @if ($searching)
            <div class="w-11/12 md:w-2/3 rounded-lg bg-white bg-opacity-40 mt-10 self-center">
                <div class="flex flex-wrap justify-center">
                    @foreach ($results['albums']['items'] as $item)
                        <div class="p-2 m-2 bg-white rounded-lg basis-1/4 md:basis-1/6 flex flex-col">

                            <a href="{{ route('album.show', $item['id']) }}" class="flex flex-col h-full">
                                <img src="{{ $item['images'][1]['url'] }}">
                                <span class="text-xs">
                                    <span class="font-extrabold">{{ $item['name'] }}</span>
                                </span>
                                <div class="mt-auto flex justify-center pt-2">
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
                        <a href="/track/{{ $item['id'] }}" class="">
                            <div class="p-2 m-3 bg-white rounded-lg flex items-center">
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
            <div class="flex w-2/3 self-center justify-between mt-5 mb-5">

                @if ($page != 1)
                    <form action="search" method="GET">
                        <input type="hidden" name="query" value="{{ $query }}">
                        <input type="hidden" name="page" value="{{ $page - 1 }}">
                        <button class="btn w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                            </svg>
                            <span class="mb-1 sm:mb-0">Página Anterior</span>
                        </button>
                    </form>
                @endif
                <form action="search" method="GET">
                    <input type="hidden" name="query" value="{{ $query }}">
                    <input type="hidden" name="page" value="{{ $page + 1 }}">
                    <button class="btn w-fit flex flex-wrap-reverse ml-1">
                        <span class="mb-1 sm:mb-0">Siguiente Página</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </form>
            </div>
        @endif
    </div>
    <script>
        function toggleSearchAnimation() {
            document.querySelector("#loadingSearch").classList.toggle('hidden')
        }
    </script>
</body>
@include('layouts.footer')
</html>
