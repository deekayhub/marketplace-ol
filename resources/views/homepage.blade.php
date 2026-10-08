@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container-fluid max-width py-3">
            <!-- Hero -->
            <section class="hero p-4 p-lg-5 mb-5">

                <div class="mx-auto text-center" style="max-width: 900px;">

                    <span class="hero-badge px-3 py-2 d-inline-flex align-items-center gap-1 mb-3">

                        <span class="material-symbols-outlined">
                            bolt
                        </span>

                        Local Marketplace

                    </span>

                    <h1 class="hero-title mb-2">
                        Buy & Sell Anything
                        <span class="text-primary-custom">
                            Near You
                        </span>
                    </h1>

                    <p class="text-muted-custom mb-4">
                        The trusted neighborhood marketplace for verified electronics,
                        genuine vehicles, trusted real estate, and daily local bargains.
                    </p>


                   <form action="{{ route('listings.index') }}" method="GET">

                        <div class="quick-search p-2">

                            <div class="row g-2">

                                <!-- Location -->
                                <div class="col-12 col-md-3">
                                    <div class="search-field p-2 h-100 text-start">

                                        <label>Location</label>

                                        <div class="d-flex align-items-center">

                                            <span class="material-symbols-outlined text-primary-custom me-1">
                                                location_on
                                            </span>

                                            <select class="form-select border-0 p-0" name="city">
                                                <option value="">All Locations</option>

                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>
                                </div>


                                <!-- Category -->
                                <div class="col-12 col-md-3">
                                    <div class="search-field p-2 h-100 text-start">

                                        <label>Category</label>

                                        <div class="d-flex align-items-center">

                                            <span class="material-symbols-outlined text-primary-custom me-1">
                                                category
                                            </span>

                                            <select class="form-select border-0 p-0" name="category">
                                                <option value="">All Categories</option>

                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>
                                </div>


                                <!-- Keyword -->
                                <div class="col-12 col-md">

                                    <div class="search-field p-2 h-100 text-start">

                                        <label>Keyword</label>

                                        <div class="d-flex align-items-center">

                                            <span class="material-symbols-outlined text-secondary me-1">
                                                search
                                            </span>

                                            <input
                                                id="search-query"
                                                type="text"
                                                class="form-control p-0"
                                                name="search"
                                                value="{{ request('search') }}"
                                                placeholder="iPhone 15, Honda City, 2 BHK..."
                                            >

                                        </div>

                                    </div>

                                </div>


                                <!-- Button -->
                                <div class="col-12 col-md-auto">

                                    <button
                                        type="submit"
                                        class="btn bg-primary-custom text-white h-100 px-4 d-flex align-items-center justify-content-center gap-1"
                                    >
                                        <span class="material-symbols-outlined">
                                            search
                                        </span>

                                        Find Deals
                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>


                </div>

            </section>


            <!-- Categories -->

            <section class="mb-5">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <h2 class="h4 fw-bold mb-1">
                            Browse All Categories
                        </h2>

                        <p class="text-muted-custom small mb-0">
                            Select an industry vertical to discover verified bargains nearby
                        </p>
                    </div>

                    <a href="#" class="text-primary-custom fw-semibold small">
                        Full Directory →
                    </a>

                </div>


                <div class="row g-2">
                    @foreach($categories as $category)

                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                            <a href="{{ route('listings.index', ['category' => $category->id]) }}"
                               class="category-card p-3 d-flex flex-column align-items-center text-center h-100">

                                <div class="category-icon mb-2">

                                    <span class="material-symbols-outlined">
                                    category
                                    </span>

                                </div>

                                <strong class="small">
                                    {{ $category->name }}
                                </strong>

                                <span class="text-muted-custom" style="font-size:11px;">
                                    {{ $category->listings_count }} ads
                                </span>

                            </a>

                        </div>

                    @endforeach

                </div>

            </section>


            <section class="mb-5">

                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">

                    <div>

                        <h2 class="h4 fw-bold mb-1">

                            <span class="material-symbols-outlined text-warning">
                                local_fire_department
                            </span>

                            Latest Recommendations

                        </h2>

                        {{-- <p class="text-muted-custom small mb-0">
                            Live listings posted recently in your regional radius
                        </p> --}}

                    </div>

                    <a class="btn bg-surface-high text-primary-custom fw-bold" href="{{ route('listings.index') }}">
                        View All
                    </a>

                </div>


                <div class="row g-3">


                    @foreach($listings as $listing)

                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ route('listings.show', $listing->id) }}" class="text-decoration-none text-dark  h-100">
                                <article class="listing-card h-100">
                                    <div class="listing-image-wrapper">
                                    <img
                                        src="{{ $listing->images->first() ? asset('storage/' . $listing->images->first()->image) : 'https://placehold.net/600x600.png' }}"
                                        alt="{{ $listing->title ?? 'Listing Image' }}"
                                        class="listing-image"
                                    >

                                        @if($listing['badge'])
                                            <span
                                                class="listing-badge
                                                {{ $listing['badge'] === 'Verified Seller'
                                                    ? 'badge-verified'
                                                    : 'badge-featured' }}">
                                                {{ $listing['badge'] }}
                                            </span>
                                        @endif

                                    </div>


                                    <div class="p-3 d-flex flex-column h-100">

                                        <div class="d-flex justify-content-between align-items-start mb-1">

                                            <span class="listing-price">
                                                ₹ {{ number_format($listing['price'], 2) }}
                                            </span>

                                            <span class="condition-badge">
                                                {{ $listing->category?->name }}
                                            </span>

                                        </div>

                                        <h3 class="listing-title mb-3">
                                            {{ $listing->title }}
                                        </h3>
                                        <p class=" mb-3">
                                            {{ $listing->description }}
                                        </p>

                                        <div class="d-flex justify-content-between small text-muted-custom mt-3">
                                            <span>{{ $listing->area->name }}, {{ $listing->city->name }}</span>
                                            <span>{{ $listing->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>

                                </article>
                            </a>

                        </div>

                    @endforeach

                </div>

            </section>

            <section class="cta-section p-4 mb-4">

                <div class="row align-items-center g-4">

                    <div class="col-md">

                        <div class="d-flex align-items-center gap-3">

                            <div class="cta-icon d-none d-sm-flex">

                                <span class="material-symbols-outlined"
                                      style="font-size:34px;">
                                    add_business
                                </span>

                            </div>

                            <div>

                                <span class="text-uppercase text-warning fw-bold small">
                                    Fast • 100% Free • Direct Contacts
                                </span>

                                <h2 class="h4 fw-bold mt-1">
                                    Got something to sell?
                                    Post your ad in 60 seconds
                                </h2>

                                <p class="small text-muted-custom mb-0">
                                    Reach thousands of active buyers in your immediate
                                    neighborhood. No middlemen fees or listing commissions.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-auto">

                        <div class="d-flex flex-column flex-sm-row gap-2">

                            <a href="{{ route('listing.create') }}"
                               class="btn bg-primary-custom text-white px-4">

                                <span class="material-symbols-outlined">
                                    add_circle
                                </span>

                                + Post Listing

                            </a>

                            <a href="#"
                               class="btn btn-light px-4">

                                Seller Guide

                                <span class="material-symbols-outlined">
                                    help_outline
                                </span>

                            </a>

                        </div>

                    </div>

                </div>

            </section>

        </div>
@endsection
