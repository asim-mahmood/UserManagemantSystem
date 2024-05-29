<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Franchise;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.packages');
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
            $package = new Package();

            $package->name = $request->name;
            $package->speed = $request->speed . ' Mbps';
            $package->price = $request->price;
            $package->cost = $request->cost;

            $package->save();

            return response()->json(['message' => 'Package save successfully'], 201);
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

            $data = Package::findOrFail($id);

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
            $package = Package::findOrFail($id);

            $package->name = $request->name;
            $package->speed = $request->speed;
            $package->price = $request->price;
            $package->cost = $request->cost;

            $package->save();

            return response()->json(['message' => 'Package updated successfully'], 200);
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

            $data = Package::select('id', 'name', 'price', 'speed', 'cost', 'is_active')
                ->orderby('speed', 'DESC')->get();

            $obj->data = $data;

            return response()->json($obj, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getFormData()
    {
        try {
            $obj = new stdClass();

            $data = Package::select('id', 'price', 'speed')
                ->where('is_active', 1)
                ->get();

            $franchises = Franchise::select('id', 'name', 'owner_name')
                ->where('is_active', 1)
                ->get();

            $obj->data = $data;
            $obj->franchises = $franchises;

            return response()->json($obj, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function updateIsActive($id)
    {
        try {
            $model = Package::find($id);

            if ($model) {
                $model->is_active = !$model->is_active;
                $model->save();

                return response()->json(['message' => 'Package status updated successfully'], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
