<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use stdClass;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.inventory');
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
            $inventory = new Inventory();

            $inventory->product = $request->product;
            $inventory->date = $request->date;
            $inventory->company = $request->company;
            $inventory->unit_price = $request->unit_price;
            $inventory->quantity = $request->quantity;
            $inventory->total_price = $request->total_price;
            $inventory->status = $request->status;
            $inventory->description = $request->description;

            $inventory->save();

            return response()->json(['message' => 'Inventory saved successfully'], 201);
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

            $data = Inventory::findOrFail($id);

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
            $inventory = Inventory::findOrFail($id);

            $inventory->product = $request->product;
            $inventory->date = $request->date;

            $inventory->company = $request->company;
            $inventory->unit_price = $request->unit_price;
            $inventory->quantity = $request->quantity;
            $inventory->total_price = $request->total_price;
            $inventory->status = $request->status;
            $inventory->description = $request->description;

            $inventory->save();
            return response()->json(['message' => 'Inventory Updated successfully'], 200);
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
        try {
            $inventory = Inventory::findOrFail($id);
            // Soft delete by updating the is_deleted column
            $updated = $inventory->update(['is_deleted' => 1]);

            if (!$updated) {
                throw new \Exception('Failed to update Inventory.');
            }

            return response()->json(['message' => 'Inventory deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getData()
    {

        $inventory = Inventory::select('id', 'date', 'product', 'company', 'unit_price',  'quantity', 'total_price', 'status', 'description')
            ->where('is_deleted', 0)
            ->get();

        // dd($inventory);

        return response()->json($inventory);
    }
    // public function getData(Request $request)
    // {
    //     // Get the start date, end date, and minimum end date from the request
    //     $startDate = $request->query('startDate');
    //     $endDate = $request->query('endDate');
    //     $minEndDate = $request->query('minEndDate');

    //     // Query the inventory data with filtering based on the provided date range
    //     $inventory = Inventory::select('id', 'date', 'product', 'company', 'unit_price', 'quantity', 'total_price', 'status', 'description')
    //         ->where('is_deleted', 0)
    //         ->where('date', '>=', $startDate)
    //         ->where('date', '<=', $endDate)
    //         ->where('date', '>=', $minEndDate)
    //         ->get();

    //     return response()->json($inventory);
    // }

}
