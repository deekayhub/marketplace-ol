<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Listing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('listings')->where('status', true)->get();
        $cities = City::where('status', true)->get();

        $listings = Listing::with('category', 'images')->where('status', true)->latest()->take(10)->get();
        return view('homepage', compact('categories', 'listings', 'cities'));
    }
}
