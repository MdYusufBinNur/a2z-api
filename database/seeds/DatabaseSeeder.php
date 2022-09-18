<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\DbModels\User::class, 100)->create()->each(function($u) {
//
//            // to avoid duplicate entries in user_roles table
//        repeat:
//            try {
//                factory(App\DbModels\UserRole::class)->create();
//            } catch (\Illuminate\Database\QueryException $e) {
//                goto repeat;
//            }
//        });

        $this->call([
            AllTypeUserSeeder::class,
        ]);

        factory(App\DbModels\Category::class, 10)->create();

        factory(App\DbModels\SubCategory::class, 100)->create();
        factory(App\DbModels\Brand::class, 20)->create();
        factory(App\DbModels\Vendor::class, 10)->create();
        factory(App\DbModels\AdAndSlider::class, 10)->create();
        factory(App\DbModels\ContentModule::class, 10)->create();

        $this->call([
            ProductSeeder::class,
        ]);

    }
}
