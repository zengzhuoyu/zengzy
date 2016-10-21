@extends('layouts.admin')

@section('content')
<body>

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>全部分类</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增分类</a>
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
                        <th>分类名称</th>
                        <th>查看次数</th>
                        <th>操作</th>
                    </tr>

                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" maxlength="3" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}">
                        </td>
                        <td class="tc">{{$v->cate_id}}</td>
                        <td>
                            {{$v->_cate_name}}
                        </td>
                        <td>{{$v->cate_view}}</td>
                        <td>
                            <a href="{{url('admin/category/'.$v->cate_id.'/edit')}}">编辑</a>
                            <a href="javascript:;" onclick="delCate({{$v->cate_id}})">删除</a>
                            <a href="javascript:;" onclick="changeStatus(this,{{$v->cate_id}})" statusVal="{{$v->cate_status}}">
                                @if($v->cate_status == 0)
                                        打开
                                @else
                                        关闭
                                @endif
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

    <script type="text/javascript">

        function changeOrder(obj,cate_id){
            var cate_order = $(obj).val();
            $.post("{{url('admin/cate/changeorder')}}",{'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_order':cate_order},function(data){
                if(data.status == 0){
                    layer.msg(data.msg, {icon: 6});
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            });
        }

        //删除分类
        function delCate(cate_id) {

            layer.confirm('您确定要删除这个分类吗？', {

                    btn: ['确定','取消'] //按钮

                }, function(){

                    $.post("{{url('admin/category')}}/"+cate_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {

                        if(data.status==0){
                            layer.msg(data.msg, {icon: 6});      
                            location.href = location.href;//刷新当前页面

                        }else{
                            layer.msg(data.msg, {icon: 5});
                        }

                    });

                });

        }    

        //改变状态
        function changeStatus(obj,cate_id) {

                var statusVal = $(obj).attr('statusVal');

                $.post("{{url('admin/cate/changestatus')}}",{'_token':"{{csrf_token()}}",'cate_id':cate_id,'cate_status':statusVal},function (data) {

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