<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $india = Country::where('code', 'IN')->firstOrFail();

        $states = [
            'Andhra Pradesh',
            'Assam',
            'Bihar',
            'Chandigarh',
            'Chhattisgarh',
            'Delhi',
            'Goa',
            'Gujarat',
            'Haryana',
            'Himachal Pradesh',
            'Jharkhand',
            'Jammu and Kashmir',
            'Karnataka',
            'Kerala',
            'Madhya Pradesh',
            'Maharashtra',
            'Manipur',
            'Meghalaya',
            'Odisha',
            'Punjab',
            'Rajasthan',
            'Tamil Nadu',
            'Telangana',
            'Uttar Pradesh',
            'Uttarakhand',
            'West Bengal',
        ];

        foreach ($states as $stateName) {
            State::updateOrCreate(
                [
                    'country_id' => $india->id,
                    'name' => $stateName,
                ],
                [
                    'status' => true,
                ]
            );
        }
    }
}
