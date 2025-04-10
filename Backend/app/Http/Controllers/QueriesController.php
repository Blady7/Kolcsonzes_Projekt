<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Role;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class QueriesController extends Controller
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

    public function queryOsztalyAzon()
    {
        //natív SQL
        $rows = DB::select(
            'SELECT b.id, b.poet, b.title, g.group from books b
                inner join groups g on b.groupId= g.id
                order by b.id;'
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryDiakValaszto()
    {
        //natív SQL
        $rows = DB::select(
            'SELECT u.id, u.name, g.`group`, u.email FROM users u
                INNER JOIN groups g ON u.groupId = g.id
                where u.roleId = 2 '
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }


    public function queryTanarValaszto()
    {
        //natív SQL
        $rows = DB::select(
            'SELECT g.id, g.`group`, u.name FROM groups g
                INNER JOIN users u ON u.groupId = g.id
                where u.roleId = 3'
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryKolcsonzesAzon()
    {
        //natív SQL
        $rows = DB::select(
            'SELECT r.id, b.poet, b.title, u.name, r.startingDate, r.endingDate from rentals r
                inner JOIN specimens s on r.specimenId = s.id
                INNER JOIN users u on r.userId = u.id
                inner join books b on s.bookId = b.id
                order by r.id;'
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
}
