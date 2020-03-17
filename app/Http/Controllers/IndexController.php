<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function books(Request $request)
    {
        $books = Book::select('id', 'name')->get();
        $data = [];

        /** @var Book $v */
        foreach ($books as $v) {
            $temp = [];
            $temp['id'] = $v->id;
            $temp['name'] = $v->name;
            $data[] = $temp;
        }

        $res['code'] = 200;
        $res['msg'] = 'success';
        $res['data'] = $data;
        return response()->json($res);
    }

    public function createBook(Request $request)
    {
        $book_name = $request->get('book_name');

        $res = [];
        if (empty($book_name)) {
            $res['code'] = 201;
            $res['msg'] = '没有填写书名';
            return response()->json($res);
        }

        /** @var Book $book */
        $book = new Book();
        $book->user_id = 5;
        $book->name = $book_name;
        $book->save();

        $res['code'] = 200;
        $res['msg'] = '创建成功';
        $res['data'] = [
            'id' => 5,
            'name' => $book_name
        ];
        return response()->json($res);
    }
}
