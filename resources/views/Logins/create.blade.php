<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>登录</title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
{{--登录表单页--}}
<div class="container">
    <div style="height: 20px"></div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4"><p style="font-size: 30px;font-family: 楷体;text-align: center">登录</p></div>
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="exampleInputEmail1">电话</label>
                    <input type="text" value="{{old('phone')}}" name="phone" class="form-control" id="exampleInputEmail1" placeholder="请输入常用手机号">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密码</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="请尽量设置安全的密码">
                </div>

                <div class="form-group">
                    <label for="captcha">验证码</label>
                    <input id="captcha" class="form-control" name="captcha" placeholder="验证码">
                    <p></p>
                    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox">记住我
                    </label>
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-block btn-primary">点击注册</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/js/jquery-3.2.1.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/js/bootstrap.js"></script>
</body>
</html>