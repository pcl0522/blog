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
                        <h5>文章管理</h5>

                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-12 m-b-xs">
                                <div class="btn-group hidden-xs" id="exampleTableEventsToolbar" role="group">
                                    <a class="btn btn-outline btn-default" href="{{url('admin/category/create')}}" title="添加">
                                        <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-outline btn-default" href="{{url('admin/category')}}" title="刷新">
                                        <i class="glyphicon glyphicon-refresh" aria-hidden="true"></i>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">

                            <table class="table table-striped table-bordered"  data-row-style="rowStyle">
                                <thead>
                                <tr>
                                    <th class="text-center">排序</th>
                                    <th class="text-center">分类ID</th>
                                    <th class="text-center">分类名称</th>
                                    <th class="text-center">分类标题</th>
                                    <th class="text-center">查看次数</th>
                                    <th class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k=>$v)
                                    <tr>

                                        <td class="text-center">
                                            <input type="text" value="{{$v['cate_sort']}}" onchange="changeSort(this.value, {{$v['cate_id']}})" class="form-control" style="width: 36px;padding: 6px;text-align: center;margin: auto">
                                        </td>
                                        <td class="text-center">{{$v['cate_id']}}</td>
                                        <td>{{$v['cate_name']}}</td>
                                        <td class="">{{$v['cate_title']}}</td>
                                        <td class="text-center">{{$v['cate_view']}}</td>
                                        <td class="text-center" class="do">
                                            <a href="javascript:void(0)" onclick="del({{$v['cate_id']}})" title="删除"> <i class="glyphicon glyphicon-trash" aria-hidden="true"></i> </a>
                                            | <a href="{{url('admin/category/'.$v['cate_id'].'/edit')}}" title="修改" > <i class="glyphicon glyphicon-edit"></i> </a>
                                        </td>
                                    </tr>


                                @endforeach
                                </tbody>

                            </table>

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
                $.post("{{url('admin/category')}}/"+cate_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
                    if(data.status==1) {
                        location.href = location.href
                        swal(data.msg, "", "success");
                    }else {
                        swal(data.msg, "", "error");
                    }
                })
            });
        }
        function changeSort(val,sort_id){

            $.post('{{url('admin/cate/changeSort')}}',{'_token':'{{csrf_token()}}','cate_sort':val,'cate_id':sort_id},function(msg){
                layer.msg(msg.msg)
           })
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