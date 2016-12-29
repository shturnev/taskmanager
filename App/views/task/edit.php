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
        .input-group-addon{
            border-color: #eeeeee;
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
            <li class="active"><a href="/task">Задачи</a></li>
            <li class="active">Создать</li>
        </ol>
    </div><!--/.row-->

    <? if($error){ ?>
    <div class="row p15 mt20">
        <div class="alert bg-danger" role="alert">
            <svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg>
            <? echo $error["error_text"] ?>
        </div>
    </div>
    <? } ?>



    <div class="row mt35">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Добавить задачу</div>
                <div class="panel-body">

                    <form action="" method="post" enctype="multipart/form-data" >
                        <input type="hidden" name="referer" value="<? echo $referer ?>">
                        <input type="hidden" name="method_name" value="edit">
                        <input type="hidden" name="ID" value="<? echo $inputs_val["ID"] ?>">

                        <div class="form-group">
                            <label>Заголовок</label>
                            <input name="title" value="<? echo $inputs_val["title"] ?>" class="form-control" required>
                        </div>

                        <? if($resTeam["items"]): ?>
                        <div class="form-group">
                            <label>Для кого?</label>
                            <select name="for_user_id" class="form-control">
                                <option>Для себя</option>
                                <? foreach ($resTeam["items"] as $item) {
                                    $selected = ($item["ID"] == $inputs_val["for_user_id"])? "selected" : null;
                                ?>
                                    <option value="<? echo $item["ID"] ?>" <? echo $selected ?>><? echo $item["email"] ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <? endif; ?>

                        <div class="form-group">
                            <label>Дата когда задача должна быть выполнена (Deadline)</label>
                            <div class='input-group date' id='datepicker1'>
                                <input name="date_deadline" value="<? echo date("m/d/Y", $inputs_val["date_deadline"]) ?>" type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Текст</label>
                            <div>
                                <textarea id="editor1" name="text"><? echo $inputs_val["text"] ?></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="pull-left">
                                <a href="<? echo $referer ?>" class="btn btn-default">Отмена</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary">Готово</button>
                            </div>
                        </div>

                    </form>


                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>


</div>	<!--/.main-->

<!--<script src="/resources/lumino/js/jquery-1.11.1.min.js"></script>
<script src="/resources/lumino/js/bootstrap.min.js"></script>-->
<? require_once "App/views/blocks/scripts.php"; ?>

<!--<script src="/resources/lumino/js/chart.min.js"></script>-->
<!--<script src="/resources/lumino/js/chart-data.js"></script>-->
<!--<script src="/resources/lumino/js/easypiechart.js"></script>-->
<!--<script src="/resources/lumino/js/easypiechart-data.js"></script>-->
<script src="/resources/lumino/js/bootstrap-datepicker.js"></script>
<script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
<script>

    CKEDITOR.replace( 'editor1' );
    $('#datepicker1').datepicker({});



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