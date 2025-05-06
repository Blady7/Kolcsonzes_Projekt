<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Query;
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

    public function queryOsztalyAzon($limit, $offset)
    {
        $query = '
        SELECT b.id, b.poet, b.title, g.group, g.id groupId from books b
                inner join groups g on b.groupId= g.id
                order by b.id
                limit ? offset ?
        ';
        //natív SQL
        $rows = DB::select(
            $query, [$limit, $offset]
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryBooksCount()
    {
        $query = '
        SELECT count(*) booksCount from books
        ';
        //natív SQL
        $rows = DB::select(
            $query
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
    public function queryRentalsCount()
    {
        $query = '
        SELECT count(*) RentalsCount from rentals
        ';
        //natív SQL
        $rows = DB::select(
            $query
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryStudentsCount()
    {
        $query = '
        SELECT count(*) studentsCount from users
            where roleId = 2
        ';
        //natív SQL
        $rows = DB::select(
            $query
        );


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryDiakValaszto($limit, $offset)
    {
        $query = '
            SELECT u.id, u.name, g.`group`, u.email, g.id groupId FROM users u
                INNER JOIN groups g ON u.groupId = g.id
                where u.roleId = 2
                limit ? offset ?
                
        ';
        //natív SQL
        $rows = DB::select($query, [$limit, $offset]);


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

    public function queryKolcsonzesAzon($limit, $offset)
    {
        //natív SQL
        $query = '
        SELECT r.id, b.poet, b.title, u.name, r.startingDate, r.endingDate from rentals r
                inner JOIN specimens s on r.specimenId = s.id
                INNER JOIN users u on r.userId = u.id
                inner join books b on s.bookId = b.id
                order by r.id
                limit ? offset ?
        ';
        $rows = DB::select($query, [$limit, $offset]);

        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
}
