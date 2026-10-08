<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'name' => 'India',
                'code' => 'IN',
            ],
            [
                'name' => 'United States',
                'code' => 'US',
            ],
            [
                'name' => 'United Kingdom',
                'code' => 'GB',
            ],
            [
                'name' => 'Canada',
                'code' => 'CA',
            ],
            [
                'name' => 'Australia',
                'code' => 'AU',
            ],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                [
                    'code' => $country['code'],
                    'status' => true,
                ],
                [
                    'name' => $country['name'],
                ]
            );
        }
    }
}
