<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category1 = Category::create([
            'name' => 'Electronics',
            'description' => 'Devices and gadgets.',
            'flag' => 1,
            'banner' => 'path_to_banner_image_1.jpg',
        ]);
        Category::create([
            'name' => 'Mobile Phones',
            'description' => 'Smartphones and mobile devices.',
            'flag' => 1,
            'parent_id' => $category1->id,
            'banner' => 'path_to_banner_image_2.jpg',
        ]);
        $category2 = Category::create([
            'name' => 'Books',
            'description' => 'Different genres of books.',
            'flag' => 1,
            'banner' => 'path_to_banner_image_3.jpg',
        ]);
        Category::create([
            'name' => 'Fiction',
            'description' => 'Fiction books and novels.',
            'flag' => 1,
            'parent_id' => $category2->id,
            'banner' => 'path_to_banner_image_4.jpg',
        ]);
    }
}
