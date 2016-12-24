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

</head>

<body>
<? require_once "App/views/blocks/header.php"; ?>
<? require_once "App/views/blocks/sidebar.php"; ?>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"><a href="/profile">Profile</a></li>
            <li class="active">Settings</li>
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
                <div class="panel-heading">Основные настройки</div>
                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data" name="myForm" target="_self">
                        <input type="hidden" name="method_name" value="edit_profile_info"/>

                        <div class="row">
                            <div class="col-sm-3">

                                <a href="#">
                                    <img src="http://lorempixel.com/150/150/people/" class="img-circle">
                                </a>
                                <div class="form-group mt10">
                                    <label >Добавить фото</label><input type="file" name="avatar">
                                </div>


                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="">Ваше имя (nickname)</label>
                                    <input type="text" name="nickname" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Текст</label>
                                    <textarea name="text" id="editor1"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt25">
                            <input class="btn btn-success" name="submit" type="submit" value="Сохранить"/>
                        </div>

                    </form>


                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Дополнительные настройки</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <form action="" method="post" enctype="multipart/form-data" name="myForm" target="_self">
                                <input type="hidden" name="method_name" value="edit_pass"/>

                                <div class="form-group">
                                    <label for="">Укажите новый пароль</label>
                                    <input name="new_pass1" class="form-control" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="">Укажите новый пароль (повтор)</label>
                                    <input name="new_pass2" class="form-control" type="text">
                                </div>


                                <input class="btn btn-success" name="submit" type="submit" value="Сохранить"/>
                            </form>
                        </div>
                        <div class="col-sm-5">
                            <div class="list-group">
                                <a href="#" class="list-group-item">Обновить токен (снять авторизацию на других устройствах)</a>
                                <a href="#" class="list-group-item list-group-item-danger"><span class="color-red">Удалить аккаунт</span></a>
                            </div>

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