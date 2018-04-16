@extends('layouts.admin_main')
@section('content')
    <div class="main ">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-car"></i></h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{url('admin')}}">首页</a></li>
                    <li><i class="fa fa-file-text"></i><a href="{{url('admin/book')}}">图书中心</a></li>
                    <li><i class="fa fa-pencil"></i><a href="#">已借出</a></li>
                </ol>
            </div>
        </div>
        <div class="panel panel-default">
            <!-- Default panel contents -->

            <!-- Table -->
            <table class="table table-hover">
                <thead>
                <tr class="info">
                    <td>排序</td>
                    <td>书名</td>
                    <td>作者</td>
                    <td>ISBN</td>
                    <td>借出时间</td>
                    <td>归还时间</td>
                    <td>应收取费用</td>
                    <td>ID</td>
                  </tr></thead>
                <tobody>
                  @foreach($d as $i=>$t)
                        @foreach($t->borrows as $j=>$u)<tr>
                  <td  class=" col-md-2 " >
                      {{$j}}
                  </td>

                    <td >{{$u->uname}}</td>
                        <td >{{$u->author}}</td>
                        <td >{{$u->ISBN}}</td>
                        <td >{{$u->borrow_time}}</td>
                        <td>{{$u->return_time}}</td>
                        <td>{{$u->counts}}</td>
                        <td>{{$u->id}}</td>
                    </tr>@endforeach
                    @endforeach
           </tobody></table>
               {{--<div class="fenpage">{!! @$data->links() !!}</div>--}}
                <script>
                    function changeorder(obj,id){
                        var orders=$(obj).val();
                        $.post('{{url('admin/partner/change')}}',{_token:'{{csrf_token()}}',orders:orders,'id':id},function(data){
                            if(data.state==1){
                                layer.msg(data.vul, {icon: 6});
                            }   else{
                                layer.msg(data.vul, {icon: 5});
                            }
                        });
                    }
                    function delet(id){
                        layer.msg('确认删除吗', { time: 20000, //20s后自动关闭
                         btn: ['确定', '取消']
                        },function() {
                            $.post('{{url('admin/partner/')}}/'+id+'', {_token: '{{csrf_token()}}', _method: 'delete', id: id}, function (data) {
                                if (data.state==1) {
                                  window.location.reload();
                                    layer.msg(data.vul, {icon: 6});
                                } else {
                                    layer.msg(data.vul, {icon: 5});
                                }
                            });
                        },function(){
                            });
                    }
                </script>
        </div>
    </div>
    @endsection