@extends('layouts.admin')

@section('content')
<body>

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑文章</h3>
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
                <a href="{{url('admin/article')}}"><i class="fa fa-bars"></i>全部文章</a>
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/article/'.$field->art_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i> 分类：</th>
                        <td>
                            <select name="cate_id">
                                @foreach($data as $d)
                                <option value="{{$d->cate_id}}"
                                @if($field->cate_id == $d->cate_id) selected="selected" @endif
                                @if($d->cate_pid == 0) disabled="disabled" @endif                                
                                >{{$d->_cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i> 标题：</th>
                        <td>
                            <input type="text" class="lg" name="art_title" maxlength="33" value="{{$field->art_title}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>不超过33字</span>                            
                        </td>
                    </tr>
                    <tr>
                        <th>作者：</th>
                        <td>
                            <input type="text" name="art_author" class="sm" value="{{$field->art_author}}">
                        </td>
                    </tr>
                    <tr>
                        <th>缩略图：</th>
                        <td>
                            <input type="text" size="50" name="art_thumb" value="{{$field->art_thumb}}" placeholder="350 * 220">
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
                            <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                            <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                            <script type="text/javascript">
                                <?php $timestamp = time();?>
                                $(function() {
                                    $('#file_upload').uploadify({
                                        'buttonText' : '图片上传',
                                        'formData'     : {
                                            'timestamp' : '<?php echo $timestamp;?>',
                                            '_token'     : "{{csrf_token()}}"
                                        },
                                        'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                                        'uploader' : "{{url('admin/upload')}}",
                                        'onUploadSuccess' : function(file, data, response) {
                                            $('input[name=art_thumb]').val(data);
                                            $('#art_thumb_img').attr('src','/'+data);
                                            $('.clearThumb').html('[ 清除图片 ]');
                                        }
                                    });
                                });
                            </script>
                            <style>
                                .uploadify{display:inline-block;}
                                .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                                table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                            </style>
                        </td>
                    </tr>
                    <tr>
                        <th>
                        	<a class="clearThumb" href="javascript:;">
			@if(!empty($field->art_thumb))      
			[ 清除图片 ]
			@endif                   		
                        	</a>                        	
                        </th>
                        <td>                                                
                            <img alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;" src="/{{$field->art_thumb}}" onerror="javascript:this.src='http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'">
                        </td>                        
                    </tr>                    
                    <tr>
                        <th>关键词：</th>
                        <td>
                            <input type="text" class="lg" name="art_tag" value="{{$field->art_tag}}">
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="art_description">{{$field->art_description}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>文章内容：</th>
                        <td>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                            <script id="editor" name="art_content" type="text/plain" style="width:860px;height:500px;">{!! $field->art_content !!}</script>
                            <script type="text/javascript">
                                var ue = UE.getEditor('editor');
                            </script>
                            <style>
                                .edui-default{line-height: 28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow: hidden; height:20px;}
                                div.edui-box{overflow: hidden; height:22px;}
                            </style>
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
	
	//清除图片
	$(".clearThumb").click(function(){
		var art_thumb = $("input[name='art_thumb']");
		art_thumb.val('');
		$(this).html('');
		$('#art_thumb_img').attr('src','');
	});	

</script>
@endsection