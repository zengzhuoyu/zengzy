@extends('layouts.admin')

@section('content')
<body>

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>全部文章</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>                    
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>点击量</th>
                        <th>作者</th>
                        <th>二级分类</th>
                        <th>发布时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" maxlength="3" onchange="changeOrder(this,{{$v->art_id}})" value="{{$v->art_order}}">
                        </td>                    
                        <td class="tc">{{$v->art_id}}</td>
                        <td><a  
                            @if($v->art_status == 0)
                                    href="{{url('d/'.$v->art_id)}}"
                            @else
                                    href="{{url('a/'.$v->art_id)}}"
                            @endif
                        target="_blank">{{$v->art_title}}</a></td>
                        <td>{{$v->art_view}}</td>
                        <td>{{$v->art_author}}</td>
                        <td>{{$v->cate_name}}</td>
                        <td>{{$v->art_createtime}}</td>
                        <td>{{$v->art_updatetime}}</td>
                        <td>
                            <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">编辑</a>
                            <a href="javascript:;" onclick="delArt({{$v->art_id}})">删除</a>
                            <a href="javascript:;" onclick="changeStatus(this,{{$v->art_id}})" statusVal="{{$v->art_status}}">
                                @if($v->art_status == 0)
                                        打开
                                @else
                                        关闭
                                @endif
                            </a>                            
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

    function changeOrder(obj,art_id){
        var art_order = $(obj).val();
        $.post("{{url('admin/article/changeorder')}}",{'_token':'{{csrf_token()}}','art_id':art_id,'art_order':art_order},function(data){
            if(data.status == 0){
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
    }

    //删除分类
    function delArt(art_id) {
        layer.confirm('您确定要删除这篇文章吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/article')}}/"+art_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if(data.status==0){
                    layer.msg(data.msg, {icon: 6});
                    location.href = location.href;
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            });
        });
    }

        //改变状态
        function changeStatus(obj,art_id) {

                var statusVal = $(obj).attr('statusVal');

                $.post("{{url('admin/article/changestatus')}}",{'_token':"{{csrf_token()}}",'art_id':art_id,'art_status':statusVal},function (data) {

                    if(data.status==0){   
                        $(obj).attr('statusVal',data.statusVal);
                        $(obj).html(data.text);
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }

                });
        }    
</script>

@endsection