<header>
    <!--Header Nav-->
    <div class="flex justify-between sticky">
        <div id="pre-logo" class="w-1/4">
            <h1><!--LEFT MENU--></h1>
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
