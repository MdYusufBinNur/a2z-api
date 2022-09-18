<?php

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Seeder;

class AllTypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert a super admin user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Ismail Hossain', 'email' => 'admin@dbazar.xyz', 'phone' => "01822270500", 'locale' => 'en', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 1]);
        factory(App\DbModels\Admin::class)->create(['userId' => IdHashingHelper::decode($user->id), 'userRoleId' => IdHashingHelper::decode($userRoleId->id), 'level' => 'super_admin' ]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

        //insert a Standard admin user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Yusuf Bin Nur', 'email' => 'standard_admin@dbazar.xyz', 'phone' => "01822270501", 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 2]);
        factory(App\DbModels\Admin::class)->create(['userId' => IdHashingHelper::decode($user->id), 'userRoleId' =>  IdHashingHelper::decode($userRoleId->id), 'level' => 'standard_admin' ]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

        //insert a Limited admin user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Sarif Uddin Khan', 'email' => 'limited_admin@dbazar.xyz', 'phone' => "01822270502", 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 3]);
        factory(App\DbModels\Admin::class)->create(['userId' => IdHashingHelper::decode($user->id), 'userRoleId' => IdHashingHelper::decode($userRoleId->id), 'level' => 'limited_admin' ]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

        //insert a Standard staff user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Standard Staff', 'email' => 'standard_staff@dbazar.xyz', 'phone' => "01822270503", 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 4]);
        factory(App\DbModels\Staff::class)->create(['userId' => IdHashingHelper::decode($user->id), 'userRoleId' => IdHashingHelper::decode($userRoleId->id), 'level' => 'standard_staff', 'contactEmail' => 'standard_staff@dbazar.xyz', 'phone' => "01822270503"]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

        //insert a limited staff user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Limited Staff', 'email' => 'limited_staff@dbazar.xyz', 'phone' => "01822270504", 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 5]);
        factory(App\DbModels\Staff::class)->create(['userId' => IdHashingHelper::decode($user->id), 'userRoleId' => IdHashingHelper::decode($userRoleId->id), 'level' => 'limited_staff', 'contactEmail' => 'limited_staff@dbazar.xyz', 'phone' => "01822270504"]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

        //insert a star customer user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Star Customer', 'email' => 'star_customer@dbazar.xyz', 'phone' => "01822270505", 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 6]);
        factory(App\DbModels\Customer::class)->create(['name' => 'Star Customer', 'userId' => IdHashingHelper::decode($user->id), 'userRoleId' => IdHashingHelper::decode($userRoleId->id), 'level' => 'star_customer', 'email' => 'star_customer@dbazar.xyz', 'phone' => "01822270505" , 'isAgreeTC' => true]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

        //insert a general customer user
        $user = factory(App\DbModels\User::class)->create(['name' => 'General Customer', 'email' => 'general_customer@dbazar.xyz', 'phone' => "01822270506", 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 7]);
        factory(App\DbModels\Customer::class)->create(['name' => 'General Customer', 'userId' => IdHashingHelper::decode($user->id), 'userRoleId' => IdHashingHelper::decode($userRoleId->id), 'level' => 'general_customer', 'email' => 'general_customer@dbazar.xyz', 'phone' => "01822270506", 'isAgreeTC' => true]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

        //insert a standard vendor user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Vendor Standard', 'email' => 'standard_vendor@dbazar.xyz', 'phone' => "01822270507", 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 8]);
        factory(App\DbModels\Vendor::class)->create(['name' => 'Standard Vendor',  'userId' => IdHashingHelper::decode($user->id), 'type' => 'groceries', 'email' => 'standard_vendor@dbazar.xyz', 'phone' => "01822270507" ]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

        //insert a limited vendor user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Vendor Limited', 'email' => 'limited_vendor@dbazar.xyz', 'phone' => "01822270508", 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => IdHashingHelper::decode($user->id), 'roleId' => 9]);
        factory(App\DbModels\Vendor::class)->create(['name' => 'Limited Vendor', 'userId' => IdHashingHelper::decode($user->id), 'type' => 'groceries', 'email' => 'limited_vendor@dbazar.xyz', 'phone' => "01822270508"]);
        factory(App\DbModels\UserProfile::class)->create(['userId' => IdHashingHelper::decode($user->id), 'homeTown' => 'Chittagong']);

    }
}
