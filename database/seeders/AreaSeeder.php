<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [

            'Ludhiana' => [
                'Model Town',
                'Sarabha Nagar',
                'Pakhowal Road',
                'Ferozepur Road',
                'Civil Lines',
                'Dugri',
                'BRS Nagar',
                'Gill Road',
            ],

            'Mohali' => [
                'Phase 1',
                'Phase 3B2',
                'Phase 5',
                'Phase 7',
                'Sector 68',
                'Sector 70',
                'Sector 71',
                'Kharar Road',
            ],

            'Amritsar' => [
                'Ranjit Avenue',
                'Mall Road',
                'Majitha Road',
                'Lawrence Road',
                'GT Road',
            ],

            'Chandigarh' => [
                'Sector 17',
                'Sector 22',
                'Sector 34',
                'Sector 35',
                'Sector 43',
                'Manimajra',
            ],

            'New Delhi' => [
                'Connaught Place',
                'Karol Bagh',
                'Lajpat Nagar',
                'Saket',
                'Rohini',
                'Dwarka',
            ],

            'Gurugram' => [
                'DLF Phase 1',
                'DLF Phase 2',
                'DLF Phase 3',
                'Sector 14',
                'Sector 29',
                'Sector 49',
                'Golf Course Road',
            ],

            'Mumbai' => [
                'Andheri',
                'Bandra',
                'Borivali',
                'Dadar',
                'Powai',
                'Thane West',
            ],

            'Pune' => [
                'Kothrud',
                'Baner',
                'Hinjewadi',
                'Wakad',
                'Viman Nagar',
                'Kharadi',
            ],

            'Bengaluru' => [
                'Whitefield',
                'Koramangala',
                'Indiranagar',
                'HSR Layout',
                'Electronic City',
                'Marathahalli',
            ],

            'Hyderabad' => [
                'Banjara Hills',
                'Jubilee Hills',
                'Hitech City',
                'Madhapur',
                'Kondapur',
                'Gachibowli',
            ],

            'Ahmedabad' => [
                'Navrangpura',
                'Satellite',
                'Vastrapur',
                'Maninagar',
                'Bodakdev',
            ],

            'Jaipur' => [
                'Malviya Nagar',
                'Vaishali Nagar',
                'Mansarovar',
                'C-Scheme',
                'Jagatpura',
            ],

            'Lucknow' => [
                'Gomti Nagar',
                'Hazratganj',
                'Aliganj',
                'Indira Nagar',
                'Alambagh',
            ],

            'Chennai' => [
                'T Nagar',
                'Adyar',
                'Anna Nagar',
                'Velachery',
                'OMR',
            ],

            'Kolkata' => [
                'Salt Lake',
                'New Town',
                'Park Street',
                'Ballygunge',
                'Behala',
            ],

            'Kochi' => [
                'Kakkanad',
                'Edappally',
                'Vyttila',
                'Kaloor',
                'Fort Kochi',
            ],

            'Bhopal' => [
                'MP Nagar',
                'Arera Colony',
                'Kolar Road',
                'Shahpura',
            ],

            'Indore' => [
                'Vijay Nagar',
                'Palasia',
                'Rau',
                'Bhawarkua',
            ],

            'Patna' => [
                'Kankarbagh',
                'Boring Road',
                'Rajendra Nagar',
                'Patliputra Colony',
            ],

            'Dehradun' => [
                'Rajpur Road',
                'Clement Town',
                'Sahastradhara Road',
                'Vasant Vihar',
            ],

        ];

        foreach ($areas as $cityName => $areaNames) {

            $city = City::where('name', $cityName)->first();

            if (! $city) {
                continue;
            }

            foreach ($areaNames as $areaName) {

                Area::updateOrCreate(
                    [
                        'city_id' => $city->id,
                        'status' => true,
                    ],
                    [
                        'name' => $areaName,
                    ]
                );
            }
        }
    }
}
