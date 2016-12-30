<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><? echo $pageTitle ?></title>

    <? require_once "App/views/blocks/metaHeaders.php"; ?>
    
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

                <? if($error){ ?>
                <br><br>
                <div class="alert alert-danger m20"><b>Ошибка!</b> <? echo $error["error_text"] ?></div>
                <? } ?>

                <? if($succes){ ?>
                <br><br>
                <div class="alert alert-success m20"><b>!</b> <? echo $succes["succes_text"] ?></div>
                <? } ?>


                <div class="social-box">
                    <div class="row mg-btm">
                        <div class="col-md-12">

                            <span class="text-center">
                                <div id="uLogin_7f590f1f" data-uloginid="7f590f1f"></div>
                            </span>

                        </div>
                    </div>
                </div>
                <div class="main">

                    <input type="text" value="<? echo $inputs_val["email"] ?>" name="email" class="form-control" placeholder="Email" autofocus>
                    <input type="password" value="<? echo $inputs_val["pass"] ?>" name="pass" class="form-control" placeholder="Password">

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


<? require_once "App/views/blocks/scripts.php"; ?>
<script src="//ulogin.ru/js/ulogin.js"></script>
</body>
</html>