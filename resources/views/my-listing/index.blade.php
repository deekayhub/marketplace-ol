@extends('layouts.app')
@section('title', 'my-listing')
@section('content')

<div class="container">
    <section class="mb-5">

        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
            <div>
                <h2 class="h4 fw-bold mb-1">
                    <span class="material-symbols-outlined text-warning align-middle">
                        local_fire_department
                    </span>
                    My Listings
                </h2>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="table-light">
                    <tr>
                        <th width="80">Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th width="130">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($listings as $listing)

                        <tr>
                            {{-- Image --}}
                            <td>
                                <img
                                    src="{{ $listing->images->first()
                                        ? asset('storage/' . $listing->images->first()->image)
                                        : 'https://placehold.net/600x600.png' }}"
                                    alt="{{ $listing->title ?? 'Listing Image' }}"
                                    width="60"
                                    height="60"
                                    class="rounded object-fit-cover"
                                >
                            </td>

                            {{-- Title --}}
                            <td style="max-width: 250px;">
                                <a
                                    href="{{ route('listings.show', $listing->id) }}"
                                    class="text-decoration-none text-dark fw-semibold"
                                    title="{{ $listing->title }}"
                                >
                                    {{ Str::limit($listing->title, 40) }}
                                </a>
                            </td>

                            {{-- Category --}}
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $listing->category?->name ?? 'N/A' }}
                                </span>
                            </td>

                            {{-- Price --}}
                            <td class="fw-semibold text-nowrap">
                                ₹ {{ number_format($listing->price, 2) }}
                            </td>

                            {{-- Location --}}
                            <td style="max-width: 180px;">
                                <span class="material-symbols-outlined align-middle"
                                      style="font-size:16px;">
                                    location_on
                                </span>

                                <span title="{{ $listing->location }}">
                                    {{ Str::limit($listing->location, 25) }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($listing['badge'])
                                    <span class="badge
                                        {{ $listing['badge'] === 'Verified Seller'
                                            ? 'bg-success'
                                            : 'bg-warning text-dark' }}">
                                        {{ $listing['badge'] }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- Time --}}
                            <td class="text-nowrap">
                                {{ $listing['time'] }}
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="d-flex gap-1">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('listings.show', $listing->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="View"
                                    >
                                        <span class="material-symbols-outlined"
                                              style="font-size:18px;">
                                            visibility
                                        </span>
                                    </a>

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('listings.edit', $listing->id) }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Edit"
                                    >
                                        <span class="material-symbols-outlined"
                                              style="font-size:18px;">
                                            edit
                                        </span>
                                    </a>

                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('listings.destroy', $listing->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this listing?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete"
                                        >
                                            <span class="material-symbols-outlined"
                                                  style="font-size:18px;">
                                                delete
                                            </span>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <span class="material-symbols-outlined fs-1 text-muted">
                                    inventory_2
                                </span>

                                <p class="text-muted mb-0 mt-2">
                                    No listings available.
                                </p>
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        @if($listings->hasPages())

            <div class=" mt-4">

                {{ $listings->links('pagination::bootstrap-5') }}

            </div>

        @endif

    </section>
</div>

@endsection
