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



    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Basic Table</div>
                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="fixed-table-toolbar"></div>
                        <div class="fixed-table-container">
                            <div class="fixed-table-header"><table></table></div>
                            <div class="fixed-table-body">
                                <div class="fixed-table-loading" style="top: 37px; display: none;">Loading, please wait…</div>
                                <table data-toggle="table" class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-right">
                                            <div class="th-inner ">Item ID</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner ">Item Name</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner ">Item Price</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr data-index="0">
                                        <td style="text-align: right; ">0</td>
                                        <td style="">Item 0</td>
                                        <td style="">$0</td>
                                    </tr>
                                    <tr data-index="1">
                                        <td style="text-align: right; ">1</td>
                                        <td style="">Item 1</td>
                                        <td style="">$1</td></tr>
                                    <tr data-index="2">
                                        <td style="text-align: right; ">2</td>
                                        <td style="">Item 2</td>
                                        <td style="">$2</td>
                                    </tr>
                                    <tr data-index="3">
                                        <td style="text-align: right; ">3</td>
                                        <td style="">Item 3</td>
                                        <td style="">$3</td>
                                    </tr>
                                    <tr data-index="4">
                                        <td style="text-align: right; ">4</td>
                                        <td style="">Item 4</td>
                                        <td style="">$4</td>
                                    </tr>
                                    <tr data-index="5">
                                        <td style="text-align: right; ">5</td>
                                        <td style="">Item 5</td>
                                        <td style="">$5</td>
                                    </tr>
                                    <tr data-index="6">
                                        <td style="text-align: right; ">6</td>
                                        <td style="">Item 6</td>
                                        <td style="">$6</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="fixed-table-pagination">

                            </div>
                        </div>

                        <div class="fixed-table-pagination">
                            <div class="pull-right pagination">
                                <ul class="pagination">
                                    <li class="page-first disabled"><a href="javascript:void(0)">&lt;&lt;</a></li>
                                    <li class="page-pre disabled"><a href="javascript:void(0)">&lt;</a></li>
                                    <li class="page-number active disabled"><a href="javascript:void(0)">1</a></li>
                                    <li class="page-number"><a href="javascript:void(0)">2</a></li>
                                    <li class="page-number"><a href="javascript:void(0)">3</a></li>
                                    <li class="page-next"><a href="javascript:void(0)">&gt;</a></li>
                                    <li class="page-last"><a href="javascript:void(0)">&gt;&gt;</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>


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