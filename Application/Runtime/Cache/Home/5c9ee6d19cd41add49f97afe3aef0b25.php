<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>login - my log</title>

    <!-- Bootstrap Core CSS -->
    <link href="/log/Public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/log/Public/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/log/Public/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/log/Public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                    请登录 <a href="/log/Home/User/register" style="float:right;color: #999;">免费注册</a>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <input id="user" class="form-control" placeholder="用户名" name="username" type="text"
                                       value="<?php echo ((isset($user) && ($user !== ""))?($user):''); ?>" autofocus>
                            </div>
                            <div class="form-group">
                                <input id="psw" class="form-control" placeholder="密码" name="password" type="password">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="remember"
                                           <?php echo ((isset($checked) && ($checked !== ""))?($checked):""); ?>>记住用户
                                </label>
                            </div>
                            <a href="javascript:;" class="btn btn-lg btn-success btn-block" id="login">登 录</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="/log/Public/bower_components/jquery/dist/jquery.min.js"></script>

<!-- jQuery md5 -->
<script src="/log/Public/js/jQuery.md5.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/log/Public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/log/Public/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/log/Public/dist/js/sb-admin-2.js"></script>

<script type="text/javascript">
    $(function () {
        $("#login").click(function () {
            var user = $("#user").val();
            var psw = $("#psw").val();
            if ($.trim(user) == "" || $.trim(psw) == "") {
                alert("请填写完整");
                return;
            }

            $.ajax({
                url: "/log/Home/User/checkLogin",
                type: "post",
                data: {
                    user: user,
                    psw: $.md5(psw),
                    remember: $("input[type='checkbox']").is(':checked')
                },
                success: function (result) {
                    if (result == "success") {
                        window.location.href = "/log/Home/Index/index";
                    } else alert(result);
                }
            });
        });

        // 监听回车键事
        $(document).keypress(function (e) {
            if (e.which == 13) {
                $("#login").click();
            }
        });
    });
</script>
</body>

</html>