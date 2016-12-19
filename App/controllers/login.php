<?php

/*-----------------------------------
В случае если была передана форма
-----------------------------------*/
if($_POST["method_name"] == "enter")
{
    $Auth = new App\models\Auth();
    $resAuth = $Auth->enter($_POST);
}

include "App/views/login.php";