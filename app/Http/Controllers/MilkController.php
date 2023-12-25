<?php

namespace App\Http\Controllers;

use App\Models\Milk;
use App\Http\Requests\StoreMilkRequest;
use App\Http\Requests\UpdateMilkRequest;

class MilkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('milk.create_milk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMilkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Milk $milk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Milk $milk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMilkRequest $request, Milk $milk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Milk $milk)
    {
        //
    }
}
