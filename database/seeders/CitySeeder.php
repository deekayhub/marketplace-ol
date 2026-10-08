<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Punjab' => [
                'Ludhiana',
                'Amritsar',
                'Jalandhar',
                'Patiala',
                'Mohali',
                'Bathinda',
            ],

            'Haryana' => [
                'Gurugram',
                'Faridabad',
                'Panipat',
                'Ambala',
                'Hisar',
                'Rohtak',
            ],

            'Delhi' => [
                'New Delhi',
                'Delhi',
            ],

            'Maharashtra' => [
                'Mumbai',
                'Pune',
                'Nagpur',
                'Nashik',
                'Thane',
            ],

            'Karnataka' => [
                'Bengaluru',
                'Mysuru',
                'Mangaluru',
                'Hubballi',
            ],

            'Gujarat' => [
                'Ahmedabad',
                'Surat',
                'Vadodara',
                'Rajkot',
            ],

            'Rajasthan' => [
                'Jaipur',
                'Jodhpur',
                'Udaipur',
                'Kota',
            ],

            'Uttar Pradesh' => [
                'Lucknow',
                'Noida',
                'Ghaziabad',
                'Kanpur',
                'Agra',
                'Varanasi',
            ],

            'Tamil Nadu' => [
                'Chennai',
                'Coimbatore',
                'Madurai',
                'Salem',
            ],

            'Telangana' => [
                'Hyderabad',
                'Warangal',
            ],

            'West Bengal' => [
                'Kolkata',
                'Howrah',
            ],

            'Kerala' => [
                'Kochi',
                'Thiruvananthapuram',
                'Kozhikode',
            ],

            'Madhya Pradesh' => [
                'Bhopal',
                'Indore',
                'Gwalior',
                'Jabalpur',
            ],

            'Bihar' => [
                'Patna',
                'Gaya',
                'Muzaffarpur',
            ],

            'Goa' => [
                'Panaji',
                'Margao',
            ],

            'Chhattisgarh' => [
                'Raipur',
                'Bhilai',
            ],

            'Odisha' => [
                'Bhubaneswar',
                'Cuttack',
                'Rourkela',
            ],

            'Uttarakhand' => [
                'Dehradun',
                'Haridwar',
                'Nainital',
            ],

            'Himachal Pradesh' => [
                'Shimla',
                'Dharamshala',
                'Solan',
            ],

            'Jharkhand' => [
                'Ranchi',
                'Jamshedpur',
                'Dhanbad',
            ],

            'Assam' => [
                'Guwahati',
                'Dibrugarh',
            ],

            'Andhra Pradesh' => [
                'Visakhapatnam',
                'Vijayawada',
                'Tirupati',
            ],
        ];

        foreach ($cities as $stateName => $cityNames) {

            $state = State::where('name', $stateName)->first();

            if (! $state) {
                continue;
            }

            foreach ($cityNames as $cityName) {
                City::updateOrCreate(
                    [
                        'state_id' => $state->id,
                        'name' => $cityName,
                    ],
                    [
                        'status' => true,
                    ]
                );
            }
        }
    }
}
