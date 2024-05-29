<?php

namespace App\Http\Controllers\Admin\Auth;

use Carbon\Carbon;
use App\Models\Admin\User;
use App\Models\Admin\Driver;
use Illuminate\Http\Request;
use App\Models\Admin\Customer;
use App\Models\Admin\UserGroup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Google\Service\Monitoring\Custom;
use Illuminate\Support\Facades\Artisan;

class AdminAuthController extends Controller
{
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // dd($request->all());

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            // dd($request->all());
            $user =  Auth::user();

            if ($user->is_active == 1) {

                Artisan::call('billing:check');

                $user->last_login = Carbon::now();
                $user->last_ip = $request->getClientIp();
                $user->save();

                session(['user' => $user]);


                return redirect()->route('admin-dashboard');
            } else {
                return redirect()->route('admin-login-page')->withErrors(['error' => 'You are not authorized to login.']);
            }
        }
        return redirect()->route('admin-login-page')->withErrors(['error' => 'Email or Password is wrong']);
    }

    public function showDriverLoginForm()
    {
        return view('driver.auth.driver', ['url' => 'login', 'guard' => 'driver']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin-login-page')->with('message', 'Logout Successfully');
    }
}
