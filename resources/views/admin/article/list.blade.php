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
                        <h5>分类管理</h5>

                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-12 m-b-xs">
                                <div class="btn-group hidden-xs" id="exampleTableEventsToolbar" role="group">
                                    <a class="btn btn-outline btn-default" href="{{url('admin/article/create')}}" title="添加">
                                        <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-outline btn-default" href="{{url('admin/article')}}" title="刷新">
                                        <i class="glyphicon glyphicon-refresh" aria-hidden="true"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline">
                                    <option value="0">请选择</option>
                                    <option value="1">选项1</option>
                                    <option value="2">选项2</option>
                                    <option value="3">选项3</option>
                                </select>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div data-toggle="buttons" class="btn-group">
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option1" name="options">天</label>
                                    <label class="btn btn-sm btn-white active">
                                        <input type="radio" id="option2" name="options">周</label>
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option3" name="options">月</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-striped table-bordered"  data-row-style="rowStyle">
                                <thead>
                                <tr>
                                    <th class="col-sm-1"></th>
                                    <th class="col-sm-1">ID</th>
                                    <th class="col-sm-1">缩略图</th>
                                    <th class="col-sm-3">标题</th>
                                    <th class="col-sm-1">编辑</th>
                                    <th class="col-sm-2">标签</th>
                                    <th class="col-sm-1">浏览量</th>
                                    <th class="col-sm-1">发布时间</th>
                                    <th class="col-sm-1" >操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k=>$v)
                                    <tr>

                                        <td>
                                            <input type="text" value="{{$v['art_id']}}" onchange="changeSort(this.value, {{$v['cate_id']}})" class="form-control" style="width: 36px;padding: 6px;text-align: center;margin: auto">
                                        </td>
                                        <td >{{$v['art_id']}}</td>
                                        <td><img src="{{$v['art_thumb']}}" style="max-width: 88px; max-height: 88px"/></td>
                                        <td class="">{{$v['art_title']}}</td>
                                        <td >{{$v['art_editor']}}</td>
                                        <td >{{$v['art_tag']}}</td>
                                        <td>{{$v['art_view']}}</td>
                                        <td >{{date('Y-m-d H:i:s',$v['art_addtime'])}}</td>
                                        <td class="text-center do" >
                                            <a href="javascript:void(0)" onclick="del({{$v['art_id']}})" title="删除"> <i class="glyphicon glyphicon-trash" aria-hidden="true"></i> </a>
                                            | <a href="{{url('admin/article/'.$v['art_id'].'/edit')}}" title="修改" > <i class="glyphicon glyphicon-edit"></i> </a>
                                        </td>
                                    </tr>


                                @endforeach
                                </tbody>

                            </table>
                            <div class="page_links" style="text-align: right">
                                {{$data->links()}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{asset('')}}resources/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="{{asset('')}}resources/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/content.min.js?v=1.0.0"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/iCheck/icheck.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/layer/layer.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/demo/peity-demo.min.js"></script>
    <script>

        function del(cate_id){
            swal({
                        title: "确定删除吗?",
                        text: "确定删除后内容将不可恢复!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定",
                        cancelButtonText: "取消",
                        closeOnConfirm: false
                    },
                    function(){
                        $.post("{{url('admin/article')}}/"+cate_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
                            if(data.status==1) {
                                location.href = location.href
                                swal(data.msg, "", "success");
                            }else {
                                swal(data.msg, "", "error");
                            }
                        })
                    });
        }

        $(document).ready(function(){

            $(document).on('click','#check_all',function(){
                if($('#check_all input').is(':checked')){
                    $(".i-checks").attr('checked','checked')
                    $(".i-checks").parent().addClass('checked')
                }else {
                    $(".i-checks").attr('checked',false)
                    $(".i-checks").parent().removeClass('checked')
                }

            });
            $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})
        });
    </script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    </body>
    @if(session('msg')=='1')
        <script>
            swal({
                title: "修改成功",
                type: "success",
                timer:1000
            })
        </script>

    @endif
@endsection
