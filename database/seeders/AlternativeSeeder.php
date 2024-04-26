<?php

namespace Database\Seeders;

use App\Models\Alternative;
use Illuminate\Database\Seeder;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alternative = [
            [
                'code' => 'A1',
                'name' => 'Bishop Gate (Undergraduate) Ensuite 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A2',
                'name' => 'Bishop Gate (Undergraduate) Ensuite 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A3',
                'name' => 'Bishop Gate (Undergraduate) Standard Studio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A4',
                'name' => 'Bishop Gate (Undergraduate) Twudio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A5',
                'name' => 'Bishop Gate (Postgraduate) Ensuite',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A6',
                'name' => 'Bishop Gate (Postgraduate) Standard Studio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A7',
                'name' => 'Bishop Gate (Postgraduate) Premium Studio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A8',
                'name' => 'Bishop Gate (Postgraduate) Deluxe Studio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A9',
                'name' => 'Godiva Place (Undergraduate) Ensuite 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A10',
                'name' => 'Godiva Place (Undergraduate) Ensuite 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A11',
                'name' => 'Godiva Place (Undergraduate) Studio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A12',
                'name' => 'Godiva Place (Undergraduate) Twudio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A13',
                'name' => 'Godiva Place (Postgraduate) Ensuite',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A14',
                'name' => 'Godiva Place (Postgraduate) Standard Studio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A15',
                'name' => 'Singer Hall (Undergraduate) Standard Bedroom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A16',
                'name' => 'Singer Hall (Undergraduate) Premium Room',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A17',
                'name' => 'Singer Hall (Postgraduate) Standard bedroom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A18',
                'name' => 'The Cycle Works (Undergraduate) Ensuite 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A19',
                'name' => 'The Cycle Works (Undergraduate) Ensuite 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A20',
                'name' => 'The Cycle Works (Postgraduate) Standard Studio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A21',
                'name' => 'The Cycle Works (Postgraduate) Premium Studio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A22',
                'name' => 'Parish Rooms (Postgraduate) Standard Bedroom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'A23',
                'name' => 'Parish Rooms (Postgraduate) Single Ensuite',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Alternative::insert($alternative);
    }
}
