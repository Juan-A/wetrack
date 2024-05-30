<header>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <!--Header Nav-->
    <div class="flex justify-between">
        
        <div id="pre-logo" class="w-1/4 flex items-center">

            <details class="dropdown ml-20">
                <summary class="m-1 btn btn-circle btn-outline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg></summary>
                <ul class="shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-72">
                  <li>
                    <form action="{{ route('search.index') }}" method='GET' class=" w-full rounded-lg">
                        <label class="input input-bordered flex items-center gap-2">
                            <input name="query" type="text" class="w-full dark:text-white" placeholder="Search"
                                />
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit(); toggleSearchAnimation();">
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
              
        </div>
        <div id="logo" class="w-1/2 flex justify-center">
            <a href="{{  route('landingPage') }}" ><x-application-logo/></a>
        </div>
        <div id="post-logo" class="w-1/4 text-right self-center">
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end mr-3">
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
                            <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52 text-white">
                                <li><a href="{{ url('/dashboard') }}" class="">Dashboard</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><a href="#">
                                            @csrf
                                            Salir

                                        </a></form>
                                </li>

                            </ul>
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

</header>
