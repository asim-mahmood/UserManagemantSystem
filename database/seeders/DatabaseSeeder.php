<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\admin\UsersTableSeeder;
use Database\Seeders\admin\CustomorsTableSeeder;
use Database\Seeders\admin\PackagesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            //Admin Classes

            // DriversTableSeeder::class,
            // DriverCategoryTableSeeder::class,
            // EmployeesTableSeeder::class,
            // CountriesTableSeeder::class,
            // StatesTableSeeder::class,
            // CitiesTableSeeder::class,
            // ZipCodesTableSeeder::class,
            // ServicesTableSeeder::class,
            // OtherChargesTable::class,
            // VehiclesTableSeeder::class,
            // VehiclesMakeTableSeeder::class,
            // CouponsTableSeeder::class,
            // TimelyAdditionalChargesTable::class,
            // TimelyAdditionalChargesTable::class,
            // TravellerTypesSeeder::class,
            // ModulesTableSeeder::class,
            UsersTableSeeder::class,
            CustomorsTableSeeder::class,
            PackagesTableSeeder::class,
        ]);
    }
}
