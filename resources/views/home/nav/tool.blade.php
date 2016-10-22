@extends('layouts.home')

@section('head')
  <title>Purein - {{Config::get('web.tools_name')}}</title>
  <meta name="keywords" content="{{Config::get('web.tools_keywords')}}" />
  <meta name="description" content="{{Config::get('web.tools_description')}}" /> 
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

				<table class="table">
				  <tr class="active">
				  	<td><b>站 点</b></td>
				  	<td><b>描 述</b></td>
				  </tr>					
				  @foreach($tool as $v)
			  	<tr id="tr">
			  		<td><a href="{{$v -> nav_url}}" target="_blank" title="{{$v -> nav_name}}">{{$v -> nav_name}}</a></td>
			  		<td>{{$v -> nav_description}}</td>
			  	</tr>
				  @endforeach
				</table>

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