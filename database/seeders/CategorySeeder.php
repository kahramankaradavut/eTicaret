<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
            $altgiyim = Category::create([
                 'image' => null,
                 'thumbnail' => null,
                 'cat_ust' => null,
                 'name' => 'Alt Giyim',
                 'content' => 'Alt Giyim',
                 'status'=>'1'
             ]);

            $ustgiyim = Category::create([
                'image' => null,
                'thumbnail' => null,
                'cat_ust' => null,
                'name' => 'Ust Giyim',
                'content' => 'Üst Giyim',
                'status'=>'1'
            ]);

            $disgiyim = Category::create([
                'image' => null,
                'thumbnail' => null,
                'cat_ust' => null,
                'name' => 'Dış Giyim',
                'content' => 'Dış Giyim',
                'status'=>'1'
            ]);

            $takimlar = Category::create([
                'image' => null,
                'thumbnail' => null,
                'cat_ust' => null,
                'name' => 'Takımlar',
                'content' => 'Takımlar',
                'status'=>'1'
            ]);

            $aksesuar = Category::create([
                'image' => null,
                'thumbnail' => null,
                'cat_ust' => null,
                'name' => 'Aksesuar',
                'content' => 'Aksesuar',
                'status'=>'1'
            ]);

            $ayakkabi = Category::create([
                'image' => null,
                'thumbnail' => null,
                'cat_ust' => null,
                'name' => 'Ayakkabı',
                'content' => 'Ayakkabı',
                'status'=>'1'
            ]);
    }
}
