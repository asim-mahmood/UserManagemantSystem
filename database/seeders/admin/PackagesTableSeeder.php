<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            array('name' => NULL, 'speed' => '2 Mbps', 'cost' => '800.00', 'price' => '1000.00'),
            array('name' => NULL, 'speed' => '3 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '4 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '5 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => 'Student', 'speed' => '5 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '6 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '8 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '10 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '12 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '15 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '25 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => '1+2', 'speed' => '3 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => '2+4', 'speed' => '6 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => '3+5', 'speed' => '8 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => '4+6', 'speed' => '10 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '16 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => '1+3', 'speed' => '4 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => NULL, 'speed' => '30 Mbps', 'cost' => '1000.00', 'price' => '1200.00'),
            array('name' => 'Unknown', 'speed' => '-- Mbps', 'cost' => '1000.00', 'price' => '1200.00')
        ]);
    }
}
