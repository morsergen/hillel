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
                    'id' => $row[0],
                    'name' => $row[1],
                    'slug' => $row[2],
                    'description' => $row[3],
                ]);
            }
            fclose($handle);
        }
    }
}
