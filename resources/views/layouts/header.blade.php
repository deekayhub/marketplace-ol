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
                    <div class="search-wrapper d-flex">

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

                    </div>
                </div>

                <!-- Login/Register -->
                <div class="col-auto desktop-login">
                    <div class="d-flex align-items-center gap-2 small">

                        <a href="{{ route('login') }}"
                           class="text-decoration-none text-muted-custom">
                            Login
                        </a>

                        <span>|</span>

                        <a href="{{ route('register') }}"
                           class="text-decoration-none text-muted-custom">
                            Register
                        </a>

                    </div>
                </div>

                <!-- Sell -->
                <div class="col-auto">

                    <a href="#"
                       class="sell-button px-3 py-2 d-flex align-items-center gap-1">

                        <span class="material-symbols-outlined">
                            add_circle
                        </span>

                        <span>+ Sell</span>

                    </a>

                </div>

            </div>
        </div>

        <!-- Categories -->
        <div class="category-nav">
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
        </div>

    </header>