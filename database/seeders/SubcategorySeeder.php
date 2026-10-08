<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $subcategories = [
            'Mobiles & Tablets' => [
                'Mobile Phones',
                'Smartphones',
                'Tablets',
                'iPhones',
                'Android Phones',
                'Mobile Accessories',
                'Smart Watches',
                'Mobile Parts',
            ],

            'Electronics' => [
                'Laptops',
                'Desktop Computers',
                'Computer Accessories',
                'Monitors',
                'Printers & Scanners',
                'Cameras',
                'TVs',
                'Audio & Speakers',
                'Gaming Consoles',
                'Other Electronics',
            ],

            'Vehicles' => [
                'Cars',
                'Motorcycles',
                'Scooters',
                'Bicycles',
                'Commercial Vehicles',
                'Trucks',
                'Spare Parts',
                'Car Accessories',
                'Vehicle Services',
            ],

            'Real Estate' => [
                'Apartments',
                'Houses',
                'Villas',
                'Plots & Land',
                'Commercial Property',
                'Office Space',
                'Shops',
                'PG & Hostels',
                'Rooms for Rent',
                'Property Services',
            ],

            'Furniture' => [
                'Sofa & Chairs',
                'Beds',
                'Tables',
                'Wardrobes',
                'Dining Furniture',
                'Office Furniture',
                'Kitchen Furniture',
                'Home Decor',
                'Mattresses',
                'Other Furniture',
            ],

            'Fashion' => [
                'Men Clothing',
                'Women Clothing',
                'Kids Clothing',
                'Shoes',
                'Watches',
                'Bags & Wallets',
                'Jewellery',
                'Accessories',
                'Beauty Products',
            ],

            'Jobs' => [
                'IT & Software Jobs',
                'Sales & Marketing Jobs',
                'Customer Service Jobs',
                'Accounting & Finance Jobs',
                'Teaching Jobs',
                'Driver Jobs',
                'Delivery Jobs',
                'Part Time Jobs',
                'Work From Home Jobs',
                'Other Jobs',
            ],

            'Services' => [
                'Web Development',
                'Graphic Design',
                'Digital Marketing',
                'Home Services',
                'Repair Services',
                'Cleaning Services',
                'Moving & Packing',
                'Photography & Video',
                'Event Services',
                'Tutoring & Education',
            ],

            'Books & Education' => [
                'Books',
                'School Books',
                'College Books',
                'Competitive Exam Books',
                'Study Material',
                'Courses',
                'Educational Equipment',
                'Stationery',
            ],

            'Sports & Fitness' => [
                'Gym Equipment',
                'Fitness Equipment',
                'Cricket',
                'Football',
                'Badminton',
                'Cycling',
                'Sports Shoes',
                'Sports Accessories',
                'Other Sports',
            ],

            'Home & Appliances' => [
                'Refrigerators',
                'Washing Machines',
                'Air Conditioners',
                'Microwave Ovens',
                'Kitchen Appliances',
                'Fans',
                'Water Purifiers',
                'Vacuum Cleaners',
                'Other Appliances',
            ],

            'Pets & Animals' => [
                'Dogs',
                'Cats',
                'Birds',
                'Fish',
                'Pet Accessories',
                'Pet Food',
                'Pet Services',
                'Other Animals',
            ],

            'Business & Industrial' => [
                'Machinery',
                'Industrial Equipment',
                'Shop Equipment',
                'Office Equipment',
                'Construction Equipment',
                'Restaurant Equipment',
                'Agricultural Equipment',
                'Business Services',
            ],

            'Others' => [
                'Other Products',
                'Other Services',
                'Miscellaneous',
            ],
        ];

        foreach ($subcategories as $categoryName => $names) {
            $category = Category::where('name', $categoryName)->first();

            if (! $category) {
                $this->command->warn("Category not found: {$categoryName}");
                continue;
            }

            foreach ($names as $name) {
                SubCategory::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'slug' => Str::slug($name),
                    ],
                    [
                        'name' => $name,
                        'status' => true,
                    ]
                );
            }
        }
    }
}
