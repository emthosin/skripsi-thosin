<?php

namespace Database\Seeders;

use App\Models\Matrix;
use Illuminate\Database\Seeder;

class MatrixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path('database/data/matrix.csv'), 'r');

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ';')) !== FALSE) {
            if (!$firstLine) {
                Matrix::create([
                    'id' => $data[0],
                    'alternative_id' => $data[1],
                    'criteria_id' => $data[2],
                    'value' => $data[3],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            $firstLine = false;
        }

        fclose($csvFile);
    }
}
