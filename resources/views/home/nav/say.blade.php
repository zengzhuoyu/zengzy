@extends('layouts.home')

@section('head')
  <title>Purein - {{Config::get('web.say_name')}}</title>
  <meta name="keywords" content="{{Config::get('web.say_keywords')}}" />
  <meta name="description" content="{{Config::get('web.say_description')}}" /> 
@endsection

@section('content')

  @parent
            </div>
          </div>
        </nav>

<div id="information">
	<div class="container">
		<div class="row text-center">

			<div class="col-md-7 col-sm-9 center">
				@if(count($say) > 0)
	        				@foreach($say as $v)					
						<div class="well">
							<h5 class="text-left">{{$v->say_author}}：</h5>
							<h3 class="page-header text-left">{{$v->say_content}}</h3>
							<p class="text-right">{{$v->say_updatetime}}</p>
						</div>	
	        				@endforeach
	        				
					<ul class="pagination">
	    					{{$say->links()}}
					</ul>
            			@else

					<div class="h3">i a'm coming soon !</div>

            			@endif

			</div>

			<div class="col-md-1 text-center location">
				<br>
				<a href="" onclick="history.go(-1)"><code>返 回</code></a>
			</div>			

		</div>		
	</div>	
</div>

@endsection

@section('footer')

  @parent

@endsection