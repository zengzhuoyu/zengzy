@extends('layouts.admin')
@section('content')
<body>

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>编辑导航</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/nav')}}"><i class="fa fa-bars"></i>全部导航</a>        
            <a href="{{url('admin/nav/create')}}"><i class="fa fa-plus"></i>新增导航</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/nav/'.$field -> nav_id)}})}}" method="post">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i> 导航名称：</th>
                <td>
                    <input type="text" name="nav_name" value="{{$field -> nav_name}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>前台显示的名称</span>                    
                </td>
            </tr>                     
            <tr>
                <th><i class="require">*</i> Url：</th>
                <td>
                    <input type="text" class="lg" name="nav_url" value="{{$field -> nav_url}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>以 "http://" 开头</span>                                
                </td>
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <input type="text" class="lg" name="nav_description" value="{{$field -> nav_description}}">
                </td>
            </tr>             
            <tr>
                <th>位置：</th>
                <td>
                    <input type="radio" name="nav_status" value="1"  @if($field->nav_status == 1) checked="checked" @endif>子 页　                
                    <input type="radio" name="nav_status" value="0"  @if($field->nav_status == 0) checked="checked" @endif>首 页
                </td>
            </tr>            
            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="nav_order" maxlength="3" value="{{$field -> nav_order}}">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

@endsection
