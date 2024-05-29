<?php

namespace App\Http\Controllers;

use App\Models\Ledgers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LedgersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ledgers');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ledgers  $ledgers
     * @return \Illuminate\Http\Response
     */
    public function show(Ledgers $ledgers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ledgers  $ledgers
     * @return \Illuminate\Http\Response
     */
    public function edit(Ledgers $ledgers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ledgers  $ledgers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ledgers $ledgers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ledgers  $ledgers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ledgers $ledgers)
    {
        //
    }
}
