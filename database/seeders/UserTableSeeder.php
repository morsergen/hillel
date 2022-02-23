<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'role_id' => Role::getAdminRole()->id,
            'name' => 'Sergey',
            'surname' => 'Moroz',
            'email' => 'morsergen@gmail.com',
            'birthdate' => '1979-10-03',
            'phone' => '+1111111111',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // password
        ]);
        User::factory(10)->create();
    }
}
