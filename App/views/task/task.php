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
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Задачи</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><? echo $pageTitle ?></h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12 text-right mb35">
            <a href="/task/create" class="btn btn-primary btn-lg">Добавить задачу <span class="glyphicon glyphicon-plus-sign"></span></a>
        </div>
    </div><!--/.row-->


    <? if($taskItems["items"]): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
<!--                <div class="panel-heading">Basic Table</div>-->
                <div class="panel-body">

                    <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="active">
                            <th class="text-right">
                                <div class="th-inner ">
                                    <? $color = (!$_GET["sort_by"] or $_GET["sort_by"] == "ID")? "color-orange": "color-gray"; ?>
                                    <a href="<? echo $thisUrl."?sort_by=ID" ?>" class="<? echo $color; ?>">ID</a>
                                </div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="">
                                <div class="th-inner ">
                                    <? $color = ($_GET["sort_by"] == "title")? "color-orange": "color-gray"; ?>
                                    <a href="<? echo $thisUrl."?sort_by=title" ?>" class="<? echo $color; ?>">Title</a>
                                    </div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="">
                                <div class="th-inner ">
                                    <? $color = ($_GET["sort_by"] == "date_created")? "color-orange": "color-gray"; ?>
                                    <a href="<? echo $thisUrl."?sort_by=date_created" ?>" class="<? echo $color; ?>">Date of create</a>
                                    </div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="">
                                <div class="th-inner ">
                                    <? $color = ($_GET["sort_by"] == "date_deadline")? "color-orange": "color-gray"; ?>
                                    <a href="<? echo $thisUrl."?sort_by=date_deadline" ?>" class="<? echo $color; ?>">Date of deadleine</a>
                                    </div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="">
                                <div class="th-inner ">
                                    <? $color = ($_GET["sort_by"] == "date_finished")? "color-orange": "color-gray"; ?>
                                    <a href="<? echo $thisUrl."?sort_by=date_finished" ?>" class="<? echo $color; ?>">Date of finished</a>
                                    </div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="">
                                <div class="th-inner ">
                                    <? $color = ($_GET["sort_by"] == "status")? "color-orange": "color-gray"; ?>
                                    <a href="<? echo $thisUrl."?sort_by=status" ?>" class="<? echo $color; ?>">Status</a>
                                    </div>
                                <div class="fht-cell"></div>
                            </th>
                            <th class="text-center">
                                <div class="th-inner ">Settings</div>
                                <div class="fht-cell"></div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        $statuses = [
                            0 => ["type" => "default", "text" => "в работе"],
                            1 => ["type" => "success", "text" => "выполнено"],
                            2 => ["type" => "danger", "text" => "провален"],
                        ];

                        foreach ($taskItems["items"] as $item) { ?>
                            <tr data-index="0">
                                <td class="text-right"><? echo $item["ID"] ?></td>
                                <td style=""> <a href="/task/<? echo $item["ID"] ?>"><? echo $item["title"] ?></a></td>
                                <td style=""><? echo date("d.m.Y", $item["date_created"]) ?></td>
                                <td style=""><? echo (!$item["date_deadline"])? "---" : date("d.m.Y", $item["date_deadline"]) ?></td>
                                <td style=""><? echo (!$item["date_finished"])? "---" : date("d.m.Y", $item["date_finished"]) ?></td>


                                <td style=""><span class="label label-<? echo $statuses[$item["status"]]["type"] ?>"><? echo $statuses[$item["status"]]["text"] ?></span></td>


                                <td class="text-center">

                                    <a title="В процессе?" href="/task/change_status/status/no/ID/<? echo $item["ID"] ?>" class="ml5 glyphicon glyphicon-time js-confirm"></a>
                                    <a title="Выполнено?" href="/task/change_status/status/1/ID/<? echo $item["ID"] ?>" class="ml5 glyphicon glyphicon-ok-sign js-confirm"></a>
                                    <a title="Провален?" href="/task/change_status/status/2/ID/<? echo $item["ID"] ?>" class="ml5 glyphicon glyphicon-remove-sign js-confirm"></a>

                                    <span class="ml5 mr5">|</span>


                                    <a href="/task/edit/ID/<? echo $item["ID"] ?>" class="ml5 glyphicon glyphicon-edit"></a>
                                    <a href="/task/delete/ID/<? echo $item["ID"] ?>" class="ml5 glyphicon glyphicon-trash js-confirm"></a>
                                    
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>

                    </table>

                    <? if($taskItems["stack"]) {

                        $paginationUrl   = ($_GET["sort_by"])? $thisUrl."?sort_by=".$_GET["sort_by"]."&p=" : $thisUrl."?p=";
                        $stack           = $taskItems["stack"];

                    ?>
                    <div>
                        <div class="pull-right">
                            <? include "App/views/blocks/pagination.php"; ?>
                        </div>
                    </div>
                    <? } ?>


                </div>


            </div>
        </div>
    </div>

    </div>
    <? endif; ?>


</div>	<!--/.main-->

<!--<script src="/resources/lumino/js/jquery-1.11.1.min.js"></script>
<script src="/resources/lumino/js/bootstrap.min.js"></script>-->
<? require_once "App/views/blocks/scripts.php"; ?>

<script src="/resources/lumino/js/chart.min.js"></script>
<script src="/resources/lumino/js/chart-data.js"></script>
<script src="/resources/lumino/js/easypiechart.js"></script>
<script src="/resources/lumino/js/easypiechart-data.js"></script>
<script src="/resources/lumino/js/bootstrap-datepicker.js"></script>
<script>
    $('#calendar').datepicker({
    });

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