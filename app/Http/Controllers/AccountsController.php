<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Heads;
use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounts');
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
            $account = new Accounts();

            $account->head_id = $request->head_id;
            $account->name = $request->name;
            $account->opening_balance = $request->opening_balance;

            $account->save();

            //this line containing a condition head_id==1 that is not fulfill due to in the database table there are two different values 3 & 4 are stored against head_id
            $prefix = ($request->head_id == 1) ? 'Acc-Inc-240' : 'Acc-Exp-240';
            $title = $prefix . $account->id;

            // Update the title field
            $account->title = $title;
            $account->save();


            return response()->json(['message' => 'Account Created Successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function show(Accounts $accounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $obj = new stdClass();

            $data = Accounts::findOrFail($id);

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
     * @param  \App\Models\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        try {
            $account = Accounts::findOrFail($id);

            $account->name = $request->name;
            $account->opening_balance = $request->opening_balance;
            $account->head_id = $request->head_id;


            $account->save();

            return response()->json(['message' => 'Account updated successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accounts $accounts)
    {
        //
    }
    public function getData()
    {
        try {
            $obj = new stdClass();

            $data = Accounts::with(['head' => function ($query) {
                $query->select('id', 'name');
            }])
                ->select('id', 'title', 'head_id', 'name', 'opening_balance', 'amount', 'is_active')
                ->get();

            $obj->data = $data;

            return response()->json($obj, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getFormData(Request $request)
    {
        $obj = new stdClass();
        $obj->data = Heads::select('id', 'name')->get();

        return response()->json($obj);
    }

    public function updateIsActive($id)
    {
        try {
            $model = Accounts::find($id);

            if ($model) {
                $model->is_active = !$model->is_active;
                $model->save();

                return response()->json(['message' => 'Accounts status updated successfully'], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
