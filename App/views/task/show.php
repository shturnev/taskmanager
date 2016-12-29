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
            <li class="active"><? echo $pageTitle ?></li>
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
                <div class="panel-heading"><? echo $pageTitle ?></div>
                <div class="panel-body">

                    <dl class="dl-horizontal">

                        <?
                            $statuses = [
                                0 => ["type" => "default", "text" => "в работе"],
                                1 => ["type" => "success", "text" => "выполнено"],
                                2 => ["type" => "danger", "text" => "провален"],
                            ];
                        ?>

                        <dt class="mt5">Статус</dt>
                        <dd class="mt5">
                            <span class="label label-<? echo $statuses[$taskInfo["status"]]["type"] ?>"><? echo $statuses[$taskInfo["status"]]["text"] ?></span>                        </dd>
                        <dt class="mt5">Дата создания</dt>
                        <dd class="mt5">
                            <? echo date("d.m.Y H:i", $taskInfo["date_created"]) ?>
                        </dd>

                        <dt>От кого</dt>
                        <dd>
                            <a href="/profile/<? echo $taskInfo["from_user_id"] ?>">
                                <? echo $usersInfo[$taskInfo["from_user_id"]]["email"]." (".$usersInfo[$taskInfo["from_user_id"]]["nickname"].")" ?>
                            </a>
                        </dd>
                        <dt class="mt5">Для кого</dt>
                        <dd class="mt5">
                            <a href="/profile/<? echo $taskInfo["for_user_id"] ?>">
                                <? echo $usersInfo[$taskInfo["for_user_id"]]["email"]." (".$usersInfo[$taskInfo["for_user_id"]]["nickname"].")" ?>
                            </a>
                        </dd>
                        <dt class="mt5">Дата создания</dt>
                        <dd class="mt5">
                            <? echo date("d.m.Y H:i", $taskInfo["date_created"]) ?>
                        </dd>

                        <? if($taskInfo["date_deadline"]){ ?>
                        <dt class="mt5">Дата deadline</dt>
                        <dd class="mt5">
                            <? echo date("d.m.Y H:i", $taskInfo["date_deadline"]) ?>
                        </dd>
                        <? } ?>

                        <? if($taskInfo["date_finished"]){ ?>
                        <dt class="mt5">Дата finished</dt>
                        <dd class="mt5">
                            <? echo date("d.m.Y H:i", $taskInfo["date_finished"]) ?>
                        </dd>
                        <? } ?>
                    </dl>

                    <hr>

                    <div>
                        <? echo $taskInfo["text"] ?>
                    </div>


                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt35">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">comments</div>
                <div class="panel-body">

                    <div id="disqus_thread"></div>
                    <script>

                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                         var disqus_config = function () {
                         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                         };
                         */
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = '//taskmanager-1.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


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