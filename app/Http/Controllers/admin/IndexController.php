<?php

namespace App\Http\Controllers\Admin;
use App\Books;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class IndexController extends Controller{
    public function index(){
        $data=Books::orderBy('id','ASC')->get();
        return view('admin.index',['d'=>$data]);
    }
}