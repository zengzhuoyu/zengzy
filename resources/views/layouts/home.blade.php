<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    @yield('head')
    <link rel="Shortcut Icon" href="{{asset('style/home/img/antlers.jpg')}}" type="image/ico">    
    <link rel="stylesheet" href="{{asset('style/home/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/home/css/style.css')}}">
    <script src="{{asset('style/home/js/jquery.min.js')}}"></script>
    <script src="{{asset('style/home/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('style/home/js/script.js')}}"></script>
    <!-- share.css -->
    <link rel="stylesheet" href="{{asset('style/home/css/share.min.css')}}">
    <!-- share.js -->
    <script src="{{asset('style/home/js/share.min.js')}}"></script>       
    {!! Config::get('web.web_count') !!}
</head>
<body>

    @section('content')    

        <nav class="navbar navbar-default">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a title="" class="navbar-brand" href="{{url('/')}}">INDEX</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
               @foreach($nav as $v)
                <li><a title="" href="{{$v -> nav_url}}">
                @if(Config::get('web.store_name') == $v -> nav_name)                                
                    <kbd>{{$v->nav_name}}</kbd>
                @else
                    {{$v->nav_name}}</a>            
                @endif  
                </a></li>
               @endforeach
              </ul>        

    @show

    @section('footer')
        <footer class="blog-footer">
            {!! Config::get('web.copyright') !!}            
        </footer>
    @show
</body>
</html>