<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (($handle = fopen(__DIR__ . '/csv/Categories.csv', "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 2000)) !== FALSE)
            {
                Category::firstOrCreate([
                    'name' => $row[0],
                    'slug' => $row[1],
                    'description' => $row[2],
                ]);
            }
            fclose($handle);
        }
    }
}
