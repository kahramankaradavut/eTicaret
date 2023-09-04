<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId = [1,2,3,4,5,6];
        $sizeList = ['XS','S','M','L','XXL'];
        $color = ['Beyaz','Siyah','Kahverengi','Mor'];

        $colortext = $color[random_int(0,3)];
        $size = $sizeList[random_int(0,4)];
        return [
            'name'=> $colortext.' '.$size. ' Urun',
            'category_id'=> $categoryId[random_int(0,5)],
            'short_text'=>  $categoryId[random_int(0,5)].' idli ürün',
            'price'=> random_int(10,500),
            'size'=>  $size,
            'color'=>  $colortext,
            'qty'=> 1,
            'status'=> '1',
            'content'=> 'Yazıları'
        ];
    }
}
