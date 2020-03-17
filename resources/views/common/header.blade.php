<div class="fly-header layui-bg-black">
  <div class="layui-container">
    <a class="fly-logo" href="/">
      {{--<img src="/res/images/logo.png" alt="layui">--}}
        <text style="color: white;font-weight: bold;font-size: 40px;">FLY</text>
    </a>
    {{--<ul class="layui-nav fly-nav layui-hide-xs">--}}
      {{--<li class="layui-nav-item layui-this">--}}
        {{--<a href="{{url('/users/info')}}"><i class="iconfont icon-jiaoliu"></i>交流</a>--}}
      {{--</li>--}}
      {{--<li class="layui-nav-item">--}}
        {{--<a href="case/case.html"><i class="iconfont icon-iconmingxinganli"></i>案例</a>--}}
      {{--</li>--}}
      {{--<li class="layui-nav-item">--}}
        {{--<a href="http://www.layui.com/" target="_blank"><i class="iconfont icon-ui"></i>框架</a>--}}
      {{--</li>--}}
    {{--</ul>--}}
    
    <ul class="layui-nav fly-nav-user">
      
      <!-- 未登入的状态 -->
      @guest
      <li class="layui-nav-item">
        <a class="iconfont icon-touxiang layui-hide-xs" href="../users/login.html"></a>
      </li>
      <li class="layui-nav-item">
        <a href="{{url('login')}}">登入</a>
      </li>
      <li class="layui-nav-item">
        <a href="{{url('reg')}}">注册</a>
      </li>
     @endguest

      <!-- 登入后的状态 -->
        @auth
      <li class="layui-nav-item">
        <a class="fly-nav-avatar" href="javascript:;">
          <cite class="layui-hide-xs">{{request()->user()->name}}</cite>
          <i class="iconfont icon-renzheng layui-hide-xs" title="认证信息：layui 作者"></i>
          <i class="layui-badge fly-badge-vip layui-hide-xs">VIP3</i>
          <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg">
        </a>
        <dl class="layui-nav-child">
          <dd><a href="{{url('users')}}"><i class="layui-icon" style="margin-left: 2px; font-size: 22px;">&#xe68e;</i>我的主页</a></dd>
          <dd><a href="{{url('users/message')}}"><i class="iconfont icon-tongzhi" style="top: 4px;"></i>我的消息</a></dd>
          <dd><a href="{{url('users/set')}}"><i class="layui-icon">&#xe620;</i>基本设置</a></dd>
          <hr style="margin: 5px 0;">
          <dd><a href="{{url('/logout')}}" style="text-align: center;">退出</a></dd>
        </dl>
      </li>
    @endauth
    </ul>
  </div>
</div>