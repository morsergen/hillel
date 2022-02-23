<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (($handle = fopen(__DIR__ . '/csv/Products.csv', "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 2000)) !== FALSE)
            {
                Product::firstOrCreate([
                    'category_id' => $row[0],
                    'title' => $row[1],
                    'slug' => $row[2],
                    'description' => $row[3],
                    'short_description' => $row[4],
                    'sku' => $row[5],
                    'price' => $row[6],
                    'discount' => $row[7],
                    'in_stock' => $row[8],
                    'thumbnail' => $row[9],
                ]);
            }
            fclose($handle);
        }
    }
}
