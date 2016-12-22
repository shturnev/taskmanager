<?php

if(!$Auth->check_auth())
{
    include "App/views/tamplate.php";
}
else
{
    $pageTitle = "Задачи";
    include "App/views/task.php";

}

