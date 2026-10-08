@extends('layouts.app')
@section('title', $listing->title)
@section('content')

@push('styles')
   <style>


    .bg-surface {
        background-color: var(--surface);
    }

    .bg-surface-low {
        background-color: var(--surface-low);
    }

    .bg-surface-high {
        background-color: var(--surface-high);
    }

    .bg-card {
        background-color: #fff;
    }

    .text-primary-custom {
        color: var(--primary) !important;
    }

    .text-muted-custom {
        color: var(--muted) !important;
    }

    .btn-primary-custom {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    .btn-primary-custom:hover {
        background: #563d91;
        border-color: #563d91;
        color: #fff;
    }

    .rounded-xl {
        border-radius: 1rem;
    }

    .shadow-soft {
        box-shadow: 0 .125rem .35rem rgba(0, 0, 0, .06);
    }

    .shadow-soft:hover {
        box-shadow: 0 .35rem 1rem rgba(0, 0, 0, .10);
    }

    .gallery-main {
        aspect-ratio: 16 / 10;
    }

    .gallery-thumb {
        aspect-ratio: 1 / 1;
    }

    .gallery-main img,
    .gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-main img {
        transition: transform .5s ease;
    }

    .gallery-main:hover img {
        transform: scale(1.05);
    }

    .thumb-active {
        border: 2px solid var(--primary) !important;
    }

    .listing-title {
        font-size: clamp(1.5rem, 2.5vw, 2.25rem);
        font-weight: 700;
        line-height: 1.25;
    }

    .price-xl {
        font-size: 2.5rem;
        line-height: 1;
        font-weight: 700;
    }

    .price-lg {
        font-size: 2rem;
        line-height: 1;
        font-weight: 700;
    }

    .spec-card {
        background: var(--surface-low);
        border-radius: .75rem;
        padding: 1rem;
        height: 100%;
    }

    .seller-avatar {
        width: 56px;
        height: 56px;
        object-fit: cover;
    }

    .online-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #4caf50;
        border: 2px solid #fff;
        position: absolute;
        right: 0;
        bottom: 0;
    }

    .map-box {
        height: 176px;
        background-size: cover;
        background-position: center;
    }

    .related-card {
        transition: all .25s ease;
    }

    .related-card:hover {
        transform: translateY(-2px);
    }

    .related-image {
        aspect-ratio: 4 / 3;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .3s ease;
    }

    .related-card:hover .related-image img {
        transform: scale(1.05);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .sticky-sidebar {
        position: sticky;
        top: 2rem;
    }

    .material-symbols-outlined {
        vertical-align: middle;
    }

    @media (max-width: 991.98px) {
        .sticky-sidebar {
            position: static;
        }
    }
</style>
@endpush

<div class="container py-4">
    <div class="listing-container mx-auto">

        <div class="d-flex align-items-center justify-content-between py-2 mb-3">

            <nav class="d-flex align-items-center gap-2 flex-wrap small text-muted-custom">

                <a href="{{ route('home') }}"
                   class="text-decoration-none text-muted-custom d-flex align-items-center gap-1">
                    <span class="material-symbols-outlined fs-6">home</span>
                    <span>Home</span>
                </a>

                <span>/</span>

                <a href="{{ route('listings.show', $listing->id) }}" class="text-decoration-none text-muted-custom">
                    {{ $listing->category?->name ?? 'N/A' }}
                </a>

                <span>/</span>

                <a href="#" class="text-decoration-none text-muted-custom">
                    {{ $listing->subCategory?->name ?? 'N/A' }}
                </a>

                <span>/</span>

                <span class="fw-semibold text-dark text-truncate">
                    {{ $listing->title }}
                </span>
            </nav>
        </div>


        <div class="row g-4 align-items-start">
            <div class="col-lg-8">
                <div class="d-flex flex-column gap-4">
                    <div class="bg-card rounded-xl shadow-soft p-3">
                        <div class="gallery-main position-relative rounded overflow-hidden bg-surface-low">
                            <img id="main-stage-img" src="{{ $listing->images->first() ? asset('storage/' . $listing->images->first()->image) : 'https://placehold.net/600x600.png' }}" alt="{{ $listing->title }}">

                            <div class="position-absolute bottom-0 end-0 m-3 d-flex gap-2">

                                <span class="badge bg-dark bg-opacity-75 px-3 py-2">
                                    <span class="material-symbols-outlined fs-6">
                                        photo_camera
                                    </span>
                                    <span id="gallery-counter">
                                        1 / {{ $listing->images->count() }} Photos
                                    </span>
                                </span>

                                {{-- <button type="button"
                                        class="btn btn-light btn-sm shadow">
                                    <span class="material-symbols-outlined">
                                        fullscreen
                                    </span>
                                </button> --}}

                            </div>
                        </div>


                        @if ($listing->images && $listing->images->isNotEmpty())
                            <div class="row row-cols-3 row-cols-sm-6 g-2 mt-2">
                                @foreach ($listing->images as $image)
                                    <div class="col">
                                        <div class="gallery-thumb rounded overflow-hidden thumb-active p-1">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>


                    <!-- Listing Header -->
                    <div class="bg-card rounded-xl shadow-soft p-4">

                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">

                            <div class="flex-grow-1">

                                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                    <small class="text-muted-custom">
                                        <span class="material-symbols-outlined fs-6">
                                            schedule
                                        </span>
                                        Posted {{ $listing->created_at->diffForHumans() }} ago
                                    </small>

                                </div>

                                <h1 class="listing-title mb-2">
                                    {{ $listing->title ?? 'N/A' }}
                                </h1>

                                <div class="d-flex align-items-center gap-2 text-muted-custom">
                                    <span class="material-symbols-outlined text-primary-custom">
                                        location_on
                                    </span>

                                    <span class="fw-semibold text-dark">
                                        {{ $listing->city?->name }}, {{ $listing->state?->name }}, {{ $listing->country?->name }}
                                    </span>
                                </div>

                            </div>

                        </div>


                        <!-- Price -->
                        <div class="bg-surface-low rounded p-3 mt-4 d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted-custom d-block">
                                    Offered Price
                                </small>

                                <div class="price-xl text-primary-custom">
                                    ₹ {{ $listing->price }}
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="bg-card rounded-xl shadow-soft p-4">

                        <h2 class="h4 fw-bold mb-3">
                            Description
                        </h2>

                        <div class="lh-lg">

                            {!! nl2br(e($listing->description)) !!}

                        </div>


                        <!-- Pills -->
                        <div class="d-flex flex-wrap gap-2 mt-3">

                            <span class="badge bg-surface-low text-dark">
                                iOS 18.2 Ready
                            </span>

                            <span class="badge bg-surface-low text-dark">
                                eSIM + Physical SIM
                            </span>

                            <span class="badge bg-surface-low text-dark">
                                48MP Main Camera
                            </span>

                            <span class="badge bg-surface-low text-dark">
                                Always-On Display
                            </span>

                            <span class="badge bg-surface-low text-dark">
                                India Indian Retail Unit
                            </span>

                        </div>

                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="sticky-sidebar d-flex flex-column gap-4">
                    <div class="bg-card rounded-xl shadow-soft p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small class="text-muted-custom text-uppercase fw-semibold">
                                    Price
                                </small>
                                <div class="price-lg text-primary-custom mt-1">
                                    ₹ {{ $listing->price ?? 'N/A' }}
                                </div>
                            </div>
                        </div>


                        <div class="d-grid gap-2 mt-4">
                            <button type="button"
                                    class="btn btn-primary-custom py-3 fw-semibold">

                                <span class="material-symbols-outlined">
                                    chat
                                </span>
                                Chat / Contact Seller
                            </button>

                        </div>

                        <div class="text-center text-muted-custom small mt-3">

                            <span class="material-symbols-outlined fs-6 text-primary-custom">
                                lock
                            </span>

                            End-to-end encrypted messaging via TradeHub

                        </div>

                    </div>


                    <!-- Seller -->
                    <div class="bg-card rounded-xl shadow-soft p-4">

                        <div class="d-flex align-items-center gap-3">

                            <div class="position-relative">

                                <img class="seller-avatar rounded-circle shadow-sm"
                                     src="https://placehold.net/avatar.png"
                                     alt="{{ $listing->user->name ?? 'Unknown Seller' }}">

                                <span class="online-dot"></span>

                            </div>

                            <div class="min-w-0">

                                <div class="d-flex align-items-center gap-1">

                                    <h3 class="h5 fw-bold mb-0 text-truncate">
                                        {{ $listing->user->name ?? 'Unknown Seller' }}
                                    </h3>

                                    <span class="material-symbols-outlined text-primary-custom fs-5">
                                        verified
                                    </span>
                                </div>
                                <small class="text-muted-custom d-block">
                                    Member since {{ $listing->user->created_at->format('F Y') ?? 'N/A' }}
                                </small>
                            </div>

                        </div>


                        <div class="row g-2 mt-3">

                            <div class="col-6">
                                <div class="bg-surface-low rounded p-2 small fw-semibold">
                                    <span class="material-symbols-outlined text-primary-custom fs-6">
                                        verified_user
                                    </span>
                                    Phone Verified
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="bg-surface-low rounded p-2 small fw-semibold">
                                    <span class="material-symbols-outlined text-primary-custom fs-6">
                                        mark_email_read
                                    </span>
                                    Email Verified
                                </div>
                            </div>

                        </div>


                        <!-- Stats -->
                        <div class="mt-3">

                            <div class="d-flex justify-content-between py-2 small">
                                <span class="text-muted-custom">
                                    <span class="material-symbols-outlined fs-6">
                                        speed
                                    </span>
                                    Response Rate
                                </span>

                                <strong>Replies within 1 hour</strong>
                            </div>

                            <div class="d-flex justify-content-between py-2 small">
                                <span class="text-muted-custom">
                                    <span class="material-symbols-outlined fs-6">
                                        storefront
                                    </span>
                                    Market Activity
                                </span>

                                <a href="#" class="text-primary-custom fw-semibold">
                                    6
                                </a>
                            </div>

                            <div class="d-flex justify-content-between py-2 small">
                                <span class="text-muted-custom">
                                    <span class="material-symbols-outlined fs-6">
                                        star
                                    </span>
                                    Community Rating
                                </span>

                                <strong>
                                    4.9
                                    <small class="text-muted-custom">
                                        (28 deals)
                                    </small>
                                </strong>
                            </div>

                        </div>




                    </div>


                    <!-- Location -->
                    <div class="bg-card rounded-xl shadow-soft p-3">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div class="fw-semibold">
                                <span class="material-symbols-outlined text-primary-custom fs-5">
                                    place
                                </span>
                                Location
                            </div>

                            <small class="text-muted-custom">
                                {{ $listing->city->name }}
                            </small>

                        </div>


                        <div class="map-box rounded position-relative overflow-hidden"
                             style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuB_CG2rII8L2NG020b90szL7u_7s3M61sWkE-xagU4gKPl7gcRL5thP8KUeiIBMLKgE9T2ehcByqiKG_K4r0Xy-DuoFuaOfPpMoDHHDvjcn9-dMFSiVwu5pDRvorq5yz7O0xHZA0US-Q35DB3dqavs0n_ba6v1C71Tp0RDP9TSHSd8Abpyk2gTnYYTKRJHxgn-x7igCZ_QpSjGak4pV3MGldurU359Mn7FMmwVc-XH0')">

                            <div class="position-absolute top-50 start-50 translate-middle text-center">

                                <div class="bg-primary text-white rounded-circle p-2 shadow">
                                    <span class="material-symbols-outlined">
                                        location_on
                                    </span>
                                </div>

                                <span class="badge bg-dark mt-1">
                                    {{ $listing->area->name }}  {{ $listing->city?->name ?? 'N/A' }} {{ $listing->state?->name ?? 'N/A' }}
                                </span>

                            </div>

                        </div>

                        <small class="text-muted-custom d-block mt-2">
                            Exact address and landmark revealed once deal chat is established.
                        </small>

                    </div>


                    <div class="d-flex justify-content-between px-2 small text-muted-custom">

                        <button type="button"
                                class="btn btn-link p-0 text-muted-custom text-decoration-none">

                            <span class="material-symbols-outlined fs-6">
                                flag
                            </span>

                            Report this ad to TradeHub

                        </button>



                    </div>

                </div>
            </div>

        </div>


        <!-- RELATED LISTINGS -->
        <section class="mt-5 pt-4">

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-end gap-2 mb-4">

                <div>

                    <div class="small text-primary-custom fw-bold text-uppercase">
                       Related List
                    </div>



                </div>

                <a href="{{ route('listings.index', ['category' => $listing->category_id]) }}"
                   class="text-primary-custom fw-semibold text-decoration-none">
                    Browse all in {{ $listing->category->name }}
                    <span class="material-symbols-outlined fs-6">
                        arrow_forward
                    </span>
                </a>

            </div>


            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">

                @foreach ($relatedListings as $item)
                    <div class="col">
                        <div class="related-card bg-card rounded-xl shadow-soft overflow-hidden h-100">
                            <a href="{{ route('listings.show', $item->id) }}" class="text-decoration-none text-dark">
                            <div class="related-image position-relative overflow-hidden">
                                <img src="{{ $item->images->first() ? asset('storage/' . $item->images->first()->image) : 'https://placehold.net/600x600.png' }}" alt="{{ $item->title }}">
                                <span class="position-absolute bottom-0 end-0 m-2 badge bg-dark bg-opacity-75">
                                    1/{{ $item->images->count() }}
                                </span>

                            </div>

                            <div class="p-3">

                                <div class="fw-bold text-primary-custom fs-5">
                                    ₹ {{ number_format($item->price, 2) }}
                                </div>

                                <h3 class="h6 mt-1 line-clamp-2">
                                        {{ $item->title }}
                                </h3>

                                <div class="d-flex justify-content-between small text-muted-custom mt-3">
                                    <span>{{ $item->area->name }}, {{ $item->city->name }}</span>
                                    <span>{{ $item->created_at->diffForHumans() }}</span>
                                </div>

                            </div>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>

        </section>

    </div>
</div>


<script>
    const numBtn = document.getElementById('show-number-btn');
    const numText = document.getElementById('number-text');

    if (numBtn && numText) {
        numBtn.addEventListener('click', () => {

            numText.textContent = '+91 98765 43210 (Verified)';

            numBtn.classList.remove('bg-surface-low');
            numBtn.classList.add('bg-primary-subtle');

        });
    }


    const thumbnails =
        document.querySelectorAll('.gallery-thumb img');

    const mainImage =
        document.getElementById('main-stage-img');

    thumbnails.forEach((thumbnail) => {

        thumbnail.parentElement.addEventListener('click', () => {

            if (!mainImage) return;

            mainImage.src = thumbnail.src;

            document
                .querySelectorAll('.gallery-thumb')
                .forEach(item => item.classList.remove('thumb-active'));

            thumbnail.parentElement.classList.add('thumb-active');

        });

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
@endsection
