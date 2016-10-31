@extends('layouts.admin')

@section('content')
<body>

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>全部用户</h3>
            </div>
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>                 
                        <th>用户名</th>
                        <th>前台权限</th>
                        <th>后台权限</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>              
                        <td>{{$v->user_name}}</td>
                        <td>
                            <a href="javascript:;" onclick="changeHomeStatus(this,{{$v->user_id}})" statusVal="{{$v->h_status}}">
                                @if($v->h_status == 0)
                                        打开
                                @else
                                        关闭
                                @endif
                            </a>                              
                        </td>
                        <td>
                            <a href="javascript:;" onclick="changeAdminStatus(this,{{$v->user_id}})" statusVal="{{$v->a_status}}">
                                @if($v->a_status == 0)
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

        //改变前台权限状态
        function changeHomeStatus(obj,user_id) {

                var statusVal = $(obj).attr('statusVal');

                $.post("{{url('admin/user/changeHomeStatus')}}",{'_token':"{{csrf_token()}}",'user_id':user_id,'h_status':statusVal},function (data) {

                    if(data.status==0){   
                        $(obj).attr('statusVal',data.statusVal);
                        $(obj).html(data.text);
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }

                });
        }    

        //改变后台权限状态
        function changeAdminStatus(obj,user_id) {

                var statusVal = $(obj).attr('statusVal');

                $.post("{{url('admin/user/changeAdminStatus')}}",{'_token':"{{csrf_token()}}",'user_id':user_id,'a_status':statusVal},function (data) {

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