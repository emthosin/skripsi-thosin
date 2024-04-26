<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria = [
            [
                'code' => 'C1',
                'name' => 'Weekly Price in GBP',
                'type' => 'Cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C2',
                'name' => 'Contract Length',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C3',
                'name' => 'Bed Type',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C4',
                'name' => 'Bedroom Size',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C5',
                'name' => 'Bedrooms Facilities',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C6',
                'name' => 'Roomate',
                'type' => 'Cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C7',
                'name' => 'Kitchen Facilities',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C8',
                'name' => 'Shared Kitchenette',
                'type' => 'Cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C9',
                'name' => 'Number of Residence',
                'type' => 'Cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C10',
                'name' => 'Distance to Uni',
                'type' => 'Cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C11',
                'name' => 'Storage/Parking',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C12',
                'name' => 'On-Site Gym',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C13',
                'name' => 'Google Maps Review',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'C14',
                'name' => 'Google Maps Rating',
                'type' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Criteria::insert($criteria);
    }
}
