<?php

namespace App\Http\Controllers\Admin;
use App\Borrows;
use App\Nav;
use App\Http\Controllers\Controller;
use App\Books;
use App\Partners;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class BookController extends Controller{
    public function index(){              //未借图书列表
       $data=Books::orderBy('id','ASC')->where('book_state',0)->get();
       return view('admin.books.index',['d'=>$data]);
    }

    public function edit($id){
        $products= Books::with('borrows')->find($id);
        $urlname=route('book.update',['book'=>$id]);
        $method='<input type="hidden" name="_method" value="put">';
        return view('admin.books.edit', compact('products','urlname','method'));
    }

    public function update($id){             //借书
        $input=Input::except('_token','_method','pid');
        $pid=Input::get('pid');
        $re=Books::where('id',$id)->update(['book_state'=>$input['book_state']]);
        if($input['book_state']==1){
            $this::checktime($input,$pid);
        }else{
            $this::delets($input);
        }
        if($re){
            return redirect('admin/book');
        }else{
            return back()->with('errors','修改失败');
        }
    }

    public function show(){
        //$user = Books::find(2);
        //$user->created_at = Carbon::now();
        //$user->save();
        $m= Carbon::now()->addDays(14)->timestamp;
        $n= Carbon::now()->timestamp;
        echo ($m-$n)/(60*60*24);
        echo "/n";
        echo intval(4.8);
     //  echo 'br'.date_format(Carbon::createFromDate(2018,4,28),time());
    }


    public function destroy($id){
        $products=Books::find($id);
        $rey=$products->delete();
        if($rey){
            $data['state']='1';
            $data['vul'] = '删除成功！';
        } else {
            $data['state']='0';
            $data['vul'] =  '删除失败！';
        }
        return $data;
    }

    public function borrow(){
        $data=Borrows::with('books')->take(10)->get();
     return view('admin.books.borrow_index',['d'=>$data]);
    }
    public function  checktime($input,$pid=0){
        $data=Array(
            'uname'=>$input['names'],
            'ISBN'=>$input['isbns'],
            'borrow_time'=>Carbon::now()->timestamp,
            'return_time'=>Carbon::now()->addDays(14)->timestamp,
            'author'=>$input['authors'],
            'uid'=>$pid
        );
        $uname=Borrows::where('uname',$input['names']);
          if(!($uname->first())){
              $uname->create($data);
        }else{
              $uname->update($data);
        }
        if($pid){
            $dat['borrow_books']=Borrows::where('uid',$pid)->count();//当前借总数
            if(User::where(['id'=> $pid])->first()){    //最大可借
                $max=User::where(['id'=> $pid])->first()->max_booknumber;//最大可借
                if($dat['borrow_books']>$max){
                    return back()->with('errors','不能再借书了，超出最大限制');
                }else{
                    Partners::where('id',$pid)->update($dat);    //更新借书的数目
                }
            }
        }else{
            return back()->with('errors','用户ID输入有误');
        }
    }

      public function delets($input){
          Borrows::where('uname',$input['book_name'])->delete();
      }
}