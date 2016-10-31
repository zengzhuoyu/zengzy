<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <title>Purein - 私密登录</title>
    <link rel="Shortcut Icon" href="{{asset('style/home/img/antlers.jpg')}}" type="image/ico">    
    <link rel="stylesheet" href="{{asset('style/home/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/home/css/style.css')}}">
    <script src="{{asset('style/home/js/jquery.min.js')}}"></script>
    <script src="{{asset('style/home/js/bootstrap.min.js')}}"></script>  
</head>
<body>

<div id="information">

    <div class="container">

	<div class="col-md-3 col-sm-5 col-xs-9 center">
				
		<form class="form-signin" role="form" action="" method="post">
			{{csrf_field()}}	      
			<h2 class="form-signin-heading">登 录</h2>
			@if(session('msg'))
				<p style="color:red">{{session('msg')}}</p>				
			@endif			
			<input type="text" name="user_name" class="form-control" placeholder="Username" required autofocus>
			<br>
			<input type="password" name="user_pass" class="form-control" placeholder="Password" required>
			<br>
			<button class="btn btn-lg btn-primary btn-block" type="submit">OK</button>
		</form>		

	</div>

    </div>

</div>

</body>
</html>
