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
        class="bg-gradient-to-b from-slate-50 via-amber-300 to-red-400 dark:from-slate-900 dark:via-amber-800 dark:to-red-900
        min-h-full flex flex-col pb-5">
        @include('layouts.navigation')
        <div class="card w-11/12 md:w-2/5 lg:w-3/5 lg:card-side bg-base-100 shadow-xl self-center mt-5">
            <figure><img class="w-full h-full" src="{{ $track['album']['images'][1]['url'] }}" alt="Album" />
            </figure>
            <div class="card-body dark:text-slate-300">
                <h2 class="card-title">{{ $track['name'] }}</h2>
                <span>@php
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
                <span>
                    @php
                        $milliseconds = $track['duration_ms'];
                        $interval = \Carbon\CarbonInterval::milliseconds($milliseconds);
                        $formattedTime = $interval->cascade()->format('%I:%S');
                    @endphp
                    {{ $formattedTime }}
                </span>
                <span id="album">
                    <a class="link link-secondary" href="{{ route('album.show', $track['album']['id']) }}">
                        @if ($track['album']['album_type'] == 'single')
                            {{ __('Single') }}
                        @else
                            {{ __('Del álbum ') }} {{ $track['album']['name'] }}
                        @endif
                    </a>
                </span>
                <div class="flex items-center">
                    <div class="rating rating-lg rating-half">
                        <input type="radio" value="null" name="calification" class="rating-hidden " checked/>
                        @for ($i = 1; $i <= 10; $i++)
                            <input type="radio" name="final-rating"
                                class="bg-green-500 mask mask-star-2 {{ $i % 2 == 0 ? 'mask-half-2' : 'mask-half-1' }}"
                                {{ $i <= $avg * 2 ? 'checked' : '' }} disabled />
                        @endfor
                    </div>
                    <div class="flex items-center flex-grow">

                        <span class="basis-full sm:basis-1/2 ml-2">
                            @if ($avg != null)
                                Calificación de {{ $avg }} basada en
                                @if ($total > 1)
                                    {{ $total }} calificaciones.
                                @else
                                    {{ $total }} calificación.
                                @endif
                            @endif

                        </span>
                    </div>
                </div>

                <div class="card-actions justify-end mt-auto">
                    <a class="btn" href="{{ $track['external_urls']['spotify'] }}">
                        Escuchar en Spotify
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
            <h2 class="card-title ml-4 mt-4 dark:text-slate-200">Valora la Canción!
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163Zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553Z" />
                </svg>
            </h2>
            <form method="POST" class="flex flex-col" action="{{ route('track.addreview', $track['id']) }}">
                @csrf
                <input type="hidden" value="{{ $track['id'] }}" name="id">

                @can('update', $usrReview)
                    <div class="flex flex-wrap items-center ml-5 mt-5 mr-10">
                        <div class="rating rating-lg rating-half">
                            <input type="radio" value="null" name="calification" class="rating-hidden "
                                {{ $usrReview['calification'] == null ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-1  "
                                value="0.5" name="calification"
                                {{ $usrReview['calification'] == 0.5 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-2 "
                                value="1" name="calification"
                                {{ $usrReview['calification'] == 1 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-1 "
                                value="1.5" name="calification"
                                {{ $usrReview['calification'] == 1.5 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-2 "
                                value="2" name="calification"
                                {{ $usrReview['calification'] == 2 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-1 "
                                value="2.5" name="calification"
                                {{ $usrReview['calification'] == 2.5 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-2 "
                                value="3" name="calification"
                                {{ $usrReview['calification'] == 3 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-1 "
                                value="3.5" name="calification"
                                {{ $usrReview['calification'] == 3.5 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-2 "
                                value="4" name="calification"
                                {{ $usrReview['calification'] == 4 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-1 "
                                value="4.5" name="calification"
                                {{ $usrReview['calification'] == 4.5 ? 'checked' : '' }} />
                            <input type="radio" name="calification" class="bg-green-500 mask mask-star-2 mask-half-2 "
                                value="5" name="calification"
                                {{ $usrReview['calification'] == 5 ? 'checked' : '' }} />
                        </div>

                    </div>
                    <textarea name="review" placeholder="Da la nota!"
                        class="textarea textarea-bordered textarea-lg w-11/12 m-5 dark:text-slate-200">{{ $usrReview->review }}</textarea>
                @else
                    <div class="rating rating-md rating-half ml-5 mt-5 mr-10">
                        <input type="radio" value="0.0" name="calification" class="rating-hidden" checked />
                        <input type="radio" value="0.5" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-1" />
                        <input type="radio" value="1" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-2" />
                        <input type="radio" value="1.5" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-1" />
                        <input type="radio" value="2" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-2" />
                        <input type="radio" value="2.5" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-1" />
                        <input type="radio" value="3" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-2" />
                        <input type="radio" value="3.5" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-1" />
                        <input type="radio" value="4" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-2" />
                        <input type="radio" value="4.5" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-1" />
                        <input type="radio" value="5" name="calification"
                            class="bg-green-500 mask mask-star-2 mask-half-2" />
                    </div>
                    <x-input-error :messages="$errors->get('calification')" class="mt-2" />
                    <textarea name="review" placeholder="El saber es poder!"
                        class="textarea textarea-bordered textarea-lg w-11/12 m-5 dark:text-slate-200"></textarea>
                @endcan

                <button class="btn glass rounded-box">Publicar</button>
            </form>

        </div>
        <div class="w-11/12 lg:w-3/5 mt-5 shadow-lg card bg-base-300 rounded-box self-center flex flex-col">
            <h2 class="card-title ml-4 mt-4 dark:text-slate-200">¿Qué se comenta?
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                </svg>

            </h2>
            <div class="divider"></div>
            <div class="">
                @foreach ($reviews as $review)
                    <div class="chat chat-start ml-4 mb-4">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="t" src="{{ $avatars[$review->user->id] }}" />
                            </div>
                        </div>
                        <div class="chat-bubble text-slate-900 bg-slate-300 dark:bg-slate-800 dark:text-slate-300">
                            <div class="flex items-center">
                                <div class="rating rating-sm rating-half">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <input type="radio" name="rating-{{ $review->id }}"
                                            class="bg-green-500 mask mask-star-2 {{ $i % 2 == 0 ? 'mask-half-2' : 'mask-half-1' }}"
                                            {{ $i <= $review->calification * 2 ? 'checked' : '' }} disabled />
                                    @endfor
                                </div>

                                <span class="ml-1">{{ $review['user']['name'] }}</span>
                                @can('delete', $review)
                                        <button class="btn btn-circle btn-outline btn-sm mr-4 ml-5" x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-review-deletion')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                        <x-modal name="confirm-review-deletion" focusable>
                                            <form action="{{ route('review.delete', $review) }}" method="POST" class="p-6">
                                                @csrf
                                                @method('delete')
                                    
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('¿Seguro que quieres eliminar tu reseña?') }}
                                                </h2>
                                    
                                                <div class="mt-6 flex justify-end">
                                                    <button x-on:click.prevent="$dispatch('close')" onclick="event.preventDefault()"
                                                        class="btn btn-active btn-ghost dark:text-white">CANCELAR</button>
                                    
                                                    <button class="btn btn-error ml-4">ELIMINAR RESEÑA</button>
                                                </div>
                                            </form>
                                        </x-modal>
                                @endcan
                            </div>
                            {{ $review['review'] }}
                        </div>
                    </div>
            </div>
            @endforeach
        </div>

    </div>
    </div>

    @include('layouts.footer')
</body>

</html>
