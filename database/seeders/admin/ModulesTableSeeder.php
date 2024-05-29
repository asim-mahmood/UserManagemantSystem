<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            array('parent_id' => '0','name' => 'Dashboard','route' => '/admin/dashboard','head_name' => '','icon' => 'fas fa-home'),
            array('parent_id' => '0','name' => 'Reservations','route' => '/admin/reservations','head_name' => '','icon' => 'fas fa-file-invoice-dollar'),
            array('parent_id' => '0','name' => 'Customers','route' => '/admin/customers','head_name' => '','icon' => 'fas fa-money-check'),
            array('parent_id' => '0','name' => 'Database','route' => '/admin/databases','head_name' => '','icon' => 'fas fa-project-diagram'),
            array('parent_id' => '0','name' => 'Fare Quotes','route' => '/admin/fare/quotes','head_name' => '','icon' => 'fas fa-dolly-flatbed'),
            array('parent_id' => '0','name' => 'Advertisement','route' => '/admin/advertisement','head_name' => '','icon' => 'fas fa-file-import'),
            array('parent_id' => '0','name' => 'Reports','route' => '/admin/reports','head_name' => '','icon' => 'fas fa-file-invoice-dollar'),
            array('parent_id' => '0','name' => 'Accounting','route' => '/admin/accounting','head_name' => '','icon' => 'fas fa-users-cog'),
            array('parent_id' => '0','name' => 'Management','route' => '/admin/management','head_name' => 'Management','icon' => ''),
            array('parent_id' => '9','name' => 'Drivers','route' => '/admin/management/drivers','head_name' => '','icon' => ''),
            array('parent_id' => '9','name' => 'Driver Categories','route' => '/admin/management/driver-categories','head_name' => '','icon' => ''),
            array('parent_id' => '9','name' => 'Coupon','route' => '/admin/management/coupons','head_name' => '','icon' => ''),
            array('parent_id' => '9','name' => 'Airlines','route' => '/admin/management/airlines','head_name' => '','icon' => ''),
            array('parent_id' => '9','name' => 'Vehicle Make','route' => '/admin/management/vehicle_makes','head_name' => NULL,'icon' => NULL),
            array('parent_id' => '9','name' => 'Vehicle Types','route' => '/admin/management/vehicles','head_name' => NULL,'icon' => NULL),
            array('parent_id' => '9','name' => 'Countries','route' => '/admin/management/countries','head_name' => '','icon' => ''),
            array('parent_id' => '9','name' => 'Services','route' => '/admin/management/services','head_name' => '','icon' => ''),
            array('parent_id' => '9','name' => 'States/Province','route' => '/admin/management/states','head_name' => 'Management','icon' => NULL),
            array('parent_id' => '9','name' => 'Cities','route' => '/admin/management/cities','head_name' => 'Management','icon' => ''),
            array('parent_id' => '9','name' => 'Zip Codes','route' => '/admin/management/zip_codes','head_name' => 'Management','icon' => ''),
            array('parent_id' => '9','name' => 'Airports','route' => '/admin/management/airports','head_name' => '','icon' => ''),
            array('parent_id' => '9','name' => 'CMS','route' => '/admin/management/cms','head_name' => '','icon' => ''),
            array('parent_id' => '0','name' => 'Employee Categories','route' => '/admin/employee-categories','head_name' => '','icon' => 'fas fa-building'),
            array('parent_id' => '0','name' => 'Home Sliders','route' => '/admin/home-sliders','head_name' => '','icon' => 'fas fa-sliders-h'),
            array('parent_id' => '0','name' => 'Features','route' => '/admin/features','head_name' => '','icon' => 'fas fa-file-alt'),
            array('parent_id' => '0','name' => 'FAQs','route' => '/admin/faqs','head_name' => '','icon' => 'fas fa-question-circle'),
            array('parent_id' => '2','name' => 'Listing','route' => '/admin/reservations/listing','head_name' => '','icon' => ''),
            array('parent_id' => '3','name' => 'Listing','route' => '/admin/customers/listing','head_name' => '','icon' => ''),
            array('parent_id' => '9','name' => 'Hotels','route' => '/admin/management/hotels','head_name' => 'Management','icon' => NULL),
            array('parent_id' => '9','name' => 'Phones','route' => '/admin/management/phones','head_name' => 'Management','icon' => NULL),
            array('parent_id' => '9','name' => 'Flight destinations','route' => '/admin/management/flight-destinations','head_name' => 'Management','icon' => NULL),
            array('parent_id' => '9','name' => 'Employees','route' => '/admin/management/employees','head_name' => NULL,'icon' => NULL),
            array('parent_id' => '0','name' => 'Settings','route' => '/admin/setting','head_name' => 'Settings','icon' => NULL),
            array('parent_id' => '33','name' => 'SVCs','route' => '/admin/setting/svcs','head_name' => NULL,'icon' => NULL),
            array('parent_id' => '33','name' => 'Other Charges','route' => '/admin/setting/other_charges','head_name' => NULL,'icon' => NULL),
            array('parent_id' => '33','name' => 'Discount Rules','route' => '/admin/setting/discount_rules','head_name' => NULL,'icon' => NULL),
            array('parent_id' => '33','name' => 'Ptop Settings','route' => '/admin/setting/ptop_settings','head_name' => NULL,'icon' => NULL),
            array('parent_id' => '33','name' => 'Pay Type','route' => '/admin/setting/pay_types','head_name' => NULL,'icon' => NULL)
        ]);
    }
}
