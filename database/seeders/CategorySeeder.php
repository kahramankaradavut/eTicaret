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
    //    $erkek = Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' => null,
    //         'name' => 'Erkek',
    //         'content' => 'Erkek Giyim',
    //         'status'=>'1'
    //     ]);


    //       Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' => $erkek->id,
    //         'name' => 'Erkek Kazak',
    //         'content' => 'Erkek Kazaklar',
    //         'status'=>'1'
    //     ]);

    //     Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' => $erkek->id,
    //         'name' => 'Erkek Pantolon',
    //         'content' => 'Erkek Pantolonlar',
    //         'status'=>'1'
    //     ]);


    //     $kadin = Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' => null,
    //         'name' => 'Kadın',
    //         'content' => 'Kadın Giyim',
    //         'status'=>'1'
    //     ]);

    //     Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' => $kadin->id,
    //         'name' => 'Kadın Çanta',
    //         'content' => 'Kadın Çantalar',
    //         'status'=>'1'
    //     ]);

    //     Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' => $kadin->id,
    //         'name' => 'Kadın Pantolon',
    //         'content' => 'Kadın Pantolonlar',
    //         'status'=>'1'
    //     ]);



    //     $cocuk = Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' => null,
    //         'name' => 'Çocuk',
    //         'content' => 'Çocuk Giyim',
    //         'status'=>'1'
    //     ]);


    //     Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' =>  $cocuk->id,
    //         'name' => 'Çocuk Oyuncaklar',
    //         'content' => 'Çocuk Oyuncaklar',
    //         'status'=>'1'
    //     ]);

    //     Category::create([
    //         'image' => null,
    //         'thumbnail' => null,
    //         'cat_ust' => $cocuk->id,
    //         'name' => 'Çocuk Pantolon',
    //         'content' => 'Çocuk Pantolonlar',
    //         'status'=>'1'
    //     ]);

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
