@extends('layouts.admin')
@section('content')
<body>

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>全部导航</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/nav/create')}}"><i class="fa fa-plus"></i>新增导航</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th>导航名称</th>
                    <th>导航地址</th>
                    <th>描述</th>
                    <th>位置</th>
                    <th>操作</th>
                </tr>

                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,'{{$v->nav_id}}')" value="{{$v->nav_order}}">
                    </td>
                    <td class="tc">{{$v->nav_id}}</td>
                    <td>
                        {{$v->nav_name}}
                    </td>
                    <td>{{$v->nav_url}}</td>
                    <td>{{$v->nav_description}}</td>
                    <td>
                        @if($v -> nav_status == 0)
                            <span style="color:red;">首 页</span>
                        @else
                            子 页
                        @endif
                    </td>
                    <td>
                        <a href="{{url('admin/nav/'.$v->nav_id.'/edit')}}">编辑</a>
                        <a href="javascript:;" onclick="delNav({{$v->nav_id}})">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

<script>
    function changeOrder(obj,nav_id){
        var nav_order = $(obj).val();
        $.post("{{url('admin/nav/changeorder')}}",{'_token':'{{csrf_token()}}','nav_id':nav_id,'nav_order':nav_order},function(data){
            if(data.status == 0){
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
    }

    //删除自定义导航
    function delNav(nav_id) {
        layer.confirm('您确定要删除这个导航吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/nav')}}/"+nav_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if(data.status==0){
                    layer.msg(data.msg, {icon: 6});
                    location.href = location.href;                    
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            });
        });
    }



</script>

@endsection
