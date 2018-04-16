<?php

namespace App\Http\Controllers\Admin;
use App\Books;
use App\Nav;
use App\Http\Controllers\Controller;
use App\Partners;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class MyownController extends Controller{
    public function show(){            //已借书列表
       $data=Partners::with('borrows')->where('id',session('infouser')['id'])->take(100)->get();
       return view('admin.myown.bookindex',['d'=>$data]);

    }

    public function index(){
            $news=Partners::find(session('infouser')['id']);
           return view('admin.myown.index',compact('news'));
    }

    public function Searchs(){
    $keywords=Input::get('keywords');
    $content=Books::where('book_name','like',$keywords.'%')
        ->orWhere('book_author','like',$keywords.'%')->get();
    return view('admin.books.index',['d'=>$content]);
}

}