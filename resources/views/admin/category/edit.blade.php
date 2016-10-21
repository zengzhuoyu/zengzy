@extends('layouts.admin')

@section('content')
<body>

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑分类</h3>
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
                <a href="{{url('admin/category')}}"><i class="fa fa-bars"></i>全部分类</a>
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增分类</a>                
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/category/'.$field->cate_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i> 父级分类：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="0"
                                @if($field->cate_pid != 0) disabled='disabled' @endif
                                >一级分类</option>
                                @foreach($data as $d)
                                <option value="{{$d->cate_id}}"
                                @if($d->cate_id == $field->cate_pid) selected='selected' @endif
                                @if($d->cate_id == $field->cate_id) disabled='disabled' @endif                                
                                > - - {{$d->cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i> 分类名称：</th>
                        <td>
                            <input type="text" name="cate_name" value="{{$field->cate_name}}" maxlength="15">
                            <span><i class="fa fa-exclamation-circle yellow"></i>不超过15字</span>                            
                        </td>                        
                    </tr>
                    <tr>
                        <th>关键词：</th>
                        <td>
                            <textarea name="cate_keywords">{{$field->cate_keywords}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="cate_description">{{$field->cate_description}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" class="sm" name="cate_order" maxlength="3" value="{{$field->cate_order}}">
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