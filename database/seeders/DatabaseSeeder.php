<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()->call(RolesTableSeeder::class);
        app()->call(UserTableSeeder::class);
        app()->call(CategoriesTableSeeder::class);
        app()->call(OrderStatusesTableSeeder::class);
    }
}
