<?php

namespace Database\Seeders;

use App\GenderEnum;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin 1',
            'email' => 'admin1@example.com',
            'password' => bcrypt('password123'),
            'phone' => '123456789',
            'gender' => GenderEnum::FEMALE,
            'birthday' => '1980-01-01',
        ]);

        DB::table('admins')->insert([
            'name' => 'Admin 2',
            'email' => 'admin2@example.com',
            'password' => bcrypt('password456'),
            'phone' => '987654321',
            'gender' => GenderEnum::MALE,
            'birthday' => '1990-05-15',
        ]);
    }
}
