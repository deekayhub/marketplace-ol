<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mobiles & Tablets',
                'description' => 'Buy and sell mobile phones, tablets and accessories.',
            ],
            [
                'name' => 'Electronics',
                'description' => 'Electronics, computers, gadgets and accessories.',
            ],
            [
                'name' => 'Vehicles',
                'description' => 'Cars, bikes, scooters and other vehicles.',
            ],
            [
                'name' => 'Real Estate',
                'description' => 'Properties, houses, apartments, plots and commercial spaces.',
            ],
            [
                'name' => 'Furniture',
                'description' => 'New and used furniture for home and office.',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Clothing, shoes, watches, bags and fashion accessories.',
            ],
            [
                'name' => 'Jobs',
                'description' => 'Job opportunities and employment listings.',
            ],
            [
                'name' => 'Services',
                'description' => 'Professional, home and local services.',
            ],
            [
                'name' => 'Books & Education',
                'description' => 'Books, study material, courses and educational products.',
            ],
            [
                'name' => 'Sports & Fitness',
                'description' => 'Sports equipment, fitness products and accessories.',
            ],
            [
                'name' => 'Home & Appliances',
                'description' => 'Home appliances, kitchen products and household items.',
            ],
            [
                'name' => 'Pets & Animals',
                'description' => 'Pets, pet products and animal-related listings.',
            ],
            [
                'name' => 'Business & Industrial',
                'description' => 'Business equipment, machinery and industrial products.',
            ],
            [
                'name' => 'Others',
                'description' => 'Other products and services.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                [
                    'slug' => Str::slug($category['name']),
                ],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'status' => true,
                ]
            );
        }
    }
}