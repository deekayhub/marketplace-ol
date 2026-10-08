<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300;400;500;600;700" rel="stylesheet"
    >
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                background: #f8f9ff;
                color: #0b1c30;
            }

            .material-symbols-outlined {
                font-size: 20px;
                vertical-align: middle;
                font-variation-settings:
                    'FILL' 0,
                    'wght' 500,
                    'GRAD' 0,
                    'opsz' 24;
            }

            :root {
                --primary: #005c55;
                --primary-container: #0f766e;
                --surface: #f8f9ff;
                --surface-low: #eff4ff;
                --surface-container: #e5eeff;
                --surface-high: #dce9ff;
                --surface-highest: #d3e4fe;
                --text: #0b1c30;
                --text-muted: #3e4947;
                --border: #bdc9c6;
                --secondary: #904d00;
            }

            .text-primary-custom {
                color: var(--primary) !important;
            }

            .bg-primary-custom {
                background-color: var(--primary) !important;
            }

            .bg-surface {
                background-color: var(--surface);
            }

            .bg-surface-low {
                background-color: var(--surface-low);
            }

            .bg-surface-container {
                background-color: var(--surface-container);
            }

            .bg-surface-high {
                background-color: var(--surface-high);
            }

            .bg-surface-highest {
                background-color: var(--surface-highest);
            }

            .text-muted-custom {
                color: var(--text-muted) !important;
            }

            .max-width {
                max-width: 1280px;
            }

            /* Header */

            .main-header {
                background: #fff;
                box-shadow: 0 1px 8px rgba(0, 0, 0, 0.06);
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 1000;
            }

            .header-top {
                min-height: 64px;
            }

            .header-logo {
                height: 32px;
                width: auto;
            }

            .search-wrapper {
                height: 40px;
                border: 1px solid var(--border);
                border-radius: 8px;
                overflow: hidden;
                background: #fff;
            }

            .search-category {
                background: var(--surface-low);
                border-right: 1px solid var(--border);
            }

            .search-input {
                border: 0;
                outline: none;
                box-shadow: none !important;
            }

            .search-button {
                background: var(--primary);
                color: white;
                border: 0;
            }

            .search-button:hover {
                background: var(--primary-container);
                color: white;
            }

            .sell-button {
                background: var(--primary-container);
                color: white;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
            }

            .sell-button:hover {
                background: var(--primary);
                color: white;
            }

            .profile-img {
                width: 32px;
                height: 32px;
                object-fit: cover;
            }

            .category-nav {
                height: 48px;
                border-top: 1px solid rgba(189, 201, 198, .3);
            }

            .category-nav a {
                color: var(--text-muted);
                text-decoration: none;
                font-size: 13px;
                font-weight: 500;
                white-space: nowrap;
            }

            .category-nav a:hover {
                color: var(--primary);
            }

            /* Main */

            main {
                padding-top: 128px;
            }

            .notification-strip {
                background: var(--surface-high);
                border-radius: 12px;
            }

            .live-dot {
                width: 8px;
                height: 8px;
                background: var(--primary-container);
                border-radius: 50%;
                display: inline-block;
            }

            /* Hero */

            .hero {
                background: #fff;
                border-radius: 40px;
                box-shadow: 0 4px 15px rgba(15, 23, 42, .08);
            }

            .hero-badge {
                background: var(--surface-high);
                color: var(--primary);
                border-radius: 50px;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 1px;
            }

            .hero-title {
                font-size: 36px;
                line-height: 1.25;
                font-weight: 700;
                letter-spacing: -1px;
            }

            .quick-search {
                background: var(--surface-low);
                border-radius: 12px;
            }

            .search-field {
                background: #fff;
                border-radius: 8px;
            }

            .search-field label {
                display: block;
                font-size: 10px;
                font-weight: 700;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: .7px;
            }

            .search-field select,
            .search-field input {
                border: 0;
                outline: none;
                box-shadow: none;
                background: transparent;
                font-size: 14px;
            }

            .trending-tag {
                background: var(--surface-high);
                border: 0;
                border-radius: 50px;
                padding: 5px 10px;
                font-size: 12px;
            }

            .trending-tag:hover {
                background: var(--surface-container);
            }

            /* Cards */

            .location-card,
            .category-card,
            .listing-card {
                background: #fff;
                border: 0;
                border-radius: 12px;
                box-shadow: 0 2px 7px rgba(15, 23, 42, .05);
                transition: all .2s ease;
            }

            .location-card:hover,
            .category-card:hover,
            .listing-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(15, 23, 42, .10);
            }

            .location-card {
                text-decoration: none;
                color: var(--text);
            }

            .location-card:hover {
                color: var(--primary);
            }

            .category-icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                background: var(--surface-container);
                color: var(--primary);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .category-card {
                text-decoration: none;
                color: var(--text);
            }

            .category-card:hover {
                color: var(--primary);
            }

            /* Listing */

            .listing-card {
                overflow: hidden;
            }

            .listing-image-wrapper {
                position: relative;
                aspect-ratio: 4 / 3;
                overflow: hidden;
                background: var(--surface-container);
            }

            .listing-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform .3s ease;
            }

            .listing-card:hover .listing-image {
                transform: scale(1.05);
            }

            .listing-badge {
                position: absolute;
                top: 8px;
                left: 8px;
                font-size: 10px;
                font-weight: 700;
                text-transform: uppercase;
                padding: 3px 6px;
                border-radius: 4px;
            }

            .badge-featured {
                background: #ffdcc3;
                color: #663500;
            }

            .badge-verified {
                background: var(--primary);
                color: white;
            }

            .badge-urgent {
                background: #ba1a1a;
                color: white;
            }

            .favorite-btn {
                position: absolute;
                top: 8px;
                right: 8px;
                width: 32px;
                height: 32px;
                border-radius: 50%;
                border: 0;
                background: rgba(255,255,255,.9);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .favorite-btn:hover {
                color: #ba1a1a;
            }

            .photo-count {
                position: absolute;
                right: 8px;
                bottom: 8px;
                background: rgba(33,49,69,.75);
                color: white;
                font-size: 10px;
                padding: 3px 6px;
                border-radius: 4px;
            }

            .listing-price {
                font-size: 17px;
                font-weight: 700;
            }

            .listing-title {
                font-size: 15px;
                font-weight: 600;
                line-height: 1.4;
            }

            .listing-meta {
                font-size: 11px;
                color: var(--text-muted);
                border-top: 1px solid var(--surface-container);
            }

            .condition-badge {
                background: var(--surface-high);
                font-size: 11px;
                padding: 3px 6px;
                border-radius: 4px;
            }

            /* Trust */

            .trust-section {
                background: var(--surface-container);
                border-radius: 12px;
            }

            .trust-card {
                background: #fff;
                border-radius: 12px;
            }

            .trust-icon {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: var(--surface-high);
                color: var(--primary);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* CTA */

            .cta-section {
                background: var(--surface-highest);
                border-radius: 12px;
            }

            .cta-icon {
                width: 64px;
                height: 64px;
                border-radius: 12px;
                background: var(--primary-container);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Footer */

            footer {
                background: var(--surface-low);
                border-top: 1px solid rgba(189, 201, 198, .4);
            }

            footer a {
                color: var(--text-muted);
                text-decoration: none;
            }

            footer a:hover {
                color: var(--primary);
            }

            /* Mobile */

            @media (max-width: 767px) {
                main {
                    padding-top: 80px;
                }

                .hero {
                    border-radius: 20px;
                }

                .hero-title {
                    font-size: 28px;
                }

                .header-top {
                    min-height: 64px;
                }

                .desktop-search {
                    display: none !important;
                }

                .desktop-login {
                    display: none !important;
                }
            }
        </style>
        @stack('styles')
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h- bg-gray-100">
            @include('layouts.header')

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        @stack('scripts')
    </body>
</html>
