<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transactions.index');
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
            $transaction = new Transaction();

            $transaction->account_id = $request->account_id;
            $transaction->amount = $request->amount;
            $transaction->narration = $request->narration;

            $transaction->save();

            return response()->json(['message' => 'Transaction Created Successfully'], 201);
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

            $data = Transaction::findOrFail($id);

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
        try {
            $transaction = Transaction::findOrFail($id);

            $transaction->account_id = $request->account_id;
            $transaction->amount = $request->amount;
            $transaction->narration = $request->narration;

            $transaction->save();

            return response()->json(['message' => 'Transaction updated successfully'], 200);
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

    public function getData()
    {
        try {
            $obj = new stdClass();

            $data = Transaction::with([
                'account' => function ($query) {
                    $query->select('id', 'title', 'name', 'head_id'); // Specify columns from Account model
                },
                'account.head' => function ($query) {
                    $query->select('id', 'name'); // Specify columns from Head model
                }
            ])
                ->select('id', 'account_id', 'amount', 'narration', 'is_active')
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
        $obj->data = Accounts::select('id', 'title', 'name')->whereNotIn('id', [1, 2, 3])->where('is_active', 1)->get();

        return response()->json($obj);
    }
}
