<?php

namespace Database\Seeders;

use App\Models\PageSeo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageSeo::create([
            'dil' => 'tr',
            'page' => 'anasayfa',
            'page_ust' => '',
            'title' => 'E-Ticaret anasayfa',
            'description' => 'E-Ticaret anasayfa description',
            'keywords' => 'E-Ticaret anasayfa keywords',
            'contents' => 'E-Ticaret anasayfa contents',
        ]);

        PageSeo::create([
            'dil' => 'tr',
            'page' => 'urunler',
            'page_ust' => '',
            'title' => 'E-Ticaret ürünler',
            'description' => 'E-Ticaret ürünler description',
            'keywords' => 'E-Ticaret ürünler keywords',
            'contents' => 'E-Ticaret ürünler contents',
        ]);

        PageSeo::create([
            'dil' => 'tr',
            'page' => 'hakkimizda',
            'page_ust' => '',
            'title' => 'E-Ticaret hakkımızda',
            'description' => 'E-Ticaret hakkımızda description',
            'keywords' => 'E-Ticaret hakkımızda keywords',
            'contents' => 'E-Ticaret hakkımızda contents',
        ]);

        PageSeo::create([
            'dil' => 'tr',
            'page' => 'iletisim',
            'page_ust' => '',
            'title' => 'E-Ticaret iletişim',
            'description' => 'E-Ticaret iletişim description',
            'keywords' => 'E-Ticaret iletişim keywords',
            'contents' => 'E-Ticaret iletişim contents',
        ]);

    }
}
