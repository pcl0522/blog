<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" src="{{asset('')}}resources/admin/img/profile_small.jpg" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">Beaut-zihan</strong></span>
                                <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                        </li>
                        <li><a class="J_menuItem" href="{{url('admin/updatepwd')}}">修改密码</a>
                        </li>
                        <li><a class="J_menuItem" href="profile.html">个人资料</a>
                        </li>
                        <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                        </li>
                        <li><a class="J_menuItem" href="mailbox.html">信箱</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{url('admin/logout')}}">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">H+
                </div>
            </li>

            <li>
                <a class="J_menuItem" href="{{url('admin/category')}}"><i class="glyphicon glyphicon-th-list"></i> <span class="nav-label">分类管理</span></a>
            </li>
            <li>
                <a class="J_menuItem" href="{{url('admin/article')}}"><i class="fa fa-newspaper-o"></i> <span class="nav-label">文章管理</span></a>
            </li>

            <li>
                <a href="javascript:void(0)">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span class="nav-label">系统设置 </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{url('admin/links')}}">友情链接</a>
                    </li>
                    <li><a class="J_menuItem" href="{{url('admin/navs')}}">网站导航</a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</nav>
<!--左侧导航结束-->