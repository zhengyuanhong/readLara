@extends('layout.layout')

@section('content')
    <div class="layui-container fly-marginTop">
        <div class="fly-panel" pad20 style="padding-top: 5px;">
            <!--<div class="fly-none">没有权限</div>-->
            <div class="layui-form layui-form-pane">
                <div class="layui-tab layui-tab-brief" lay-filter="user">
                    <ul class="layui-tab-title">
                        <li class="layui-this">发表新帖<!-- 编辑帖子 --></li>
                    </ul>
                    <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                        <div class="layui-tab-item layui-show">
                            <form action="" method="post">
                                <div class="layui-row layui-col-space15 layui-form-item">
                                    <div class="layui-col-md4">
                                        <label class="layui-form-label">正在读</label>
                                        <div class="layui-input-block">
                                            <select lay-verify="required" name="book" lay-filter="column">
                                                <option></option>
                                                @foreach($books as $v)
                                                    <option value="{{$v->id}}">《{{$v->name}}》</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="layui-col-md8">
                                        <label for="L_title" class="layui-form-label">标题</label>
                                        <div class="layui-input-block">
                                            <input type="text" id="L_title" name="title" required lay-verify="required"
                                                   autocomplete="off" class="layui-input">
                                            <!-- <input type="hidden" name="id" value="d.edit.id"> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="layui-form-item layui-form-text">
                                    <div class="layui-input-block">
                                        <textarea id="L_content" name="content" required lay-verify="required"
                                                  placeholder="详细描述" class="layui-textarea"
                                                  style="height: 260px;"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="layui-form-item">
                                    <button class="layui-btn" lay-filter="add" lay-submit>立即发布</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['layedit', 'form', 'jquery', 'element'], function () {
            var layedit = layui.layedit
            var form = layui.form
            var $ = layui.jquery
            var element = layui.element

            var index = layedit.build('L_content', {
                tool: [
                    'strong' //加粗
                    , 'italic' //斜体
                    , 'underline' //下划线
                    , 'del' //删除线
                    , '|' //分割线
                    , 'left' //左对齐
                    , 'center' //居中对齐
                    , 'right' //右对齐
                    , 'link' //超链接
                    , 'face' //表情
                ]
            })

            form.verify({
                required: function (value) {
                    return layedit.sync(index)
                }
            })

            form.on('submit(add)', function (data) {
                $.ajax({
                    url: '/article-add',
                    method: 'post',
                    data: data.field,
                    dataType: 'JSON',
                    async: false,
                    success: function (res) {
                        if (res.code == 200) {
                            layer.msg((res.msg));
                            $('#L_content').val('')
                            setTimeout(function () {
                                window.location.href = "/"
                            }, 500)
                        } else {
                            layer.msg(res.msg);
                        }
                    }
                });
                return false
            })

            form.on('submit(create)', function (data) {
                $.ajax({
                    url: 'create',
                    method: 'post',
                    data: data.field,
                    dataType: 'JSON',
                    async: false,
                    success: function (res) {
                        if (res.code == 200) {
                            layer.msg((res.msg));
                            setTimeout(function () {
                                window.location.reload()
                            })
                        } else {
                            layer.msg(res.msg);
                        }
                    }
                });
                return false
            })
        });
    </script>
@endsection
