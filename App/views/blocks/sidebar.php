<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">

        <?
        if($sideBar_page["lvl1"] == "dashboard"){
            $parent_active = "active";
            $in = ($sideBar_page["lvl2"])? "in" : null;
        }
        else
        {
            $parent_active = null;
            $in = null;
        }
        ?>
        <li class="<? echo $parent_active ?>"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>

        <?
           if($sideBar_page["lvl1"] == "task"){
               $parent_active = "active";
               $in = ($sideBar_page["lvl2"])? "in" : null;
           }
           else
           {
               $parent_active = null;
               $in = null;
           }
        ?>

        <li class="parent <? echo $parent_active ?>">
            <a href="#sub-item-1" data-toggle="collapse">
                <span><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg></span> Задачи
                <? if($Badges["new_tasks"]){ ?><span class="badge bg-warning"><? echo $Badges["new_tasks"] ?></span><? } ?>

            </a>
            <ul class="children collapse <? echo $in ?>" id="sub-item-1">

                <li>
                    <? $children_active = ($in && $sideBar_page["lvl2"] == "my")? "active" : null; ?>
                    <a class="<? echo $children_active ?>" href="/task">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>
                        Мои
                    </a>
                </li>
                <li>
                    <? $children_active = ($in && $sideBar_page["lvl2"] == "for_me")? "active" : null; ?>
                    <a class="<? echo $children_active ?>" href="/task/for_me">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>
                        Для меня
                        <? if($Badges["new_tasks"]){ ?><span class="badge bg-warning"><? echo $Badges["new_tasks"] ?></span><? } ?>
                    </a>
                </li>
            </ul>
        </li>



        <?
        if($sideBar_page["lvl1"] == "invite"){
            $parent_active = "active";
            $in = ($sideBar_page["lvl2"])? "in" : null;
        }
        else
        {
            $parent_active = null;
            $in = null;
        }
        ?>
        <li class="parent <? echo $parent_active ?>">
            <a href="#sub-item-2" data-toggle="collapse">
                <span><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg></span>
                Приглашения

                <? if($Badges["new_invites"]){ ?><span class="badge bg-warning"><? echo $Badges["new_invites"] ?></span><? } ?>
            </a>
            <ul class="children collapse <? echo $in ?>" id="sub-item-2">
                <li>
                    <? $children_active = ($in && $sideBar_page["lvl2"] == "my")? "active" : null; ?>
                    <a class="<? echo $children_active ?>" href="/invite">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>
                        Мои
                    </a>
                </li>
                <li>
                    <? $children_active = ($in && $sideBar_page["lvl2"] == "for_me")? "active" : null; ?>
                    <a class="<? echo $children_active ?>" href="/invite/for_me">
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
