@extends('layouts.admin')
@section('css')
    <link href="{{asset('')}}resources/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
@endsection
@section('content')
    <body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加分类</h5>

                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{url('admin/category')}}" class="form-horizontal m-t" id="commentForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">分类名称：</label>
                                <div class="col-sm-8">
                                    <input  name="cate_name" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                    @if(in_array('0',$errors->all()))
                                    <span id="firstname-error" class="help-block m-b-none">
                                    <i class="fa fa-times-circle"></i>
                                         分类名称不可为空
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">分类标题：</label>
                                <div class="col-sm-8">
                                    <input  name="cate_title" minlength="2" type="text" class="form-control" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">上级分类：</label>
                                <div class="col-sm-8">
                                    <select name="cate_pid" class="form-control">
                                        <option value="0">== 顶级分类 ＝＝</option>
                                        @foreach($data as $k=>$v)
                                            <option value="{{$v['cate_id']}}">{{$v['cate_name']}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">关键词：</label>
                                <div class="col-sm-8">
                                    <input  name="cate_keywords"  type="text" class="form-control"  aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">分类描述：</label>
                                <div class="col-sm-8">
                                    <textarea id="ccomment" name="cate_descrition" class="form-control" aria-required="true"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">排序：</label>
                                <div class="col-sm-1">
                                    <input  name="cate_sort" minlength="1" maxlength="3" type="text" class="form-control" aria-required="true">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-7 col-sm-offset-3">
                                    <a class="btn btn-primary" href="{{url('admin/category')}}">返回</a>
                                    <button class="btn btn-primary " type="submit">提交</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="{{asset('')}}resources/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="{{asset('')}}resources/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="{{asset('')}}resources/admin/js/content.min.js?v=1.0.0"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/validate/messages_zh.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/demo/form-validate-demo.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}resources/admin/js/sId_9051096.js" charset="UTF-8"></script>

    </body>
    @if(session('msg')=='0')
        <script>
            swal({
                title: "修改失败",
                type: "warning",
                timer:1000
            })
        </script>
    @endif

@endsection
