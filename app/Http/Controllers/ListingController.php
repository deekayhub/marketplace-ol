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
use PHPUnit\Logging\OpenTestReporting\Status;
use Illuminate\Support\Str;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search');
        $city = $request->query('city');
        $listings = Listing::with(['category'])
            ->when($category, function ($query) use ($category) {
                $query->where('category_id', $category);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($city, function ($query) use ($city) {
                $query->where('city_id', $city);
            })
            ->latest()
            ->paginate(10);

        return view('listing.index', compact('listings'));
    }
    public function create()
    {
        $categories = Category::where('status', true)->get();
        $subcategories = SubCategory::where('status', true)->get();
        $countries = Country::where('status', true)->get();
        $states = State::where('status', true)->get();
        $cities = City::where('status', true)->get();
        $areas = Area::where('status', true)->get();


        return view('listing.create', compact('categories', 'subcategories', 'countries', 'states', 'cities', 'areas'));
    }

    public function store(Request $request)
    {
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
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $listing = Listing::create([
            'user_id' => auth()->id(),
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
            'status' => 'pending',
        ]);

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
            ->with('success', 'Your listing has been submitted successfully.');
    }
}
