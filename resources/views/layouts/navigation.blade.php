<header>
    <x-laravel-cookies-consent></x-laravel-cookies-consent>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <!--Header Nav-->
    <div class="flex justify-between">

        <div id="pre-logo" class="w-1/4 flex items-center">

            <details class="dropdown ml-20 md:hidden">
                <!-- Added 'md:hidden' class to hide on medium and larger screens -->
                <summary class="m-1 btn btn-circle btn-outline"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg></summary>
                <ul class="shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-80">
                    <li class="w-full">
                        <form action="{{ route('search.index') }}" method='GET' class="flex w-full rounded-lg">
                            <label class="input input-bordered flex items-center gap-2 flex-grow">
                                <input name="query" type="text" class="w-full dark:text-white"
                                    placeholder="Busca tus canciones aquí..." />
                                <a href="#"
                                    onclick="event.preventDefault(); this.closest('form').submit(); toggleSearchAnimation();">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        class="w-4 h-4 stroke-white">
                                        <path fill-rule="evenodd"
                                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </label>
                        </form>
                    </li>
                </ul>
            </details>

            <form action="{{ route('search.index') }}" method='GET' class="hidden md:flex w-full rounded-lg ml-20">
                <!-- Added 'hidden md:flex' classes to hide on small screens and show on medium and larger screens -->
                <label class="input input-bordered flex items-center gap-2 flex-grow">
                    <input name="query" type="text" class="w-full dark:text-white"
                        placeholder="Busca tus canciones aquí..." />
                    <a href="#"
                        onclick="event.preventDefault(); this.closest('form').submit(); toggleSearchAnimation();">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 stroke-white">
                            <path fill-rule="evenodd"
                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </label>
            </form>

        </div>
        <div id="logo" class="w-1/2 flex justify-center">
            <a href="{{ route('landingPage') }}"><x-application-logo /></a>
        </div>
        <div id="post-logo" class="w-1/4 text-right self-center">
            <nav class="-mx-3 flex flex-1 justify-end mr-3">
                @if (Route::has('login'))

                    @auth
                        <details class="dropdown dropdown-end mr-20 mt-2">
                            <summary class="m-1 btn w-0">
                                <div class="avatar">
                                    <div class="w-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        @php

                                            if (Auth::check()) {
                                                $avatar = Creativeorange\Gravatar\Facades\Gravatar::get(
                                                    Auth::user()->email,
                                                );
                                            } else {
                                                $avatar = null;
                                            }
                                        @endphp
                                        <img src="{{ $avatar }}" />
                                    </div>
                                </div>
                            </summary>
                            <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52 dark:text-white">
                                <li><a href="{{ url('/dashboard') }}" class=" m-1">Dashboard</a></li>
                                <li><a href="{{ url('/profile') }}" class=" m-1">Tu Perfil</a></li>

                                <li><a href="{{ route('myreviews') }}" class=" m-1">Mis reviews</a></li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"><a href="#" class="m-1">
                                            @csrf
                                            Salir
                                        </a></form>
                                </li>

                            </ul>
                        </details>
                    @else
                        <div class="dropdown dropdown-end mr-20 mt-2">
                            <div tabindex="0" role="button" class="btn m-1 btn-circle btn-md btn-outline ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                  </svg>
                                  

                            </div>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 ">
                                <li><a href="{{ route('login') }}" class="dark:text-white m-1">
                                        Log in
                                    </a></li>
                                <li>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="dark:text-white m-1">
                                            Register
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                            </svg>
                                        </a>
                                    @endif
                                </li>
                                <li><a href="{{ route('spotify.login') }}" onclick="toggleSptLoginAnim()"
                                        class="dark:text-black bg-spotify hover:bg-green-600 m-1">
                                        Spotify Login
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                            <path
                                                d="M12.01 2.019c-5.495 0-9.991 4.496-9.991 9.991 0 5.494 4.496 9.99 9.991 9.99 5.494 0 9.99-4.496 9.99-9.99 0-5.495-4.446-9.991-9.99-9.991zm4.595 14.436c-.199.299-.549.4-.85.201-2.349-1.45-5.296-1.75-8.793-.951-.348.102-.648-.148-.748-.449-.101-.35.149-.648.45-.749 3.795-.85 7.093-.499 9.69 1.1.35.149.4.548.251.848zm1.2-2.747c-.251.349-.7.499-1.051.249-2.697-1.646-6.792-2.148-9.939-1.148-.398.101-.85-.1-.949-.498-.101-.402.1-.852.499-.952 3.646-1.098 8.143-.548 11.239 1.351.3.149.45.648.201.998zm.099-2.799c-3.197-1.897-8.542-2.097-11.59-1.146a.938.938 0 0 1-1.148-.6.937.937 0 0 1 .599-1.151c3.547-1.049 9.392-.85 13.089 1.351.449.249.599.849.349 1.298-.25.35-.849.498-1.299.248z">
                                            </path>
                                        </svg>
                                        <span class="loading loading-spinner ml-3 hidden" id="spotifyLogin"></span>
                                    </a></li>
                                <li>
                            </ul>
                        </div>



                    @endauth
            </nav>
            @endif
        </div>
    </div>
    <script>
        function toggleSptLoginAnim() {
            document.querySelector("#spotifyLogin").classList.toggle('hidden')
        }
    </script>
</header>
