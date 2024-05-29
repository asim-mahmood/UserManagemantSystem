<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use App\Models\CustomersBills;

class PayAllBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bills:pay';

    protected $description = 'Pay all bills for active customers on the first day of the month';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all_customers = Customer::select('id', 'user_id', 'package_id')
            ->with(['package' => function ($query) {
                $query->select('id', 'price');
            }])
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->get();

        foreach ($all_customers as $customer) {
            $bill = new CustomersBills();

            $bill->customer_id = $customer->user_id;
            $bill->package_id = $customer->package_id;
            $bill->month = now()->format('F');
            $bill->amount = $customer->package->price;
            $bill->pending = $customer->package->price;

            $bill->save();
        }

        $this->info('All bills paid successfully.');
    }
}
