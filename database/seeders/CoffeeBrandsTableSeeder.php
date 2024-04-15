<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoffeeBrand;

class CoffeeBrandsTableSeeder extends Seeder
{
    public function run()
    {
        $coffeeBrands = [
                            [
                                'brand_name' => 'Golden Coffee',
                                'profit_margin' => 0.25,
                            ],
                            [
                                'brand_name' => 'Arabic Coffee',
                                'profit_margin' => 0.15,
                            ]
                        ];
        CoffeeBrand::insert($coffeeBrands);
    }       
}