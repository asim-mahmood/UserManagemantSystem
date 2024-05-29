<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Heads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.heads');
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
            $heads = new Heads();

            $heads->name = $request->name;


            $heads->save();

            return response()->json(['message' => 'New Head Created Successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Heads  $heads
     * @return \Illuminate\Http\Response
     */
    public function show(Heads $heads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Heads  $heads
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $obj = new stdClass();

            $data = Heads::findOrFail($id);

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
     * @param  \App\Models\Heads  $heads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $heads = Heads::findOrFail($id);

            $heads->name = $request->name;


            $heads->save();

            return response()->json(['message' => 'Heads updated successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Heads  $heads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Heads $heads)
    {
        //
    }
    public function getData()
    {
        try {
            $obj = new stdClass();

            $data = Heads::select('id', 'name', 'is_active')->get();

            $obj->data = $data;

            return response()->json($obj, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
    public function updateIsActive($id)
    {
        try {
            $model = Heads::find($id);

            if ($model) {
                $model->is_active = !$model->is_active;
                $model->save();

                return response()->json(['message' => 'Heads status updated successfully'], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
