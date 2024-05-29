<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Franchise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FranchiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.franchise');
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
            $franchise = new Franchise();

            $franchise->name = $request->name;
            $franchise->owner_name = $request->owner_name;
            $franchise->location = $request->location;
            $franchise->details = $request->details;

            $franchise->save();

            return response()->json(['message' => 'Franchise Created Successfully'], 201);
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

            $data = Franchise::findOrFail($id);

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
            $franchise = Franchise::findOrFail($id);

            $franchise->name = $request->name;
            $franchise->owner_name = $request->owner_name;
            $franchise->location = $request->location;
            $franchise->details = $request->details;


            $franchise->save();

            return response()->json(['message' => 'Franchise updated successfully'], 200);
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

            $data = Franchise::select('id', 'name', 'owner_name', 'location', 'details', 'is_active')->get();

            $obj->data = $data;

            return response()->json($obj, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function updateIsActive($id)
    {
        try {
            $model = Franchise::find($id);

            if ($model) {
                $model->is_active = !$model->is_active;
                $model->save();

                return response()->json(['message' => 'Franchise status updated successfully'], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
