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
                        <h5>修改文章</h5>

                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{url('admin/article/'.$article->art_id)}}" class="form-horizontal m-t" id="commentForm" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><b style="color: red">*</b>标题：</label>
                                <div class="col-sm-8">
                                    <input  name="art_title" value="{{$article['art_title']}}" minlength="2" type="text" class="form-control" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">分类：</label>
                                <div class="col-sm-8">
                                    <select name="cate_id" class="form-control">

                                        @foreach($data as $k=>$v)
                                            <option @if($v->cate_id==$article->cate_id) selected @endif value="{{$v['cate_id']}}">{{$v['cate_name']}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">编辑：</label>
                                <div class="col-sm-2">
                                    <input name="art_editor" value="{{$article['art_editor']}}" minlength="2" type="text" class="form-control" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">缩略图：</label>
                                <div class="col-sm-1">
                                    <div class="thumb">
                                        <img id="thumb_img" src="{{$article['art_thumb']}}" alt="">
                                        <input id="art_thumb" type="file" accept="image/*" name="art_thumb" />
                                        <p class="glyphicon glyphicon-plus" aria-hidden="true"></p>
                                    </div>
                                    <style type="text/css">
                                        div.thumb{display: block;overflow: hidden; position: relative; border:1px solid #ccc;width: 88px;height: 88px;}
                                        div.thumb img{width:100%; display: block;position: relative;z-index: 1; width: 100%;margin: auto}
                                        div.thumb p{position: absolute;z-index:0;color: #e2e2e2;font-size:48px;;display: block; background: #f2f2f2; line-height: 88px;width: 100%; text-align: center}
                                        div.thumb input{filter:alpha(opacity=0); -moz-opacity:0;opacity: 0;background: none; display: block;width: 100%;height: 100%; position: absolute; z-index: 2;top:0;}
                                    </style>
                                </div>
                                <script type="text/javascript" src="{{asset('')}}resources/admin/js/setImagePreview.js"></script>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标签：</label>
                                <div class="col-sm-8">
                                    <input  name="art_tag" value="{{$article['art_tag']}}"  minlength="2" type="text" class="form-control" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">描述：</label>
                                <div class="col-sm-8">
                                    <textarea id="ccomment" name="art_description" class="form-control" aria-required="true">{{$article['art_description']}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><b style="color: red">*</b>内容：</label>
                                <div class="col-sm-8">
                                    <link href="{{asset('')}}resources/admin/plugins/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
                                    <script src="{{asset('')}}resources/admin/js/jquery.min.js?v=2.1.4"></script>
                                     <script type="text/javascript" src="{{asset('')}}resources/admin/plugins/umeditor/third-party/template.min.js"></script>
                                    <script type="text/javascript" charset="utf-8" src="{{asset('')}}resources/admin/plugins/umeditor/umeditor.config.js"></script>
                                    <script type="text/javascript" charset="utf-8" src="{{asset('')}}resources/admin/plugins/umeditor/umeditor.min.js"></script>
                                    <script type="text/javascript" src="{{asset('')}}resources/admin/plugins/umeditor/lang/zh-cn/zh-cn.js"></script>
                                    <script type="text/plain" id="myEditor" name="art_content" style="width:100%;height:320px;">{!! $article['art_content'] !!}</script>

                                    <script type="text/javascript">
                                        //实例化编辑器
                                        var um = UM.getEditor('myEditor');
                                    </script>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <a class="btn btn-primary" href="{{url('admin/article')}}">返回</a>
                                    <button class="btn btn-primary " type="submit">提交</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="{{asset('')}}resources/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="{{asset('')}}resources/admin/js/content.min.js?v=1.0.0"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/validate/messages_zh.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/demo/form-validate-demo.min.js"></script>
    <script src="{{asset('')}}resources/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}resources/admin/js/sId_9051096.js" charset="UTF-8"></script>

    </body>

    <script type="text/javascript">
        @if(count($errors->all())>0)
        swal({
            title: "添加失败",
            type: "error",
            text: "@if(is_object($errors)) @foreach($errors->all() as $error) {{$error}} @endforeach @else {{$errors}} @endif",
            timer:1500
        })

        @endif
        $('input[type="file"]').change(function(){
            var input_id=$(this).attr('id')
            var img_id=$(this).prev().attr('id')
            setImagePreview(input_id,img_id)
        })

    </script>
@endsection
