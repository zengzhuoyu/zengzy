@extends('layouts.admin')

@section('content')
<body>
    
<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>新增用户</h3>
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
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form method="post" action="">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i> 用户名：</th>
                <td>
                    <input type="text" name="user_name">    
                    <span><i class="fa fa-exclamation-circle yellow"></i>4至10位</span>                            
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i> 密 码：</th>
                <td>
                    <input type="password" name="user_pass">
                    <span><i class="fa fa-exclamation-circle yellow"></i>6至20位</span>                        
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i> 确认密码：</th>
                <td>
                    <input type="password" name="user_pass_confirmation">             
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