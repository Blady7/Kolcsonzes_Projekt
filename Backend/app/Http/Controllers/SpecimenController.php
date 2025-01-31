<?php

namespace App\Http\Controllers;

use App\Models\Specimen;
use App\Http\Requests\StoreSpecimenRequest;
use App\Http\Requests\UpdateSpecimenRequest;

class SpecimenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecimenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Specimen $specimen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecimenRequest $request, Specimen $specimen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specimen $specimen)
    {
        //
    }
}
