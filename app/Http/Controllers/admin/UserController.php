<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller{
    public function index(){
        return view('admin.login');
    }
    public function logincheck()
    {
        if ($input = Input::all()) {
            $users=User::where(['name'=> $input['username']])->first();
            if(!$users){
                return back()->with('msg', '用户名错误');
            }
            if (Hash::check($input['password'],$users->password)) {
                if (strtoupper(Session::get('Verify')) != strtoupper($input['code'])) { //strtoupper() 函数把字符串转换为大写。strtolower() 函数把字符串转换为小写。
                    return back()->with('msg', '验证码错误');                  //错误提示信息
                } else {
                    $h=$users->id;
                    session(['infouser.name'=>$input['username']]);
                    session(['infouser.id'=>$h]);
                    return redirect('admin');
                }
            }else{
                return back()->with('msg', '密码不正确！');
            }
        }
        else{
            return back()->with('msg', '输入不能空');
        }
    }

    public function destroy(Request $request){  //退出
        $request->session()->forget('infouser');
        return redirect('admin');
    }

    public function show(){

    }

}