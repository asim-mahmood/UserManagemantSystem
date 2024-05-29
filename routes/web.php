<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeadsController;
use App\Http\Controllers\LedgersController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\BillingHistoryController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\FranchiseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/admin', [AdminAuthController::class, 'loginPage'])->name('admin-login-page');

Route::get('/pay_all_bills', [UsersController::class, 'payAllBills']);

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin-login');

Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');

Route::get('/test', function () {
    return view('text'); // Assuming 'text.blade.php' is located in the resources/views directory
});

Route::get('get/customers', [ComplaintController::class, 'getData']);
Route::get('get/customer/bill/{id}', [UsersController::class, 'getCustomerBill']);
Route::post('users/full-bill', [UsersController::class, 'payUserFullBill']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    //Dashboard routes
    Route::get('/dashboard/{type?}', [AdminHomeController::class, 'dashboard'])->name('admin-dashboard');

    //User routes
    Route::resource('users', UsersController::class);
    Route::resource('billing_history', BillingHistoryController::class);
    Route::get('get/billing_history/{startData}/{endDate}', [BillingHistoryController::class, 'getBills']);
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/send/whatsapp', [ComplaintController::class, 'sendWhatsApp']);
    Route::get('users/update/is-active/{id}', [UsersController::class, 'updateIsActive']);
    Route::post('users/add-bill', [UsersController::class, 'addUserBill']);
    Route::get('users/update-expiry/{id}', [UsersController::class, 'updateExpiry']);
    Route::get('users/update-expiry-date/{id}', [UsersController::class, 'updateExpiryDate']);
    Route::put('users/update-bill/{id}', [UsersController::class, 'updateUserBill']);
    Route::delete('users/delete-bill/{id}/{customerId}', [UsersController::class, 'deleteUserBill']);
    Route::post('users/update/prices/{id}', [UsersController::class, 'updatePrice']);
    Route::post('users/data', [UsersController::class, 'getCustomers']);
    Route::get('/real_users/{type?}', [UsersController::class, 'index2']);
    Route::get('/real_users/delete/{id}', [UsersController::class, 'delete']);
    Route::get('/users/chcek/{id}', [UsersController::class, 'checkUserId']);
    Route::post('get/bills/form/data', [UsersController::class, 'getFormData']);

    //Packages routes
    Route::resource('packages', PackagesController::class);
    Route::get('get/packages', [PackagesController::class, 'getData']);
    Route::get('package/update/is-active/{id}', [PackagesController::class, 'updateIsActive']);
    Route::get('get/form/data', [PackagesController::class, 'getFormData']);

    //inventories routes
    Route::resource('inventories', InventoryController::class);
    Route::get('get/inventories', [InventoryController::class, 'getData']);
    Route::delete('inventories/delete-inventory/{id}', [InventoryController::class, 'deleteInventory']);

    //Employees Routes
    Route::resource('employees', EmployeeController::class);
    Route::get('get/employees', [EmployeeController::class, 'getData']);
    Route::get('/employees/update/is-active/{id}', [EmployeeController::class, 'updateIsActive']);
    Route::get('/employees/check/{id}', [UsersController::class, 'checkEmployeeId']);

    //Franchise Routes
    Route::resource('franchises', FranchiseController::class);
    Route::get('get/franchises', [FranchiseController::class, 'getData']);
    Route::get('/franchises/update/is-active/{id}', [FranchiseController::class, 'updateIsActive']);

    //Complaints Routes
    Route::resource('complaints', ComplaintController::class);
    Route::get('get/complaints', [ComplaintController::class, 'getComplaintData']);
    Route::get('complaints/assign/employee/{id}/{employeeID}', [ComplaintController::class, 'assignEmployee']);

    //Accounting Routes
    Route::resource('accounts', AccountsController::class);
    Route::get('get/accounts', [AccountsController::class, 'getData']);
    Route::get('accounts/update/is-active/{id}', [AccountsController::class, 'updateIsActive']);
    Route::get('accounts/get/form/data', [AccountsController::class, 'getFormData']);
    //Accounting->Heads Routes
    Route::resource('heads', HeadsController::class);
    Route::get('get/heads', [HeadsController::class, 'getData']);
    Route::get('heads/update/is-active/{id}', [HeadsController::class, 'updateIsActive']);
    Route::get('heads/get/form/data', [HeadsController::class, 'getFormData']);
    //Accounting->Transaction Routes
    Route::resource('transactions', TransactionController::class);
    Route::get('get/transactions', [TransactionController::class, 'getData']);
    Route::get('transactions/get/form/data', [TransactionController::class, 'getFormData']);
});

// Employees Panel
Route::get('/employee', [EmployeeController::class, 'login'])->name('employee');

Route::post('/employee/login', [EmployeeController::class, 'loginEmployee'])->name('employee-login');

Route::get('/employee/logout', [EmployeeController::class, 'logoutEmployee'])->name('employee-logout');


Route::group(['prefix' => 'employee'], function () {
    Route::get('/dashboard', [EmployeeController::class, 'employeeDashboard'])->name('employee.dashboard');
    Route::get('/complaints/update/is-active/{id}', [ComplaintController::class, 'complaintStatus']);
    Route::post('/complaints/add/feedback/{id}', [ComplaintController::class, 'addFeedback']);
});
