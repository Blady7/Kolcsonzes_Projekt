<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Role;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class QeriesController extends Controller
{
    //tanárok névsora abc-be
    public function queryTanarnevsor()
    {
        //natív SQL
        $rows = DB::select(
            query: 'SELECT name, id FROM users
                where roleId = 3
                ORDER BY name;'
        );

        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryKonyCimIdvel()
    {
        //natív SQL
        $rows = DB::select(
            'SELECT title, id FROM books;'
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
}
