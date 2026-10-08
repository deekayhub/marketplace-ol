@extends('layouts.app')

@section('title', 'Post a Listing')

@section('content')

<div class="bg-light min-vh-100 py-3">

<div class="container px-3 px-lg-4">

    <div class="mb-3">
        <h1 class="h4 fw-bold mb-1">Post a Listing</h1>
        <p class="text-secondary small mb-0">
            Add your product or service.
        </p>
    </div>

    <form action="{{ route('listings.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row g-3">

            {{-- LEFT COLUMN --}}
            <div class="col-lg-8">

                {{-- BASIC INFORMATION --}}
                <div class="card border-0 shadow-sm mb-3">

                    <div class="card-header bg-white border-bottom px-3 py-2">
                        <h2 class="h6 fw-bold mb-0">Basic Information</h2>
                    </div>

                    <div class="card-body p-3">

                        <div class="row g-3">

                            {{-- Listing Type --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold mb-2">
                                    Listing Type
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="row g-2">

                                    <div class="col-md-6">

                                        <input
                                            type="radio"
                                            class="btn-check"
                                            name="type"
                                            id="type_product"
                                            value="product"
                                            {{ old('type', 'product') === 'product' ? 'checked' : '' }}
                                        >

                                        <label
                                            class="btn btn-outline-primary w-100 py-2"
                                            for="type_product"
                                        >
                                            <i class="bi bi-box-seam me-1"></i>
                                            Product
                                        </label>

                                    </div>

                                    <div class="col-md-6">

                                        <input
                                            type="radio"
                                            class="btn-check"
                                            name="type"
                                            id="type_service"
                                            value="service"
                                            {{ old('type') === 'service' ? 'checked' : '' }}
                                        >

                                        <label
                                            class="btn btn-outline-primary w-100 py-2"
                                            for="type_service"
                                        >
                                            <i class="bi bi-tools me-1"></i>
                                            Service
                                        </label>

                                    </div>

                                </div>

                                @error('type')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Title --}}
                            <div class="col-12">

                                <label for="title" class="form-label fw-semibold">
                                    Title
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="e.g. iPhone 15 Pro 256GB"
                                    maxlength="150"
                                    required
                                >

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Description --}}
                            <div class="col-12">

                                <label for="description" class="form-label fw-semibold">
                                    Description
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea
                                    name="description"
                                    id="description"
                                    rows="4"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Describe your product or service..."
                                    required
                                >{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>
                </div>


                {{-- CATEGORY --}}
                <div class="card border-0 shadow-sm mb-3">

                    <div class="card-header bg-white border-bottom px-3 py-2">
                        <h2 class="h6 fw-bold mb-0">Category</h2>
                    </div>

                    <div class="card-body p-3">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label for="category_id"
                                       class="form-label fw-semibold">
                                    Category
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="category_id"
                                    id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">Select category</option>

                                    @foreach($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label for="subcategory_id"
                                       class="form-label fw-semibold">
                                    Subcategory
                                </label>

                                <select
                                    name="subcategory_id"
                                    id="subcategory_id"
                                    class="form-select @error('subcategory_id') is-invalid @enderror"
                                >

                                    <option value="">Select subcategory</option>

                                    @foreach($subcategories ?? [] as $subcategory)

                                        <option
                                            value="{{ $subcategory->id }}"
                                            data-category="{{ $subcategory->category_id }}"
                                            {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}
                                        >
                                            {{ $subcategory->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('subcategory_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>
                </div>


                {{-- LOCATION --}}
                <div class="card border-0 shadow-sm mb-3">

                    <div class="card-header bg-white border-bottom px-3 py-2">
                        <h2 class="h6 fw-bold mb-0">Location</h2>
                    </div>

                    <div class="card-body p-3">

                        <div class="row g-3">

                            {{-- Country --}}
                            <div class="col-md-6">

                                <label for="country_id"
                                       class="form-label fw-semibold">
                                    Country
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="country_id"
                                    id="country_id"
                                    class="form-select @error('country_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">Select country</option>

                                    @foreach($countries as $country)

                                        <option
                                            value="{{ $country->id }}"
                                            {{ old('country_id') == $country->id ? 'selected' : '' }}
                                        >
                                            {{ $country->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('country_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- State --}}
                            <div class="col-md-6">

                                <label for="state_id"
                                       class="form-label fw-semibold">
                                    State
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="state_id"
                                    id="state_id"
                                    class="form-select @error('state_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">Select state</option>

                                    @foreach($states ?? [] as $state)

                                        <option
                                            value="{{ $state->id }}"
                                            data-country="{{ $state->country_id }}"
                                            {{ old('state_id') == $state->id ? 'selected' : '' }}
                                        >
                                            {{ $state->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('state_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- City --}}
                            <div class="col-md-6">

                                <label for="city_id"
                                       class="form-label fw-semibold">
                                    City
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="city_id"
                                    id="city_id"
                                    class="form-select @error('city_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">Select city</option>

                                    @foreach($cities ?? [] as $city)

                                        <option
                                            value="{{ $city->id }}"
                                            data-state="{{ $city->state_id }}"
                                            {{ old('city_id') == $city->id ? 'selected' : '' }}
                                        >
                                            {{ $city->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('city_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Area --}}
                            <div class="col-md-6">

                                <label for="area_id"
                                       class="form-label fw-semibold">
                                    Area
                                </label>

                                <select
                                    name="area_id"
                                    id="area_id"
                                    class="form-select @error('area_id') is-invalid @enderror"
                                >

                                    <option value="">Select area</option>

                                    @foreach($areas ?? [] as $area)

                                        <option
                                            value="{{ $area->id }}"
                                            data-city="{{ $area->city_id }}"
                                            {{ old('area_id') == $area->id ? 'selected' : '' }}
                                        >
                                            {{ $area->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('area_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>
                </div>

            </div>


            {{-- RIGHT COLUMN --}}
            <div class="col-lg-4">

                {{-- PRICE --}}
                <div class="card border-0 shadow-sm mb-3">

                    <div class="card-header bg-white border-bottom px-3 py-2">
                        <h2 class="h6 fw-bold mb-0">Price</h2>
                    </div>

                    <div class="card-body p-3">

                        <label for="price"
                               class="form-label fw-semibold">
                            Price
                            <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">₹</span>

                            <input
                                type="number"
                                name="price"
                                id="price"
                                value="{{ old('price') }}"
                                min="0"
                                step="0.01"
                                class="form-control @error('price') is-invalid @enderror"
                                placeholder="0.00"
                                required
                            >

                        </div>

                        @error('price')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </div>


                {{-- PHOTOS --}}
                <div class="card border-0 shadow-sm mb-3">

                    <div class="card-header bg-white border-bottom px-3 py-2">
                        <h2 class="h6 fw-bold mb-0">Photos</h2>
                    </div>

                    <div class="card-body p-3">

                        <label for="images"
                               class="form-label fw-semibold">
                            Upload Images
                        </label>

                        <input
                            type="file"
                            name="images[]"
                            id="images"
                            class="form-control @error('images') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/webp"
                            multiple
                        >

                        <div class="form-text">
                            JPG, PNG or WebP · Max 2MB each
                        </div>

                        @error('images')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        @error('images.*')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </div>


                {{-- ACTIONS --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body p-3">

                        <div class="d-flex gap-2">

                            <a href="{{ url('/my-listings') }}"
                               class="btn btn-light border flex-fill">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-primary flex-fill">

                                <i class="bi bi-check-lg me-1"></i>
                                Publish

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

</div>

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const categorySelect = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');

    const countrySelect = document.getElementById('country_id');
    const stateSelect = document.getElementById('state_id');

    const citySelect = document.getElementById('city_id');
    const areaSelect = document.getElementById('area_id');


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


    function filterStates() {

        const countryId = countrySelect.value;

        Array.from(stateSelect.options).forEach(option => {

            if (!option.value) {
                option.hidden = false;
                return;
            }

            option.hidden = option.dataset.country !== countryId;

        });

        if (
            stateSelect.selectedOptions.length &&
            stateSelect.selectedOptions[0].hidden
        ) {
            stateSelect.value = '';
        }

        filterCities();
    }


    function filterCities() {

        const stateId = stateSelect.value;

        Array.from(citySelect.options).forEach(option => {

            if (!option.value) {
                option.hidden = false;
                return;
            }

            option.hidden = option.dataset.state !== stateId;

        });

        if (
            citySelect.selectedOptions.length &&
            citySelect.selectedOptions[0].hidden
        ) {
            citySelect.value = '';
        }

        filterAreas();
    }


    function filterAreas() {

        const cityId = citySelect.value;

        Array.from(areaSelect.options).forEach(option => {

            if (!option.value) {
                option.hidden = false;
                return;
            }

            option.hidden = option.dataset.city !== cityId;

        });

        if (
            areaSelect.selectedOptions.length &&
            areaSelect.selectedOptions[0].hidden
        ) {
            areaSelect.value = '';
        }
    }


    categorySelect.addEventListener('change', filterSubcategories);
    countrySelect.addEventListener('change', filterStates);
    stateSelect.addEventListener('change', filterCities);
    citySelect.addEventListener('change', filterAreas);


    filterSubcategories();
    filterStates();

});
</script>

@endpush

@endsection
