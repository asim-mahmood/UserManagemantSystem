<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use App\Models\Module;
use App\Models\Customer;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use App\Models\Admin\City;
use App\Models\Admin\Site;
use App\Models\Admin\Driver;
use Illuminate\Http\Request;
use App\Models\Admin\Airport;
use App\Models\Admin\Country;
use App\Models\Admin\Services;
use App\Models\Admin\Reservation;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\GuestCustomer;
use App\Http\Controllers\Controller;
use App\Models\Admin\ExpenseDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminHomeController extends Controller
{
    public function afterLogin()
    {
        return view('admin.after_login');
    }
    public function dashboard()
    {

        $totalCount = Customer::where('is_deleted', 0)->count();


        $activeCount = Customer::where('is_active', 1)
            ->where('is_deleted', 0)
            ->where(function ($query) {
                $query->where('paid_status', '<>', 'expired')
                    ->orWhereNull('paid_status');
            })
            ->count();

        $inActiveCount = Customer::where('is_active', 0)->where('is_deleted', 0)->count();
        $pendingBillCount = Customer::where('bill_status', 'Pending')->where('is_deleted', 0)->count();
        $expiredCount = Customer::where('paid_status', 'Expired')->where('is_deleted', 0)->where('is_active', 1)->count();
        $expiringCount = Customer::where('paid_status', 'Expiring')->where('is_deleted', 0)->where('is_active', 1)->count();
        $paidCount = Customer::where('paid_status', 'Paid')->where('is_deleted', 0)->where('is_active', 1)->count();
        $newCount = Customer::where('is_deleted', 0)->where('is_active', 1)->whereYear('created_at', '=', now()->year)->whereMonth('created_at', '=', now()->month)->count();

        $totalEmployee = Employee::count();
        $activeEmployee = Employee::where('is_active', 1)->count();
        $inactiveEmployee = Employee::where('is_active', 0)->count();

        return view('admin.dashboard')->with([
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
            'inActiveCount' => $inActiveCount,
            'pendingBillCount' => $pendingBillCount,
            'expiredCount' => $expiredCount,
            'expiringCount' => $expiringCount,
            'paidCount' => $paidCount,
            'newCount' => $newCount,
            'totalEmployee' => $totalEmployee,
            'activeEmployee' => $activeEmployee,
            'inactiveEmployee' => $inactiveEmployee
        ]);


        // $user = Auth::user();
        // if ($user) {
        //     return view('admin.dashboard');
        // } else {
        //     return view('admin-login');
        // }
    }
}
