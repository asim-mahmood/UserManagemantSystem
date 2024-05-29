<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use stdClass;
use Twilio\Rest\Client;

class ComplaintController extends Controller
{
    public function sendWhatsApp()
    {

        $sid    = "AC1dbfe6608b9ec657e0b2af157170c78c";
        $token  = "9d3922382dbdc45e677951cf90d2366a";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "whatsapp:+923007977781", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "This is you current monthly bill. 2000"
                )
            );

        return response()->json(['message' => $message], 201);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.complaints');
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
            $complaint = new Complaint();

            $complaint->user_id = $request->user_id;
            $complaint->complaint_by = $request->complaint_by;
            $complaint->mobile = $request->mobile;
            $complaint->problem = $request->problem;
            $complaint->date = $request->date;
            $complaint->description = $request->description;
            $complaint->save();

            return response()->json(['message' => 'Complaint Registered Successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $obj = new stdClass();

            $data = Complaint::findOrFail($id);

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
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $complaint = Complaint::findOrFail($id);

            $complaint->user_id = $request->user_id;
            $complaint->complaint_by = $request->complaint_by;
            $complaint->mobile = $request->mobile;
            $complaint->problem = $request->problem;
            $complaint->date = $request->date;
            $complaint->description = $request->description;
            $complaint->save();

            return response()->json(['message' => 'Complaint Updated Successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            // Soft delete by updating the is_deleted column
            $updated = $complaint->update(['is_deleted' => 1]);

            if (!$updated) {
                throw new \Exception('Failed to update Complaint Status.');
            }
            return response()->json(['message' => 'Complaint Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getData()
    {
        $customer = Customer::select('id', 'user_id', 'is_active', 'user_name')
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->get();
        return response()->json($customer);
    }

    public function getComplaintData()
    {
        $complaint = Complaint::select('id', 'user_id', 'is_active', 'complaint_by', 'employee_id', 'mobile', 'problem', 'date', 'description', 'is_deleted', 'feedback')
            ->with(['customer:id,user_id,user_name,mobile_number'])
            ->where('is_deleted', 0)
            ->get();
        $employee = Employee::select('id', 'name', 'is_active')
            ->where('is_active', 1)
            ->get();

        return response()->json([
            'complaint' => $complaint,
            'employees' => $employee
        ]);
    }
    public function assignEmployee($id, $employeeId)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->employee_id = $employeeId;
        $complaint->save();

        return response()->json(['message' => 'Employee has been assigned successfully']);
    }
    public function complaintStatus($id)
    {
        try {
            $complaint = Complaint::select('id', 'user_id', 'is_active', 'complaint_by', 'employee_id', 'mobile', 'problem', 'date', 'description', 'is_deleted')
                ->with(['customer:id,user_id'])
                ->find($id);

            if ($complaint) {
                $complaint->is_active = !$complaint->is_active;
                $complaint->save();

                return response()->json(['message' => 'Status updated successfully', 'complaint' => $complaint], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function addFeedback(Request $request, $id)
    {
        // dd($request->all(),$id)
        $complaint = Complaint::select('id', 'feedback')
            ->find($id);
        $complaint->feedback = $request->feedback;
        $complaint->save();
        return response()->json(['message' => 'Feedback added successfully']);
    }
}
