@extends('layouts.home')

@section('head')
  <title>Purein - {{Config::get('web.store_name')}}</title>
  <meta name="keywords" content="{{Config::get('web.store_keywords')}}" />
  <meta name="description" content="{{Config::get('web.store_description')}}" /> 
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

				@if(count($store) > 0)

            			@else
    					<h4>听说这张图可以治愈颈椎和心情，by the way，本店还没开张</h4>
    					<br>				
					<img class="img-thumbnail" src="{{Config::get('web.store_img')}}">
            			@endif

			</div>	

			<div class="col-md-1 text-center location">
				<br>
				<a href="#" onclick="javascript:history.go(-1);"><code>返 回</code></a>
			</div>			

		</div>		
	</div>	
</div>

@endsection

@section('footer')

  @parent

@endsection