<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><? echo $pageTitle ?></title>

    <? require_once "App/views/blocks/metaHeaders.php"; ?>
    
    <!--custom css-->
    <link rel="stylesheet" href="/resources/css/welcome.css">

</head>
<body>

<div class="wr">
    <video loop muted autoplay poster="/resources/FILES/video/office.jpg" >
        <source src="/resources/FILES/video/office.mp4" type="video/mp4">
    </video>
    <div class="content">

        <h1 class="mb35">Welcome to the best Task Manager</h1>
        <a href="/login" class="btn btn-lg btn-info">Join To Us</a>

    </div>
</div>


<? require_once "App/views/blocks/scripts.php"; ?>
</body>
</html>