<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Listing;
use App\Models\State;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MyListingController extends Controller
{
    public function index()
    {
        $listings = Listing::where('user_id', auth()->id())->paginate(10);

        return view('my-listing.index', compact('listings'));
    }

    public function edit($id)
    {
        $categories = Category::where('status', true)->get();
        $subcategories = SubCategory::where('status', true)->get();
        $countries = Country::where('status', true)->get();
        $states = State::where('status', true)->get();
        $cities = City::where('status', true)->get();
        $areas = Area::where('status', true)->get();
        $listing = Listing::findOrFail($id);

        // Ensure the authenticated user is the owner of the listing
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('my-listing.edit', compact('listing', 'categories', 'subcategories', 'countries', 'states', 'cities', 'areas'));
    }


    public function update(Request $request, Listing $listing)
    {
        // Make sure the logged-in user can only edit their own listing
        abort_unless($listing->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'type' => ['required', 'in:product,service'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],

            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['nullable', 'exists:sub_categories,id'],

            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'area_id' => ['nullable', 'exists:areas,id'],

            'price' => ['required', 'numeric', 'min:0'],

            'images' => ['nullable', 'array'],
            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
        ]);

        $listing->update([
            'type' => $validated['type'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],

            'category_id' => $validated['category_id'],
            'sub_category_id' => $validated['subcategory_id'] ?? null,

            'country_id' => $validated['country_id'],
            'state_id' => $validated['state_id'],
            'city_id' => $validated['city_id'],
            'area_id' => $validated['area_id'] ?? null,

            'price' => $validated['price'],

            // Keep pending if admin needs to approve edited listing
            'status' => 'pending',
        ]);


        // Add new images
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('listings', 'public');

                $listing->images()->create([
                    'image' => $path,
                ]);
            }
        }


        return redirect()
            ->route('home')
            ->with('success', 'Your listing has been updated successfully.');
    }
}
