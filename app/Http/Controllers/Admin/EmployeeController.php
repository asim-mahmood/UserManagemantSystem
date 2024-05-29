<?php

namespace App\Http\Controllers\Admin;

use session;
use stdClass;
use App\Models\Employee;
use App\Models\Complaint;
use function Ramsey\Uuid\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee');
    }

    public function login()
    {
        return view('employee.login');
    }

    public function loginEmployee(Request $request)
    {
        if ($request->has('email') && $request->has('password')) {
            $email = $request->input('email');
            $password = $request->input('password');

            // Retrieve the employee based on the email
            $employee = Employee::where('email', $email)->first();

            // If employee exists and password matches, allow access
            if ($employee && Hash::check($password, $employee->password)) {
                // Store the employee object in session flash data
                // $request->session()->flash('employee', $employee);
                session(['employee' => $employee]);

                return redirect()->route('employee.dashboard')->with('success', 'Login successful');
            }
        }

        // If email or password is incorrect, redirect back with an error message
        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function employeeDashboard()
    {
        $employee = session('employee');

        $complaints = Complaint::where('employee_id', $employee->id)
            ->with(['customer:id,user_id,mobile_number,address,user_name'])
            ->get();

        $counts = Complaint::selectRaw('
            COUNT(*) as totalComplaintsCount,
            SUM(CASE WHEN problem = "Slow Browsing" THEN 1 ELSE 0 END) as totalSlowBrowsingCount,
            SUM(CASE WHEN problem = "No Internet" THEN 1 ELSE 0 END) as totalNoInternetCount,
            SUM(CASE WHEN problem = "Other" THEN 1 ELSE 0 END) as totalOtherCount,
            SUM(CASE WHEN is_active = 0 THEN 1 ELSE 0 END) as pendingComplaintsCount,
            SUM(CASE WHEN is_active = 0 AND problem = "Slow Browsing" THEN 1 ELSE 0 END) as pendingSlowBrowsingCount,
            SUM(CASE WHEN is_active = 0 AND problem = "No Internet" THEN 1 ELSE 0 END) as pendingNoInternetCount,
            SUM(CASE WHEN is_active = 0 AND problem = "Other" THEN 1 ELSE 0 END) as pendingOtherCount,
            SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as resolvedComplaintsCount,
            SUM(CASE WHEN is_active = 1 AND problem = "Slow Browsing" THEN 1 ELSE 0 END) as resolvedSlowBrowsingCount,
            SUM(CASE WHEN is_active = 1 AND problem = "No Internet" THEN 1 ELSE 0 END) as resolvedNoInternetCount,
            SUM(CASE WHEN is_active = 1 AND problem = "Other" THEN 1 ELSE 0 END) as resolvedOtherCount
        ')
            ->where('employee_id', $employee->id)
            ->first();

        return view('employee.dashboard', [
            'complaints' => $complaints,
            'employee' => $employee,
            'counts' => $counts
        ]);
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
        try {
            $employee = new Employee();

            $employee->name = $request->name;
            $employee->father_name = $request->father_name;
            $employee->cnic = $request->cnic;
            $employee->email = $request->email;
            $employee->password = bcrypt($request->password);
            $employee->readable_password = $request->password;
            $employee->mobile_number = $request->mobile_number;
            $employee->mobile_number2 = $request->mobile_number2;
            $employee->address = $request->address;
            $employee->reference = $request->reference;
            $employee->post = $request->post;
            $employee->salary = $request->salary;
            $employee->joining_date = $request->joining_date;
            $employee->status = $request->status;

            $employee->save();

            return response()->json(['message' => 'New Employee saved successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $obj = new stdClass();

            $data = Employee::findOrFail($id);

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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $employee = Employee::findOrFail($id);

            $employee->name = $request->name;
            $employee->father_name = $request->father_name;
            $employee->cnic = $request->cnic;
            $employee->email = $request->email;
            $employee->mobile_number = $request->mobile_number;
            $employee->mobile_number2 = $request->mobile_number2;
            $employee->address = $request->address;
            $employee->reference = $request->reference;
            $employee->post = $request->post;
            $employee->salary = $request->salary;
            $employee->joining_date = $request->joining_date;
            $employee->status = $request->status;
            $employee->is_active = $request->is_active;

            $employee->save();

            return response()->json(['message' => 'Employee Updated Successfully '], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            // Soft delete by updating the is_deleted column
            $updated = $employee->update(['is_deleted' => 1]);

            if (!$updated) {
                throw new \Exception('Failed to update Employee Information.');
            }
            return response()->json(['message' => 'Employee deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getData()
    {
        $employee = Employee::select('id', 'name', 'father_name', 'cnic', 'email', 'mobile_number',  'mobile_number2', 'address', 'reference', 'post', 'salary', 'joining_date', 'status', 'is_active')
            // ->where('is_deleted', 0)
            ->get();
        return response()->json($employee);
    }
    public function checkEmployeeId($id)
    {
        if (Employee::where('employee_id', $id)->exists()) {
            return response()->json(['isAvailable' => 'no']);
        } else {
            return response()->json(['isAvailable' => 'yes']);
        }
    }
    public function updateIsActive($id)
    {
        try {
            $employee = Employee::find($id);

            if ($employee) {
                $employee->is_active = !$employee->is_active;
                $employee->save();

                return response()->json(['message' => 'Status updated successfully'], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
    public function logoutEmployee()
    {
        session()->forget('employee');

        return redirect()->route('employee')->with('message', 'Logout Successfully');
    }
}
