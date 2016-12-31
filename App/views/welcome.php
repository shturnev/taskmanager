<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><? echo $pageTitle ?></title>

    <? require_once "App/views/blocks/metaHeaders.php"; ?>
    
    <!--custom css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/resources/css/welcome.css">

</head>
<body>

<div class="wr">
    <video loop muted autoplay poster="/resources/FILES/video/office.jpg" >
        <source src="/resources/FILES/video/office.mp4" type="video/mp4">
    </video>
 <div class="for-content">
        <div class="content">
            <h1 class="mb35">Welcome To the best Task Manager!</h1>
            <label for="forLoginCont"><span class="btn btn-lg btn-info">Join To Us</span></label>

        </div>
    </div>

    <input type="checkbox" id="forLoginCont" hidden>
    <div id="login-cont">
        <label for="forLoginCont" class="close"><span class="glyphicon glyphicon-remove"></span></label>

        <div class="form-cont">
            <label for="forLoginCont" class="close"><span class="glyphicon glyphicon-remove"></span></label>
            <div class="clearfix"></div>

            <form action="/login" method="post" enctype="multipart/form-data" name="myForm" target="_self">
                <input type="hidden" name="method_name" value="enter"/>



                <h3 class="mb35">Fast enter</h3>

                <div class="text-center"><span><div id="uLogin_7f590f1f" data-uloginid="7f590f1f"></div></span></div>

                <div class="or"><span>or traditionally</span></div>

                <input type="email" name="email" class="form-control" placeholder="Your email"><br>
                <input type="password" name="pass" class="form-control" placeholder="Your password"><br><br>


                <div class="text-center"><input type="submit" class="btn btn-success" value="Enter"></div>

            </form>

        </div>
    </div>
</div>

<? require_once "App/views/blocks/scripts.php"; ?>
<script src="//ulogin.ru/js/ulogin.js"></script>
<script src="/resources/js/welcome.js"></script>
</body>
</html>