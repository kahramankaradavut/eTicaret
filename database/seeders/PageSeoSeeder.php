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
    }
}
