<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use App\Models\User;
use App\Models\Package;
use App\Models\Accounts;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomersBills;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users');
    }
    public function index2($type = null)
    {
        // dd($type);

        // $currentMonth = date('m');

        // $bills = CustomersBills::where('customer_id', '30nb-jahanzaib')
        //     ->where('is_deleted', 0)
        //     ->whereMonth('created_at', '!=', $currentMonth)
        //     ->get();


        // return $bills;

        // return $customersQuery->toSql();

        return view('admin.real_users')->with('type', $type);
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
        // dd('here', $request->billing_date);
        try {
            $customer = new Customer();

            $customer->user_id = $request->user_id;
            $customer->franchise_id = $request->franchise_id;
            $customer->user_name = $request->user_name;
            $customer->father_name = $request->father_name;
            $customer->cnic = $request->cnic;
            $customer->mobile_number = $request->mobile_number;
            $customer->mobile_number2 = $request->mobile_number2;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->package_type = $request->package_type;
            $customer->package_id = $request->package_id;
            $customer->price = $request->price;
            $customer->installation_charges = $request->installation_charges;
            $customer->device_charges = $request->device_charges;
            $customer->security = $request->security;
            $customer->total_bill = $request->total_bill;
            $customer->company_name = $request->company_name;
            $customer->billing_date = $request->billing_date;
            $customer->device_modal = $request->device_modal;
            $customer->purchasing = $request->purchasing;
            $customer->device_property = $request->device_property;
            $customer->payment_type = $request->payment_type;
            $customer->status = 'Pending';

            $customer->save();

            $custmer_with_pkg = Customer::with('package')->find($customer->id);

            return response()->json(['message' => 'User saved successfully', 'customer' => $custmer_with_pkg], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
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
        try {
            $obj = new stdClass();

            $data = Customer::findOrFail($id);

            $obj->data = $data;

            return response()->json($obj);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
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
        // dd($request->all());
        try {
            $customer = Customer::findOrFail($id);

            $customer->user_id = $request->user_id;
            $customer->franchise_id = $request->franchise_id;
            $customer->user_name = $request->user_name;
            $customer->father_name = $request->father_name;
            $customer->cnic = $request->cnic;
            $customer->mobile_number = $request->mobile_number;
            $customer->mobile_number2 = $request->mobile_number2;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->package_type = $request->package_type;
            $customer->package_id = $request->package_id;
            $customer->price = $request->price;
            $customer->installation_charges = $request->installation_charges;
            $customer->device_charges = $request->device_charges;
            $customer->security = $request->security;
            $customer->total_bill = $request->total_bill;
            $customer->company_name = $request->company_name;
            $customer->billing_date = $request->billing_date;
            $customer->device_modal = $request->device_modal;
            $customer->purchasing = $request->purchasing;
            $customer->device_property = $request->device_property;
            $customer->payment_type = $request->payment_type;

            $customer->save();

            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
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

    public function updateIsActive($id)
    {
        try {
            $user = Customer::find($id);

            if ($user) {
                $user->is_active = !$user->is_active;
                $user->save();

                return response()->json(['message' => 'Status updated successfully'], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
    public function updatePrice(Request $request, $id)
    {
        // dd($request->all());
        $customer = Customer::findOrFail($id);
        $customer->price = $request->price;
        $customer->installation_charges = $request->installation_charges;
        $customer->device_charges = $request->device_charges;
        $customer->security = $request->security;
        $customer->status = $request->status;

        $customer->save();
        return response()->json(['message' => 'Updated Bill successfully']);
    }

    public function checkUserId($id)
    {
        if (Customer::where('user_id', $id)->where('is_deleted', 0)->exists()) {
            return response()->json(['isAvailable' => 'no']);
        } else {
            return response()->json(['isAvailable' => 'yes']);
        }
    }

    public function getCustomerBill($id)
    {
        // dd($id);
        $data = Customer::with('package')->select('id', 'package_id', 'user_id', 'father_name', 'is_active', 'user_name')
            ->where('is_active', 1)
            ->whereId($id)
            ->first();
        return response()->json($data);
    }


    public function getCustomers(Request $request)
    {
        // dd($request->data['type']);

        $obj = new stdClass();

        $franchise_id = $request->data['franchise_id'] ? $request->data['franchise_id'] : 1;

        $customersQuery = Customer::where('is_deleted', 0)->where('franchise_id', $franchise_id)
            ->with(['package', 'bills' => function ($query) {
                $query->select('customer_id', DB::raw('SUM(CASE WHEN is_deleted = 0 THEN pending ELSE 0 END) as total_pending'))
                    ->groupBy('customer_id');
            }])
            ->withCount(['bills as total_pending' => function ($query) {
                $query->select(DB::raw('SUM(CASE WHEN is_deleted = 0 THEN pending ELSE 0 END)'));
            }])->orderBy('user_id', 'ASC');


        $countQuery = Customer::where('is_deleted', 0)->when(isset($request->data['search']), function ($query) use ($request) {
            $searchTerm = '%' . $request->data['search'] . '%';
            $query->where('user_id', 'LIKE', $searchTerm);
        });

        // Add WHERE conditions based on $type
        if (isset($request->data['type'])) {
            $type = $request->data['type'];

            switch ($type) {
                case 'active':
                    $customersQuery->where('is_active', 1)->where('is_deleted', 0)
                        ->where(function ($query) {
                            $query->where('paid_status', '<>', 'expired')
                                ->orWhereNull('paid_status');
                        });
                    $countQuery->where('is_active', 1)->where('is_deleted', 0)
                        ->where(function ($query) {
                            $query->where('paid_status', '<>', 'expired')
                                ->orWhereNull('paid_status');
                        });
                    break;

                case 'inactive':
                    $customersQuery->where('is_active', 0);
                    $countQuery->where('is_active', 0);
                    break;

                case 'pending':
                    $customersQuery->whereHas('bills', function ($query) {
                        $query->where('bill_status', 'pending');
                    });
                    $countQuery->whereHas('bills', function ($query) {
                        $query->where('bill_status', 'pending');
                    });
                    break;

                case 'expired':
                    $customersQuery->where('paid_status', 'expired')->where('is_active', 1);
                    $countQuery->where('paid_status', 'expired')->where('is_active', 1);
                    break;

                case 'expiring':
                    $customersQuery->where('paid_status', 'Expiring')->where('is_active', 1);
                    $countQuery->where('paid_status', 'Expiring')->where('is_active', 1);
                    break;
                case 'paid':
                    $customersQuery->where('paid_status', 'Paid')->where('is_active', 1);
                    $countQuery->where('paid_status', 'Paid')->where('is_active', 1);
                    break;
                case 'new':
                    $currentMonth = now()->startOfMonth();
                    $customersQuery->where('is_active', 1)->whereYear('created_at', $currentMonth->year)->whereMonth('created_at', $currentMonth->month);
                    $countQuery->where('is_active', 1)->whereYear('created_at', $currentMonth->year)->whereMonth('created_at', $currentMonth->month);
                    break;
            }
        }

        $count = $countQuery->count();

        // dd($count);

        $perPage = $request->input('perPage', 100);
        $offset = ($request->data['page'] - 1) * $request->data['perPage'];

        $customers = $customersQuery
            ->when(
                isset($request->data['search']),
                function ($query) use ($request) {
                    $searchTerm = '%' . $request->data['search'] . '%';
                    $query->where('user_id', 'LIKE', $searchTerm);
                }
            )
            ->skip($offset)
            ->take($perPage)
            ->get();

        $obj->customers = $customers;
        $obj->count = $count;

        return response()->json($obj);
    }
    public function getFormData(Request $request)
    {

        $obj = new stdClass();

        $obj->packages = Package::select('id', 'speed', 'price')->get();

        $obj->previous_bills = CustomersBills::where('customer_id', $request->userId)->where('is_deleted', 0)->get();

        return response()->json($obj);
    }

    public function addUserBill(Request $request)
    {
        $bill = new CustomersBills();

        $bill->customer_id = $request->user_id;
        $bill->month = $request->month;
        $bill->package_id = $request->package_id;
        $bill->billing_date = $request->billing_date;
        $bill->amount = $request->amount;
        $bill->paid = $request->paid;
        $bill->pending = $request->pending;

        $bill->save();

        if (!in_array($request->pending, ['', null, 0])) {
            Customer::where('user_id', $request->user_id)
                ->update(['bill_status' => 'Pending']);
        }

        return response()->json(['message' => 'Bill added successfully'], 201);
    }

    public function payAllBills()
    {
        try {
            DB::beginTransaction();

            $total_pending = 0;
            $total_cost = 0;

            $all_customers = Customer::select('id', 'user_id', 'package_id', 'billing_date', 'paid_status')
                ->with(['package' => function ($query) {
                    $query->select('id', 'price', 'cost'); // Select only 'id' and 'price' from package table
                }])
                ->where('is_deleted', 0)
                ->where('is_active', 1)
                ->where(function ($query) {
                    $query->whereNull('paid_status')
                        ->orWhere('paid_status', '<>', 'expired');
                })
                ->get();

            foreach ($all_customers as $customer) {
                $bill = new CustomersBills();

                $bill->customer_id = $customer->user_id;
                $bill->package_id = $customer->package_id;
                $bill->month = now()->format('F'); // Full month name (January, February, etc.)
                $bill->amount = $customer->package->price;
                $bill->pending = $customer->package->price;
                $bill->billing_date = $customer->billing_date;

                $total_pending += $customer->package->price; // Add the price of the current customer to the total
                $total_cost += $customer->package->cost; // Add the cost of the current customer to the total

                $bill->save();

                // Update bill_status to NULL for the customer
                $customer->paid_status = null;
                $customer->bill_status = 'Pending';
                $customer->save();
            }


            $billing_pending = Accounts::Where('id', 3)->get();
            $billing_pending[0]['amount']  = $billing_pending[0]['amount'] + $total_pending;
            $billing_pending[0]->save();

            $income_expenses = Accounts::Where('id', 2)->get();
            $income_expenses[0]['amount']  = $income_expenses[0]['amount'] + $total_cost;
            $income_expenses[0]->save();

            DB::commit();
            return response()->json(['message' => 'Bill generated successfully'], 201);
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function payUserFullBill(Request $request)
    {
        $user = Auth::user();
        $billed_by = '';

        if ($user && $user->id == 1) {
            $billed_by = 'Admin';
        } else {
            $employee = session('employee');
            $billed_by = $employee->name;
        }

        $bill = CustomersBills::where('customer_id', $request->user_id)->where('is_deleted', 0)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($bill->pending != 0) {
            $billing_income = Accounts::Where('id', 1)->get();
            $billing_pending = Accounts::Where('id', 3)->get();

            $billing_income[0]['amount']  = $billing_income[0]['amount'] + $bill->pending;
            $billing_pending[0]['amount']  = $billing_pending[0]['amount'] - $bill->pending;

            $billing_income[0]->save();
            $billing_pending[0]->save();
        }

        $bill->paid = $bill->amount;
        $bill->billed_by = $billed_by;
        $bill->pending = 0;

        $bill->save();

        // Update bill_status to NULL for the customer
        $customer = Customer::findOrFail($request->id);

        $customer->paid_status = 'Paid';
        $customer->bill_status = NULL;
        $customer->save();

        return response()->json(['message' => 'Bill paid successfully'], 201);
    }

    public function updateUserBill(Request $request, $id)
    {
        $bill = CustomersBills::findOrFail($id);

        $bill->amount = $request->amount;
        $bill->month = $request->month;
        $bill->paid = $request->paid;
        $bill->pending = $request->pending;

        $bill->save();

        if ($bill->pending != 0) {
            $billing_income = Accounts::Where('id', 1)->get();
            $billing_pending = Accounts::Where('id', 3)->get();

            $billing_income[0]['amount']  = $billing_income[0]['amount'] - $bill->pending;
            $billing_pending[0]['amount']  = $billing_pending[0]['amount'] + $bill->pending;

            $billing_income[0]->save();
            $billing_pending[0]->save();
        }

        $hasPending = CustomersBills::where('customer_id', $request->customer_id)
            ->where('pending', '!=', 0)
            ->where('is_deleted', 0)
            ->exists();

        $status = $hasPending ? 'Pending' : 'Paid';

        Customer::where('user_id', $request->customer_id)
            ->update(['bill_status' => $status]);

        Customer::where('user_id', $request->customer_id)
            ->update(['paid_status' => $status]);

        return response()->json(['message' => 'Bill updated successfully'], 200);
    }

    public function updateExpiry($id)
    {
        // Update billing_date  and expiry for next month
        $customer = Customer::where('id', $id)->first();
        if ($customer) {
            $currentBillingDate = $customer->billing_date;

            // If billing_date doesn't exist, use current date as a reference
            $referenceDate = $currentBillingDate ? $currentBillingDate : now()->format('Y-m-d');

            $nextBillingDate = date(
                'Y-m-d',
                strtotime('+1 month', strtotime($referenceDate))
            );

            $customer->billing_date = $nextBillingDate;
            $customer->paid_status = null;
            $customer->save();
        }

        return response()->json(['message' => 'Expiry Status updated successfully'], 200);
    }

    public function updateExpiryDate($id)
    {
        // Update billing_date  and expiry for next month
        $customer = Customer::where('id', $id)->first();

        if ($customer) {

            $currentBillingDate = $customer->billing_date;

            // If billing_date doesn't exist, use current date as a reference
            $referenceDate = $currentBillingDate ? $currentBillingDate : now()->format('Y-m-d');

            $nextBillingDate = date(
                'Y-m-d',
                strtotime('+1 month', strtotime($referenceDate))
            );


            $customer->billing_date = $nextBillingDate;
            $customer->paid_status = null;
            $customer->bill_status = null;


            $customer->save();

            // dd($customer);
        }

        return response()->json(['message' => 'Expiry Date updated successfully'], 200);
    }

    public function deleteUserBill($id, $customerId)
    {
        // dd($id, $customerId);                   
        try {
            $bill = CustomersBills::findOrFail($id);
            // Soft delete by updating the is_deleted column
            $updated = $bill->update(['is_deleted' => 1]);

            $custmerBills = CustomersBills::where('customer_id', $customerId)
                ->where('pending', '!=', 0)
                ->where('is_deleted', 0)
                ->get();

            if ((sizeof($custmerBills) == 0)) {
                Customer::where('user_id', $customerId)
                    ->update(['bill_status' => NULL]);
            }

            if (!$updated) {
                throw new \Exception('Failed to update bill.');
            }

            return response()->json(['message' => 'Bill deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {

        $customer = Customer::findOrFail($id);

        $customer->update(['is_deleted' => 1]);

        $customer->bills()->update(['is_deleted' => 1]);

        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}
