<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function detail(Request $request){
        return view('article.detail');
    }

    public function write(Request $request){
        /** @var Book $books */
        $books = Book::select('id', 'name')->get();
        return view('article.write',compact('books'));
    }

    public function add(Request $request){
    //添加
    }

    public function edit(Request $request,$aid){
        //编辑
    }
}
