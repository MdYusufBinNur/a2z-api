<?php

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\DbModels\Product::class, 100)->create()->each(function ($product) {
            $faker = \Faker\Factory::create();
            factory(\App\DbModels\ProductStock::class, 1)->create([
                'productId' => IdHashingHelper::decode($product->id),
                'createdByUserId' => 1,
                'price' => $faker->numberBetween(10, 10000),
                'oldPrice' => 0,
                'availableQuantity' => $faker->numberBetween(10, 100),
                'status' => 'available',
                'type' => $faker->randomElement(array('unit','kg')),
            ]);
        });
    }
}
