
<nav>
    <ul class="pagination" style="margin-top: 0;">

        <? if($stack["first"]){ ?><li><a href="<? echo $paginationUrl.$stack["first"] ?>"><span>&laquo;</span></a></li><? } ?>

        <? if($stack["left"]){
            foreach ($stack["left"] as $p_item) { ?>
                <li><a href="<? echo $paginationUrl.$p_item ?>"><? echo $p_item ?></a></li>
        <? }} ?>

        <li class="active"><span><? echo $stack["center"] ?></span></li>

        <? if($stack["right"]){
            foreach ($stack["right"] as $p_item) { ?>
                <li><a href="<? echo $paginationUrl.$p_item ?>"><? echo $p_item ?></a></li>
        <? }} ?>

        <? if($stack["last"] != $stack["center"]){ ?><li><a href="<? echo $paginationUrl.$stack["last"] ?>"><span>&raquo;</span></a></li><? } ?>


    </ul>
</nav>
