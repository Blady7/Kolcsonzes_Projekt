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
        $rows = Specimen::all();
        
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecimenRequest $request)
    {
        try {
            $row = Specimen::create($request->all());
            $data = [
                'message' => 'ok',
                'data' => $row
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            $data = [
                'message' => 'The post failed',
                'data' => $request->all()
            ];
        }

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $row = Specimen::find($id);
        if ($row) {
            $data = [
                'message' => 'ok',
                'data' => $row
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecimenRequest $request, $id)
    {
        $row = Specimen::find($id);
        if ($row) {

            try {
                $row->update($request->all());
                $data = [
                    'message' => 'ok',
                    'data' => $row
                ];
            } catch (\Illuminate\Database\QueryException $e) {
                $data = [
                    'message' => 'The patch failed',
                    'data' => $request->all()
                ];
            }

        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $row = Specimen::find($id);
        if ($row) {
            $row->delete();
            $data = [
                'message' => 'ok',
                'data' => [
                    'id' => $id
                ]
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
}
