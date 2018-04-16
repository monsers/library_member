@extends('layouts.admin_main')
@section('content')
    <div class="main ">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-car"></i></h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{url('admin')}}">首页</a></li>
                    <li><i class="fa fa-file-text"></i><a href="{{url('admin/book')}}">图书中心</a></li>
                </ol>
            </div>
        </div>
        <div class="panel panel-default">
            <!-- Default panel contents -->

            @if(count($errors)>0)
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <div style=" color:red;background-color: dodgerblue">{{$error}}</div>
                    @endforeach
                @else
                    <div style=" color:red;background-color: dodgerblue">{{$errors}}</div>
                @endif
            @endif
            <form class="form-horizontal" role="form" action="{{$urlname}}" method="post" enctype="multipart/form-data">

                <div style="height: 10px;">{!! @$method !!}</div>
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 col-md-2 col-sm-12 control-label radio-inline">名称</label>
                    <div class="col-lg-10 col-md-10">
                    <div class="col-lg-4 col-md-4 ">
        <div class="input-group">{{@$products->book_name}}
            <input type="hidden" name="names" class="form-control" value="{{@$products->book_name}}">
                    </div>
                        </div>
                </div>
                    </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 col-md-2 col-sm-12 control-label radio-inline">作者</label>
                    <div class="col-lg-10 col-md-10">
                        <div class="col-lg-4 col-md-4 ">
                            <div class="input-group">{{@$products->book_author}}
                                <input type="hidden" name="authors" class="form-control" value="{{@$products->book_author}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 col-md-2 col-sm-12 control-label radio-inline">ISBN</label>
                    <div class="col-lg-10 col-md-10">
                        <div class="col-lg-4 col-md-4 ">
                            <div class="input-group">{{@$products->book_ISBN}}
                                <input type="hidden" name="isbns" class="form-control" value="{{@$products->book_ISBN}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 col-md-2 col-sm-12 control-label radio-inline">位置</label>
                    <div class="col-lg-10 col-md-10">
                        <div class="col-lg-4 col-md-4 ">
                            <div class="col-lg-1">{{@$products->location}} <input type="hidden" name="locations" class="form-control" value="{{@$products->location}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 col-md-2 col-sm-12 control-label">借书</label>
                    <div class="col-lg-10 col-md-10">
                        <div class="col-lg-2 col-md-2"><div class="input-group">
                                <input type="radio" name="book_state" value="1" checked>是
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="pid" class="form-control" placeholder="" value="{{@session('infouser')['id']}}">

                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-10">
                        <button type="submit" class="btn btn-success btn-group">确认</button>
                    </div>
              </div>
                <div style="height: 10px;"></div>
            </form>
        </div>
    </div>    <script>
        initSample();
    </script>
@endsection