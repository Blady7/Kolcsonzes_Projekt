<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Book::all();
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $row = Book::create($request->all());
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
        // $row = Book::create($request->all());
        // $data = [
        //     'message' => 'ok',
        //     'data' => $row
        // ];
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $row = Book::find($id);
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
    public function update(UpdateBookRequest $request, $id)
    {
        $row = Book::find($id);
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
        $row = Book::find($id);
        if ($row) {
            try {
                $row->delete();
                $message = "ok";
                $rows = [
                    'id' => $id
                ];
            } catch (\Throwable $th) {
                $message = 'a rekordot nem lehet törölni';
                $rows = [];
            }
        } else {
            $message = "Not found";
            $rows = [
                'id' => $id
            ];
        }
        $data = [
            'message' => $message,
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
}
