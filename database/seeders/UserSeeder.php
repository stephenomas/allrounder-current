<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@allrounder.com',
            'name' => 'Administrator',
            'phone' => '08138676164',
            'role' => 1,
            'position' => 'active',
            'password' => Hash::make('allrounder123'),

        ]);
    }
}
