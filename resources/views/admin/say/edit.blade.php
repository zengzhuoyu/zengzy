@extends('layouts.admin')

@section('content')
<body>

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>新增说说</h3>
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        <!-- withErrors -->
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <!-- 密码修改成功 + 原密码错误 -->                
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif            
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/say')}}"><i class="fa fa-bars"></i>全部说说</a>
                <a href="{{url('admin/say/create')}}"><i class="fa fa-plus"></i>新增说说</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/say/'.$field->say_id)}}" method="post">
            <input type="hidden" name="_method" value="put">    
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i> 作者：</th>
                        <td>
                            <input type="text" name="say_author" class="sm" value="{{$field->say_author}}">
                        </td>
                    </tr>                 
                    <tr>
                        <th><i class="require">*</i> 内容：</th>
                        <td>
                            <textarea name="say_content">{{$field->say_content}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" class="sm" name="say_order" maxlength="3" value="{{$field->say_order}}">
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