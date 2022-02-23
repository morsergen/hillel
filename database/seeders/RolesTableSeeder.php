<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Role::ALL_ROLES as $alias => $name) {
            Role::firstOrCreate([
                'name' => $name,
                'alias' => $alias
            ]);
        }
    }
}
