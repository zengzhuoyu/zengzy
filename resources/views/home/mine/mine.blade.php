@extends('layouts.home')

@section('head')
  <title>Purein - 文章详情</title>
@endsection

@section('content')

  @parent
            </div>
          </div>
        </nav>

<div id="about">
	<div class="container">

		<div class="row">
			<div class="col-md-9 about center">       
                      <br>
                      <ul class="breadcrumb">
                        <li>{{$cate_name}}</li>
                        <li class="active"><a href="{{url('c/'.$field->cate_id)}}">{{$field -> cate_name}}</a></li>
                      </ul>                        
                      <h3 class="text-center">{{$field -> art_title}}</h3>
                      <p class="text-center">
                        作者：{{$field -> art_author}} | {{$field -> art_view}}
                      </p>       

                      {!! $field -> art_content !!}      

                      <p class="text-right">
                         time：{{str_replace('-',' / ',substr($field -> art_createtime,2,8))}}
                      </p>     
                      <br>
			</div>

              <div class="col-md-1 text-center location">
                <br>
                <a href="#" onclick="javascript:history.go(-1);"><code>返 回</code></a>
              </div>
		</div>
          
          <hr>

          <div class="row">
            <div class="col-md-9 center">
              <ul class="list-unstyled">
              <li>上一篇 : 
                    @if($article['pre'])
                        <a href="{{url('a/'.$article['pre']->art_id)}}">{{$article['pre']->art_title}}</a>
                    @else
                        <span>没有上一篇了</span>
                    @endif
              </li>
              <br>
              <li>下一篇 : 
                    @if($article['next'])
                        <a href="{{url('a/'.$article['next']->art_id)}}">{{$article['next']->art_title}}</a>
                    @else
                        <span>没有下一篇了</span>
                    @endif
              </li>
              </ul>        
            </div>
          </div>

          <div class="row">
            <div class="col-md-9 center">
              <div>
                <div class="h4">相关文章 : </div>
                <ul class="list-inline">
                @if(count($data) == 0)
                    <li>暂无相关文章</li>
                @else                                
                    @foreach($data as $d)
                    <li><a href="{{url('a/'.$d->art_id)}}">{{$d->art_title}}</a></li>
                    @endforeach                
                @endif                    
                </ul>                
              </div>          
            </div>
          </div>

          <div class="row">
            <div class="col-md-8 center">
              <br>
              <div class="social-share text-center">
              </div>
            </div>
          </div>          

	</div>
</div>

@endsection

@section('footer')

  @parent

@endsection