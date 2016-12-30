<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><? echo $pageTitle ?></title>

    <? require_once "App/views/blocks/metaHeaders.php"; ?>


    <link href="/resources/lumino/css/datepicker3.css" rel="stylesheet">
    <link href="/resources/lumino/css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="/resources/lumino/js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="/resources/lumino/js/html5shiv.js"></script>
    <script src="/resources/lumino/js/respond.min.js"></script>
    <![endif]-->

    <style>
        .forAvatar{
            display: block;
            width: 150px;
            height: 150px;
            background: no-repeat center / cover;
            border-radius: 50%;
        }
    </style>

</head>

<body>
<? require_once "App/views/blocks/header.php"; ?>
<? require_once "App/views/blocks/sidebar.php"; ?>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"><a href="/profile">Profile</a></li>
            <li class="active"><? echo $profileInfo["nickname"] ?></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><? echo $pageTitle ?></h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Основная инфорция</div>
                <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-3">

                                <div href="#">
                                    <span class="forAvatar" style="background-image:url(<? echo $profileInfo["avatar_big_url"] ?>);"></span>
                                </div>


                            </div>
                            <div class="col-sm-9">
                                <div>Имя (nickname): <b><? echo $profileInfo["nickname"] ?></b></div>
                                <? if($profileInfo["text"]){ ?><div class="mt30"><? echo $profileInfo["text"] ?></div><? } ?>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div><!--/.row-->




</div>	<!--/.main-->

<!--<script src="/resources/lumino/js/jquery-1.11.1.min.js"></script>
<script src="/resources/lumino/js/bootstrap.min.js"></script>-->
<? require_once "App/views/blocks/scripts.php"; ?>

<!--<script src="/resources/lumino/js/chart.min.js"></script>
<script src="/resources/lumino/js/chart-data.js"></script>
<script src="/resources/lumino/js/easypiechart.js"></script>
<script src="/resources/lumino/js/easypiechart-data.js"></script>
<script src="/resources/lumino/js/bootstrap-datepicker.js"></script>

-->
<script src="//cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>

<script>

    CKEDITOR.replace( 'editor1' );

    /*$('#calendar').datepicker({});*/


    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
</body>
</html>