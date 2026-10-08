<header class="main-header">

        <!-- Top Header -->
        <div class="container-fluid max-width header-top">
            <div class="row align-items-center h-100 py-2">

                <!-- Logo -->
                <div class="col-auto">
                    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">

                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <span class="fw-bold text-primary-custom d-none d-sm-inline">
                            TradeHub
                        </span>
                    </a>
                </div>

                <!-- Search -->
                <div class="col desktop-search">
                    {{-- <div class="search-wrapper d-flex">

                        <div class="search-category d-none d-lg-flex align-items-center px-3 small">
                            All Categories
                            <span class="material-symbols-outlined ms-1">
                                expand_more
                            </span>
                        </div>

                        <div class="flex-grow-1 d-flex align-items-center px-2">

                            <span class="material-symbols-outlined text-secondary">
                                search
                            </span>

                            <input
                                type="text"
                                class="form-control search-input"
                                placeholder="Find Cars, Mobiles, Jobs, Real Estate and more..."
                            >

                        </div>

                        <button class="search-button px-3">
                            <span class="material-symbols-outlined">
                                search
                            </span>
                        </button>

                    </div> --}}
                </div>

                <!-- Login/Register -->
                <div class="col-auto desktop-login">
                    @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @else
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-3">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary rounded-3">Register</a>
                        @endif
                        <a href="{{ route('login') }}" class="btn btn-success rounded-3">Add Listing</a>
                    </div>
                    @endauth
                </div>

                <!-- Sell -->
                <div class="col-auto">

                    <a href="{{ route('listing.create') }}"
                       class="sell-button px-3 py-2 d-flex align-items-center gap-1">

                        <span class="material-symbols-outlined">
                            add_circle
                        </span>

                        <span>Listing</span>

                    </a>

                </div>

            </div>
        </div>

        <!-- Categories -->
        {{-- <div class="category-nav">
            <div class="container-fluid max-width h-100">

                <div class="d-flex align-items-center gap-4 h-100 overflow-auto">

                    <a href="#">Mobile Phones</a>
                    <a href="#">Cars & Vehicles</a>
                    <a href="#">Real Estate & Properties</a>
                    <a href="#">Electronics & Appliances</a>
                    <a href="#">Furniture</a>
                    <a href="#">Jobs & Services</a>
                    <a href="#">Fashion</a>

                </div>

            </div>
        </div> --}}

    </header>
