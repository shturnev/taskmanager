<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--custom css-->
    <link rel="stylesheet" href="/resources/css/login.css">

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-4 col-md-offset-4">
            <form action="" method="post" enctype="multipart/form-data" class="form-signin mg-btm">
                <input type="hidden" name="method_name" value="enter">

                <h3 class="heading-desc text-center">
<!--                    <button type="button" class="close pull-right" aria-hidden="true">×</button>-->
                   Welcome to the best task manager!
                </h3>
                <div class="social-box">
                    <div class="row mg-btm">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-primary btn-block">
                                <i class="icon-facebook"></i>    Login with Facebook
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-info btn-block" >
                                <i class="icon-twitter"></i>    Login with Twitter
                            </a>
                        </div>
                    </div>
                </div>
                <div class="main">

                    <input type="text" name="email" class="form-control" placeholder="Email" autofocus>
                    <input type="password" name="pass" class="form-control" placeholder="Password">

<!--                    Are you a business? <a href=""> Get started here</a>-->
                    <span class="clearfix"></span>
                </div>
                <div class="login-footer">
                    <div class="row">
<!--                        <div class="col-xs-6 col-md-6">-->
<!--                            <div class="left-section">-->
<!--                                <a href="">Forgot your password?</a>-->
<!--                                <a href="">Sign up now</a>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="col-xs-12 col-md-12 pull-right">
                            <button type="submit" class="btn btn-large btn-danger pull-right">Login</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/resources/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
