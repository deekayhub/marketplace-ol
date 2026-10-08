@extends('layouts.app')

@section('title', 'Post a Listing')

@section('content')

<div class="bg-light min-vh-100 py-3 container">
    <section class="mb-5">

        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">

            <div>

                <h2 class="h4 fw-bold mb-1">

                    <span class="material-symbols-outlined text-warning">
                        local_fire_department
                    </span>

                    All Listings

                </h2>
            </div>

        </div>


        <div class="row g-3">
            @forelse($listings as $listing)

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <article class="listing-card h-100">
                        <div class="listing-image-wrapper">
                            <img
                                src="{{ $listing->image ?? 'https://placehold.net/600x600.png' }}"
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

                            <button
                                type="button"
                                class="favorite-btn"
                                aria-label="Favorite listing"
                            >
                                <span class="material-symbols-outlined">
                                    favorite
                                </span>
                            </button>

                            <span class="photo-count">
                                1/6 Photos
                            </span>

                        </div>


                        <div class="p-3 d-flex flex-column h-100">

                            <div class="d-flex justify-content-between align-items-start mb-1">

                                <span class="listing-price">
                                    {{ $listing['price'] }}
                                </span>

                                <span class="condition-badge">
                                    Good
                                </span>

                            </div>

                            <h3 class="listing-title mb-3">
                                {{ $listing['title'] }}
                            </h3>

                            <div class="listing-meta pt-2 mt-auto d-flex justify-content-between">

                                <span class="text-truncate">
                                    <span class="material-symbols-outlined"
                                            style="font-size:14px;">
                                        location_on
                                    </span>

                                    {{ $listing['location'] }}
                                </span>

                                <span class="ms-2 text-nowrap">
                                    {{ $listing['time'] }}
                                </span>

                            </div>

                        </div>

                    </article>

                </div>
             @empty
                <div class="col-12 text-center py-5">

                    <span class="material-symbols-outlined text-muted" style="font-size: 48px;">
                        inventory_2
                    </span>

                    <h5 class="mt-3 mb-2">
                        No listings found
                    </h5>

                    <p class="text-muted mb-3">
                        No listings match your current filters.
                    </p>

                    <a href="{{ route('listings.index') }}"
                    class="btn bg-primary-custom text-white px-4">
                        View All Listings
                    </a>

                </div>
            @endforelse

        </div>


        {{-- <div class="text-center mt-4">

            <button class="btn btn-light px-4">

                Load More Recommendations

                <span class="material-symbols-outlined">
                    expand_more
                </span>

            </button>

        </div> --}}

    </section>
</div>
@endsection
