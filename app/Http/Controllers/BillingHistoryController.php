<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomersBills;
use App\Models\Employee;
use Illuminate\Http\Request;
use stdClass;

class BillingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.billing_history');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBills($startData, $endDate)
    {
        try {
            $obj = new stdClass();

            $employees = Employee::select('id', 'name')->where('is_active', 1)->get();

            $customersBills = CustomersBills::select('id', 'customer_id', 'updated_at', 'billing_date', 'billed_by', 'amount', 'month', 'package_id', 'paid', 'pending')
                ->where('updated_at', '>=', $startData)
                ->where('updated_at', '<=', $endDate)
                ->where('is_deleted', 0)
                ->get();

            // Initialize an empty array to store modified bills
            $customerBillsArray = [];

            foreach ($customersBills as $bill) {
                // Retrieve the customer object for the current bill with selected columns
                $customer = Customer::select('id', 'user_name', 'user_id', 'package_id')->where('user_id', $bill->customer_id)->first();

                // Retrieve the package object for the current customer with selected columns
                if ($customer) {
                    $package = $customer->package()->select('id', 'speed', 'price')->first();
                }

                // Check if both customer and package exist
                if ($customer && $package) {
                    // Add customer and package objects to the bill
                    $bill->customer = $customer;
                    $bill->customer->package = $package;

                    // Add the modified bill to the array
                    $customerBillsArray[] = $bill;
                }
            }

            $obj->data = $customersBills;
            $obj->employees  = $employees;

            return response()->json($obj, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
