<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>my blog - register</title>

    <!-- Bootstrap Core CSS -->
    <link href="/blog/Public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/blog/Public/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/blog/Public/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/blog/Public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    请先注册 <a href="/blog/Home/User/login" style="float:right;color: #999;">已有账号？去登录</a>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <input id="user" class="form-control" placeholder="用户名" name="username" type="text"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <input id="psw" class="form-control" placeholder="密码" name="password" type="password"
                                       value="">
                            </div>
                            <a href="javascript:;" class="btn btn-lg btn-success btn-block" id="register">注 册</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="/blog/Public/bower_components/jquery/dist/jquery.min.js"></script>

<!-- jQuery md5 -->
<script src="/blog/Public/js/jQuery.md5.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/blog/Public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/blog/Public/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/blog/Public/dist/js/sb-admin-2.js"></script>

<script type="text/javascript">
    $(function () {
        $("#register").click(function () {
            var user = $("#user").val();
            var psw = $("#psw").val();
            if ($.trim(user) == "" || $.trim(psw) == "") {
                alert("请填写完整");
                return;
            }

            $.ajax({
                url: "/blog/Home/User/checkRegister",
                type: "post",
                data: {
                    user: user,
                    psw: $.md5(psw)
                },
                success: function (result) {
                    if (result == "success") {
                        window.location.href = "/blog/Home/User/login";
                    } else alert(result);
                }
            });
        });

        // 监听回车键事
        $(document).keypress(function (e) {
            if (e.which == 13) {
                $("#register").click();
            }
        });
    });
</script>
</body>

</html>