@extends('layout.layout')

@section('content')
    <div class="layui-container" style="margin-top: 20px;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8">

                <div class="fly-panel" style="margin-bottom: 0;">

                    <div class="fly-panel-title fly-filter">
                        <a href="" class="layui-this">综合</a>
                    </div>

                    <ul class="fly-list">
                        <li>
                            <a href="users/home.html" class="fly-avatar">
                                <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg"
                                     alt="贤心">
                            </a>
                            <h2>
                                <a class="layui-badge">分享</a>
                                <a href="{{url('/detail')}}">基于 layui 的极简社区页面模版</a>
                            </h2>
                            <div class="fly-list-info">
                                <a href="users/home.html" link>
                                    <cite>贤心</cite>
                                    <!--
                                    <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                                    <i class="layui-badge fly-badge-vip">VIP3</i>
                                    -->
                                </a>
                                <span>刚刚</span>

                                <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i
                                            class="iconfont icon-kiss"></i> 60</span>
                                <!--<span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>-->
                                <span class="fly-list-nums">
                                    <i class="iconfont icon-pinglun1" title="回答"></i> 66
                                </span>
                            </div>
                            <div class="fly-list-badge">
                                <!--<span class="layui-badge layui-bg-red">精帖</span>-->
                            </div>
                        </li>
                    </ul>
                    <div style="text-align: center">
                        <div class="laypage-main">
                            <a href="jie/index.html" class="laypage-next">更多求解</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="layui-col-md4">

                <div class="fly-panel">
                    <div class="fly-panel-title">
                        发布文章
                    </div>
                    <div class="fly-panel-main fly-signin-main">
                        <a href="{{url('/write')}}" class="layui-btn layui-btn-primary">发布文章</a>
                    </div>
                </div>


                <div class="fly-panel">
                    <div class="fly-panel-title">
                        创建书籍
                    </div>
                    <div class="fly-panel-main">
                        <form class="layui-form" action="#">
                            <div style="display: flex;">
                                <input id="input_val" type="text" value="" name="book_name" lay-verify="required"
                                       placeholder="输入书名"
                                       class="layui-input">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div style="width: 20px;"></div>
                                <button class="layui-btn layui-btn-warm" lay-submit lay-filter="create">创建</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="fly-panel fly-link">
                    <h3 class="fly-panel-title">书籍列表</h3>
                    <dl class="fly-panel-main" id="book_list">
                    </dl>
                </div>

                <div class="fly-panel fly-signin">
                    <div class="fly-panel-title">
                        签到
                    </div>
                    <div class="fly-panel-main fly-signin-main">
                        <button class="layui-btn layui-btn-danger" id="LAY_signin">今日签到</button>
                        <span>可获得<cite>5</cite>飞吻</span>
                        <!-- 已签到状态 -->
                        <!--
                        <button class="layui-btn layui-btn-disabled">今日已签到</button>
                        <span>获得了<cite>20</cite>飞吻</span>
                        -->
                    </div>
                </div>

                <div class="fly-panel fly-rank fly-rank-reply" id="LAY_replyRank">
                    <h3 class="fly-panel-title">回贴周榜</h3>
                    <dl>
                        <!--<i class="layui-icon fly-loading">&#xe63d;</i>-->
                        <dd>
                            <a href="users/home.html">
                                <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg"><cite>贤心</cite><i>106次回答</i>
                            </a>
                        </dd>
                    </dl>
                </div>

                <div class="fly-panel fly-link">
                    <h3 class="fly-panel-title">友情链接</h3>
                    <dl class="fly-panel-main">
                        <dd><a href="http://www.layui.com/" target="_blank">layui</a>
                        <dd>
                    </dl>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['form', 'jquery'], function () {
            var form = layui.form
            var $ = layui.jquery

            var getBooks = function () {
                $.ajax({
                    url: '/books',
                    method: 'get',
                    data: {},
                    dataType: 'JSON',
                    success: function (res) {
                        if (res.code == 200) {
                            var str = '';
                            res.data.forEach(function (val, index) {
                                str += "<dd><a href= " + val['id'] + " target='_blank'>" + val['name'] + "</a><dd>"
                            })
                            $('#book_list').append(str)
                        } else {
                            layer.msg(res.msg);
                        }
                    }
                });
            }

            form.on('submit(create)', function (data) {
                $.ajax({
                    url: '/create-book',
                    method: 'post',
                    data: data.field,
                    dataType: 'JSON',
                    success: function (res) {
                        if (res.code == 200) {
                            layer.msg((res.msg));
                            var str = "<dd><a href= " + res.data['id'] + " target='_blank'>" + res.data['name'] + "</a><dd>"
                            $('#book_list').append(str)
                            $('#input_val').val(' ')
                        } else {
                            layer.msg(res.msg);
                        }
                    }
                });
                return false
            })

            getBooks();

        });

    </script>
@endsection

