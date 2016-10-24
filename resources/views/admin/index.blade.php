@extends('layouts.admin')

@section('content')
<body>
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">后台管理系统</div>
			<ul>
				<li><a href="{{url('admin/info')}}" target="main">系统信息</a></li>			
				<li><a href="{{url('/')}}" target="_blank">前台首页</a></li>
				@if(session('changePass'))				
				<li><a href="{{url('d')}}" target="_blank">前台日记</a></li>
            			@endif				
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li><a href="{{url('admin/user')}}" target="main">新增用户</a></li>
				@if(session('changePass'))
				<li><a href="{{url('admin/pass')}}" target="main">修改密码</a></li>			
            			@endif				
				<li><a href="{{url('admin/quit')}}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>内容管理</h3>
                <ul class="sub_menu">
			@if(session('changePass'))                	
			<li><a href="{{url('admin/say')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>说 说</a></li>				
			<li><a href="{{url('admin/category')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>分 类</a></li>							
            		@endif			
			<li><a href="{{url('admin/article')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>文 章</a></li>							
                </ul>
            </li>
	@if(session('changePass'))            
            <li>
            	<h3><i class="fa fa-fw fa-cog"></i>系统设置</h3>
                <ul class="sub_menu" style="display:block;">
			<li><a href="{{url('admin/nav')}}" target="main"><i class="fa fa-fw fa-group"></i>导 航</a></li>                          
			<li><a href="{{url('admin/config')}}" target="main"><i class="fa fa-fw fa-cogs"></i>配 置</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
                <ul class="sub_menu" style="display:block;">
                    <li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>
                    <li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
                    <li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
                    <li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>
                </ul>
            </li>
          	@endif            
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe> 
	</div>
	<!--主体部分 结束-->

@endsection