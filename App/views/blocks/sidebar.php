<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="active"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li class="parent ">
            <a href="#sub-item-1" data-toggle="collapse">
                <span><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg></span> Задачи
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="" href="/task">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>
                        Мои
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>
                        Для меня
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="#sub-item-2" data-toggle="collapse">
                <span><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg></span>
                Приглашения

                <? if($Badges["new_invites"]){ ?><span class="badge bg-warning"><? echo $Badges["new_invites"] ?></span><? } ?>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li>
                    <a class="" href="/invite">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>
                        Мои
                    </a>
                </li>
                <li>
                    <a class="" href="/invite/for_me">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>
                        Для меня

                        <? if($Badges["new_invites"]){ ?><span class="badge bg-warning"><? echo $Badges["new_invites"] ?></span><? } ?>

                    </a>
                </li>
            </ul>
        </li>


<!--        <li><a href="widgets.html"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Widgets</a></li>-->
<!--        <li><a href="charts.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>-->
<!--        <li><a href="tables.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>-->
<!--        <li><a href="forms.html"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Forms</a></li>-->
<!--        <li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>-->
<!--        <li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>-->
<!--        <li role="presentation" class="divider"></li>-->
<!--        <li><a href="login.html"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>-->
    </ul>

</div><!--/.sidebar-->
