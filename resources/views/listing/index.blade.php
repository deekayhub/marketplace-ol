@extends('layouts.app')

@section('title', 'All Listing')

@section('content')

 <div class="container">
    <div class="row g-4">

        <div class="col-12 col-md-3">

            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">

                <div class="card-body p-3">

                    <div class="d-flex align-items-center justify-content-between mb-3">

                        <h5 class="fw-bold mb-0">
                            <span class="material-symbols-outlined align-middle me-1">
                                filter_list
                            </span>
                            Filters
                        </h5>

                        <a href="{{ route('listings.index') }}"
                        class="small text-decoration-none text-danger">
                            Clear All
                        </a>

                    </div>


                    <form action="{{ route('listings.index') }}" method="GET">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Search
                            </label>
                            <div class="input-group">

                                <span class="input-group-text bg-light border-end-0">
                                    <span class="material-symbols-outlined fs-5">
                                        search
                                    </span>
                                </span>

                                <input type="text"
                                    name="search"
                                    class="form-control bg-light border-start-0"
                                    placeholder="Search listings..."
                                    value="{{ request('search') }}">

                            </div>

                        </div>


                        {{-- Category --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Category
                            </label>

                            <select name="category" id="category" class="form-select">

                                <option value="">
                                    All Categories
                                </option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Subcategory
                            </label>

                            <select name="subcategory" id="subcategory" class="form-select">

                                <option value="">
                                    All Subcategories
                                </option>

                                @foreach($subcategories ?? [] as $subcategory)

                                    <option value="{{ $subcategory->id }}"
                                        {{ request('subcategory') == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Price Range
                            </label>

                            <div class="row g-2">

                                <div class="col-6">

                                    <input type="number"
                                        name="min_price"
                                        class="form-control"
                                        placeholder="Min"
                                        value="{{ request('min_price') }}">

                                </div>

                                <div class="col-6">

                                    <input type="number"
                                        name="max_price"
                                        class="form-control"
                                        placeholder="Max"
                                        value="{{ request('max_price') }}">

                                </div>

                            </div>

                        </div>


                        {{-- Listing Type --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold d-block">
                                Listing Type
                            </label>

                            <div class="form-check mb-2">

                                <input class="form-check-input"
                                    type="radio"
                                    name="type"
                                    value=""
                                    id="type-all"
                                    {{ !request('type') ? 'checked' : '' }}>

                                <label class="form-check-label"
                                    for="type-all">
                                    All
                                </label>

                            </div>

                            <div class="form-check mb-2">

                                <input class="form-check-input"
                                    type="radio"
                                    name="type"
                                    value="product"
                                    id="type-product"
                                    {{ request('type') == 'product' ? 'checked' : '' }}>

                                <label class="form-check-label"
                                    for="type-product">
                                    Products
                                </label>

                            </div>

                            <div class="form-check">

                                <input class="form-check-input"
                                    type="radio"
                                    name="type"
                                    value="service"
                                    id="type-service"
                                    {{ request('type') == 'service' ? 'checked' : '' }}>

                                <label class="form-check-label"
                                    for="type-service">
                                    Services
                                </label>

                            </div>

                        </div>


                        {{-- Apply Button --}}
                        <button type="submit"
                                class="btn bg-primary-custom text-white w-100">

                            <span class="material-symbols-outlined align-middle fs-5">
                                filter_alt
                            </span>

                            Apply Filters

                        </button>

                    </form>

                </div>

            </div>

        </div>


        <div class="col-12 col-md-9">

            <div class="bg-light min-vh-100 py-3">

                <section class="mb-5">

                    <div class="d-flex flex-column flex-sm-row
                                justify-content-between
                                align-items-sm-center
                                gap-3 mb-3">

                        <div>

                            <h2 class="h4 fw-bold mb-1">

                                <span class="material-symbols-outlined text-warning align-middle">
                                    local_fire_department
                                </span>

                                All Listings

                            </h2>

                            <small class="text-muted">
                                {{ $listings->total() }} listings found
                            </small>

                        </div>


                        {{-- Sort --}}
                        <div>

                            <select class="form-select form-select-sm"
                                    name="sort"
                                    onchange="window.location.href=this.value">

                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}">
                                    Newest First
                                </option>

                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}"
                                    {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                    Price: Low to High
                                </option>

                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}"
                                    {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                    Price: High to Low
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- Listings --}}
                    <div class="row g-3">

                        @forelse($listings as $listing)

                            <div class="col-12 col-sm-6 col-lg-4">
                                <a href="{{ route('listings.show', $listing->id) }}" class="text-decoration-none text-dark">
                                <article class="listing-card h-100">

                                    <div class="listing-image-wrapper">

                                        <img
                                            src="{{ $listing->images->first()
                                                ? asset('storage/' . $listing->images->first()->image)
                                                : 'https://placehold.net/600x600.png' }}"
                                            alt="{{ $listing->title }}"
                                            class="listing-image"
                                        >

                                        @if($listing['badge'])

                                            <span class="listing-badge
                                                {{ $listing['badge'] === 'Verified Seller'
                                                    ? 'badge-verified'
                                                    : 'badge-featured' }}">

                                                {{ $listing['badge'] }}

                                            </span>

                                        @endif


                                        <span class="photo-count">

                                            @if($listing->images->count() > 0)

                                                1/{{ $listing->images->count() }} Photos

                                            @else

                                                0 Photos

                                            @endif

                                        </span>

                                    </div>


                                    <div class="p-3 d-flex flex-column h-100">

                                        <div class="d-flex justify-content-between
                                                    align-items-start mb-1">

                                            <span class="listing-price">

                                                ₹ {{ number_format($listing['price'], 2) }}

                                            </span>

                                            <span class="condition-badge">

                                                {{ $listing->category->name }}

                                            </span>

                                        </div>


                                        <h3 class="listing-title mb-3">

                                            {{ $listing['title'] }}

                                        </h3>


                                        <div class="listing-meta pt-2 mt-auto
                                                    d-flex justify-content-between">

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
                                </a>

                            </div>

                        @empty

                            <div class="col-12 text-center py-5">

                                <span class="material-symbols-outlined text-muted"
                                    style="font-size:48px;">
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


                    {{-- Pagination --}}
                    @if($listings->hasPages())

                        <div class=" mt-4">

                            {{ $listings->withQueryString()->links('pagination::bootstrap-5') }}

                        </div>

                    @endif

                </section>

            </div>

        </div>

    </div>
 </div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const categorySelect = document.getElementById('category');
    const subcategorySelect = document.getElementById('subcategory');

    function filterSubcategories() {

        const categoryId = categorySelect.value;

        Array.from(subcategorySelect.options).forEach(option => {

            if (!option.value) {
                option.hidden = false;
                return;
            }

            option.hidden = option.dataset.category !== categoryId;
        });

        if (
            subcategorySelect.selectedOptions.length &&
            subcategorySelect.selectedOptions[0].hidden
        ) {
            subcategorySelect.value = '';
        }
    }

    categorySelect.addEventListener('change', filterSubcategories);

    filterSubcategories();

});
</script>
@endpush
