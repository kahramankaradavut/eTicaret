<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Slider::create([
                'image' => 'images/hero_1.jpg',
                'name' => 'PiriSoft',
                'content' => 'Eticaret sitemize hoşgeldiniz',
                'link'=> 'urunler',
                'status'=>'1'
            ]);
    }
}
