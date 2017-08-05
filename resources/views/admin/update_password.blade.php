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
                        <h5>修改密码</h5>

                    </div>
                    <div class="ibox-content">
                        <form method="post" action="" class="form-horizontal m-t" id="commentForm">
                            {{csrf_field()}}
                            <div class="form-group @if(in_array('4',$errors->all())) has-error @endif">

                                <label class="col-sm-3 control-label">原密码：</label>
                                <div class="col-sm-6">
                                    <input id="cname" name="password_old" minlength="2" type="password" class="form-control" required="" aria-required="true">
                                    <span class="help-block m-b-none">

                                        @if(in_array('4',$errors->all()))
                                            <i class="fa fa-times-circle"></i>原密码输入错误
                                        @else
                                            <i class="fa fa-info-circle"></i>请输入原密码
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="form-group @if(in_array('0',$errors->all())||in_array('1',$errors->all())) has-error @endif">
                                <label class="col-sm-3 control-label">新密码：</label>
                                <div class="col-sm-6">
                                    <input id="cemail" type="password" class="form-control" name="password" required="" aria-required="true">
                                    <span class="help-block m-b-none">
                                        @if(in_array('0',$errors->all()))
                                            <i class="fa fa-times-circle"></i> 新密码不能为空
                                        @elseif(in_array('1',$errors->all()))
                                            <i class="fa fa-times-circle"></i> 新密码长度必须在6－20位之间
                                        @else
                                            <i class="fa fa-info-circle"></i> 新密码长度必须在6－20位之间
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="form-group @if(in_array('2',$errors->all()))has-error @endif">
                                <label class="col-sm-3 control-label">确认密码：</label>
                                <div class="col-sm-6">
                                    <input id="cemail" type="password" class="form-control" name="password_confirmation" required="" aria-required="true">
                                    <span class="help-block m-b-none">
                                        @if(in_array('2',$errors->all()))
                                            <i class="fa fa-times-circle"></i>两次密码输入不一致
                                        @else
                                            <i class="fa fa-info-circle"></i> 请再次输入新密码
                                        @endif

                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
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

    <script src="{{asset('')}}resources/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}resources/admin/js/sId_9051096.js" charset="UTF-8"></script>

</body>
@if(session('msg'))
<script>
    swal({
        title: "修改成功",
        type: "success",
        timer:1000
    })
</script>
@endif
@endsection