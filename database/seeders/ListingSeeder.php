<?php
namespace Database\Seeders;

use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Listing;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::with('subcategories')->get();

        if (! $user || $categories->isEmpty()) {
            return;
        }

        $products = [
            ['name' => 'iPhone 14 Pro', 'detail' => 'Excellent condition, all features working.', 'price' => 45000],
            ['name' => 'Samsung Galaxy S23', 'detail' => 'Well-maintained smartphone with original charger.', 'price' => 32000],
            ['name' => 'Dell Inspiron Laptop', 'detail' => 'Laptop suitable for office work and students.', 'price' => 28000],
            ['name' => 'Honda City 2020', 'detail' => 'Well-maintained car with service history.', 'price' => 650000],
            ['name' => 'Royal Enfield Classic 350', 'detail' => 'Good condition bike, ready to ride.', 'price' => 125000],
            ['name' => 'Wooden Study Table', 'detail' => 'Durable wooden table for home or office.', 'price' => 3500],
            ['name' => 'Office Chair', 'detail' => 'Comfortable ergonomic chair in good condition.', 'price' => 2500],
            ['name' => 'Sony LED Television', 'detail' => 'LED TV with clear picture and remote.', 'price' => 18000],
            ['name' => 'Canon DSLR Camera', 'detail' => 'Camera ideal for photography enthusiasts.', 'price' => 30000],
            ['name' => 'Gaming PC', 'detail' => 'Gaming desktop with dedicated graphics.', 'price' => 55000],
            ['name' => 'MacBook Air M2', 'detail' => 'Lightweight laptop for professional use.', 'price' => 65000],
            ['name' => 'Mountain Bicycle', 'detail' => 'Multi-speed bicycle in good condition.', 'price' => 8000],
            ['name' => 'Split Air Conditioner', 'detail' => 'Cooling efficiently, includes remote control.', 'price' => 22000],
            ['name' => 'Front Load Washing Machine', 'detail' => 'Fully automatic washing machine.', 'price' => 16000],
            ['name' => 'Modern Sofa Set', 'detail' => 'Comfortable sofa set for the living room.', 'price' => 18000],
            ['name' => 'Dining Table Set', 'detail' => 'Dining table with chairs for family use.', 'price' => 12000],
            ['name' => 'Bluetooth Speaker', 'detail' => 'Portable speaker with good sound quality.', 'price' => 1500],
            ['name' => 'Smart Watch', 'detail' => 'Smartwatch with fitness tracking features.', 'price' => 2200],
            ['name' => 'Commercial Shop for Rent', 'detail' => 'Commercial space suitable for a small business.', 'price' => 15000],
            ['name' => 'Website Development Service', 'detail' => 'Professional website development for businesses.', 'price' => 10000],
        ];

        $countries = Country::where('status', true)->where('code', 'IN')->get();

        if ($countries->isEmpty()) {
            return;
        }

        $locations = [];

        foreach ($countries as $country) {
            $states = State::where('country_id', $country->id)
                ->where('status', true)
                ->get();

            foreach ($states as $state) {
                $cities = City::where('state_id', $state->id)
                    ->where('status', true)
                    ->get();

                foreach ($cities as $city) {
                    $areas = Area::where('city_id', $city->id)
                        ->where('status', true)
                        ->get();

                    foreach ($areas as $area) {
                        $locations[] = [
                            'country_id' => $country->id,
                            'state_id' => $state->id,
                            'city_id' => $city->id,
                            'area_id' => $area->id,
                        ];
                    }
                }
            }
        }

        if (empty($locations)) {
            return;
        }

        foreach ($products as $product) {
            $category = $categories->random();

            $subcategory = $category->subcategories->isNotEmpty()
                ? $category->subcategories->random()
                : null;

            $location = $locations[array_rand($locations)];

            Listing::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'sub_category_id' => $subcategory?->id,
                'country_id' => $location['country_id'],
                'state_id' => $location['state_id'],
                'city_id' => $location['city_id'],
                'area_id' => $location['area_id'],
                'title' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['detail'],
                'price' => $product['price'],
            ]);
        }
    }
}
