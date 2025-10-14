<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = District::all();
        foreach ($districts as $district) {
            Commune::factory(2)->create(['district_id' => $district->id]);
        }
    }
}
