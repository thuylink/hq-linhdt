<?php

namespace Database\Seeders;

use App\GenderEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password123'),
            'phone' => '123456789',
            'gender' => GenderEnum::FEMALE,
            'birthday' => '1980-01-01',
        ]);

        
    }
}
