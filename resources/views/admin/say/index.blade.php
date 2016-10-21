@extends('layouts.admin')

@section('content')
<body>

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>全部说说</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/say/create')}}"><i class="fa fa-plus"></i>新增说说</a>
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
                        <th>内容</th>
                        <th>作者</th>
                        <th>发布时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" maxlength="3" onchange="changeOrder(this,{{$v->say_id}})" value="{{$v->say_order}}">
                        </td>                    
                        <td class="tc">{{$v->say_id}}</td>
                        <td>{{$v->say_content}}</td>
                        <td>{{$v->say_author}}</td>
                        <td>{{$v->say_createtime}}</td>
                        <td>{{$v->say_updatetime}}</td>
                        <td>
                            <a href="{{url('admin/say/'.$v->say_id.'/edit')}}">编辑</a>
                            <a href="javascript:;" onclick="delSay({{$v->say_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

<style>
    .result_content ul li span {
        font-size: 15px;
        padding: 6px 12px;
    }
</style>

<script>

    function changeOrder(obj,say_id){
        var say_order = $(obj).val();
        $.post("{{url('admin/say/changeorder')}}",{'_token':'{{csrf_token()}}','say_id':say_id,'say_order':say_order},function(data){
            if(data.status == 0){
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
    }

    //删除分类
    function delSay(say_id) {
        layer.confirm('您确定要删除这条说说吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/say')}}/"+say_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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