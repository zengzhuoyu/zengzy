@extends('layouts.admin')
@section('content')
<body>

<!--结果集标题与配置项组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>新增配置</h3>
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
            <a href="{{url('admin/config')}}"><i class="fa fa-bars"></i>全部配置</a>
        </div>
    </div>
</div>
<!--结果集标题与配置项组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/config')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i> 名称：</th>
                <td>
                    <input type="text" name="conf_title">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i> 变量：</th>
                <td>
                    <input type="text" name="conf_name">
                </td>
            </tr>
            <tr>
                <th>类型：</th>
                <td>
                    <input type="radio" name="conf_type" value="input" checked onclick="showTr()">input　
                    <input type="radio" name="conf_type" value="textarea" onclick="showTr()">textarea　
                    <input type="radio" name="conf_type" value="radio" onclick="showTr()">radio
                </td>
            </tr>
            <tr class="conf_value">
                <th>类型值：</th>
                <td>
                    <input type="text" class="lg" name="conf_value">
                    <p><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置，格式 1|开启,0|关闭</p>
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="conf_order" maxlength="3">
                </td>
            </tr>
            <tr>
                <th>说明：</th>
                <td>
                    <textarea id="" cols="30" rows="10" name="conf_tips"></textarea>
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
<script>
    showTr();
    function showTr() {
        var type = $('input[name=conf_type]:checked').val();
        if(type=='radio'){
            $('.conf_value').show();
        }else{
            $('.conf_value').hide();
        }
    }
</script>
@endsection
