<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\CustomersBills;
use Illuminate\Console\Command;

class CheckBillingStatus extends Command
{
    protected $signature = 'billing:check';
    protected $description = 'Check billing dates and update paid_status if needed';

    public function handle()
    {
        $currentDate = now()->format('Y-m-d');
        $tomorrowDate = now()->addDay()->format('Y-m-d');
        $this->info("Current Date: $currentDate");

        // Preload latest bills for all customers
        $latestBills = CustomersBills::whereIn('customer_id', Customer::pluck('user_id'))
            ->where('is_deleted', 0)
            ->latest('billing_date')
            ->get()
            ->keyBy('customer_id');

        // Get customers whose billing date is today or before today or tomorrow
        $customersToUpdate = Customer::where(function ($query) use ($currentDate, $tomorrowDate) {
            $query->where('billing_date', '<=', $currentDate)
                ->orWhere('billing_date', $tomorrowDate)
                ->where('is_deleted', 0)
                ->where('is_active', 1);
        })
            ->get()
            ->filter(function ($customer) use ($currentDate, $tomorrowDate, $latestBills) {
                $latestBill = $latestBills[$customer->user_id] ?? null;
                // Check if the latest bill is for the current month and is unpaid
                return !$latestBill || Carbon::parse($latestBill->billing_date)->format('Y-m') < now()->format('Y-m') || $customer->paid_status !== 'Paid';
            });

        // dd($customersToUpdate->toArray());

        // Bulk update customers
        if ($customersToUpdate->isNotEmpty()) {
            $customersToUpdate->each(function ($customer) {
                $customer->update(['paid_status' => 'Expired']);
                $this->info("Updating paid_status for Customer ID: $customer->user_id");
            });
        }

        // Update tomorrow_expiry column for customers whose billing_date is tomorrow
        Customer::where('billing_date', $tomorrowDate)
            ->update(['paid_status' => 'Expiring']);

        // Update paid_status to null for customers whose billing_date is greater than tomorrow
        Customer::where('billing_date', '>', $tomorrowDate)
            ->where('paid_status', '<>', 'Paid')
            ->update(['paid_status' => null]);

        $this->info('Billing status checked successfully.');
    }
}
