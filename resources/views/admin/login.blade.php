@extends('layouts.admin')

@section('content')

<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Zengzy</h1>
		<br>
		<div class="form">
			@if(session('msg'))
				<p style="color:red">{{session('msg')}}</p>				
			@endif

			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="user_name" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="user_pass" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('admin/code')}}" alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="登 录"/>
					</li>
				</ul>
			</form>
		</div>
	</div>

@endsection