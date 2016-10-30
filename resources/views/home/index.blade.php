@extends('layouts.home')

@section('head')
	<title>Purein</title>
	<meta name="keywords" content="{{Config::get('web.index_keywords')}}" />
	<meta name="description" content="{{Config::get('web.index_description')}}" />	
@endsection

@section('content')

	@parent
              <form class="navbar-form navbar-right" method="get" action="">  
                <input type="text" placeholder="For title" name="where" class="form-control"
                @if(isset($where) && count($where) > 0)
                value = "{{$where}}"
                @endif
                >
                <button type="submit" class="btn btn-default">Do</button>
              </form>
            </div>
          </div>
        </nav>
        
<div id="information">
	<div class="container">
		<div class="row">

			<div class="col-md-3 text-center">
				<div class="myInfo">
			                    <img src="{{asset('style/home/img/antlers.jpg')}}" class="img-thumbnail" alt="{{Config::get('web.personal_alt')}}">
					{!! Config::get('web.personal_info') !!}
					<div class="social-share text-center">
					</div>	
					<br>				  
				</div>
			</div>

			<div class="col-md-9 offset">
				<div class="container-fluid" style="padding:0;">
				
					@if(count($say)>0)
						<div class="row info-content">
							<div class="col-md-10 col-sm-10 col-xs-12">
								<div class="well">
									<h5>{{$say->say_author}}：</h5>
									<h3 class="page-header">{{$say->say_content}}</h3>
									<p class="text-right">{{substr($say->say_updatetime,0,16)}}</p>
								</div>	

							</div>
						</div>

						<hr>						
					@endif				

					<div class="row info-content">
						<div class="col-md-10 col-sm-10 col-xs-12">
							@foreach($categorys as $v)
								@if($v->cate_pid==0)
								  <br>
								@endif							
								<span class="cateStyle">
								@if($v->cate_pid==0)								
									<a href="javascript:;" title="{{$v->cate_name}}" style="cursor:default">| {{$v->cate_name}} |</a>
								@else
								    <a href="{{url('c/'.$v->cate_id)}}" title="{{$v->cate_name}}">{{$v->cate_name}}</a>			
								@endif									
								</span>
							@endforeach	
						</div>						
					</div>

					@if(count($article) > 0)
	            				@foreach($article as $v)
							<div class="row info-content">	            	
								@if(!empty($v->art_thumb))								
								<div class="col-md-3 col-sm-3 col-xs-5">
									<img src="{{$v->art_thumb}}" class="img-thumbnail" alt="{{$v->art_title}}">
								</div>
								<div class="col-md-7 col-sm-7 col-xs-7">
								@else
								<div class="col-md-10 col-sm-10 col-xs-10">
								@endif									
								
									<h4><a title="{{$v->art_title}}" href="{{url('a/'.$v->art_id)}}">{{$v->art_title}}</a></h4>
									<p class="hidden-xs">{{$v->art_description}}</p>
									<p>{{$v->art_author}} &nbsp;{{$v->art_updatetime}}</p>
								</div>	
							</div>								
	            				@endforeach

							<div class="row info-content text-center">
								<div class="col-md-9 col-sm-9 col-xs-12">												
									<ul class="pagination">
		                							{{$article->appends(['where'=>$where])->links()}}
									</ul>
								</div>	
							</div>	            				
	            			@else
	            				<div class="row info-content">	            			
							<div class="col-md-8 col-sm-8 col-xs-10 text-center h3">
								I'm coming !
							</div>
						</div>
	            			@endif
	  
				</div>
			</div>

			@if(count($article) > 0)
			<div class="col-md-1 text-center location">	
				<a href="#" id="returnTop"><code>↑ 顶 部</code></a>
			</div>
			@endif

		</div>		
	</div>	
</div>

@endsection

@section('footer')

	@parent

@endsection