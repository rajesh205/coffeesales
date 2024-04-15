<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuration;

class ConfigurationsTableSeeder extends Seeder
{
    public function run()
    {
        Configuration::create(
                            [
                                'shipping_cost' => 10.00,
                            ]);
    }       
}