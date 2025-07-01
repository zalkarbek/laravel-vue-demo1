<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    public function run(): void
    {
        $file = storage_path('app/houses.csv');
        if (!file_exists($file)) {
            echo "Файл не найден: $file";
            return;
        }

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {
            DB::table('houses')->insert([
                'name'      => $row[0], // Name
                'price'     => $row[1], // Price
                'bedrooms'  => $row[2], // Bedrooms
                'bathrooms' => $row[3], // Bathrooms
                'storeys'   => $row[4], // Storeys
                'garages'   => $row[5], // Garages
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
        }
        fclose($handle);
    }
}
