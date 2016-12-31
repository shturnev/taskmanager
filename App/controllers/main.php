<?php

if(!$Auth->check_auth())
{
    $pageTitle      = "Welcome";
    include "App/views/welcome.php";
}
else
{
    $Task    = new \App\models\Task();
    $Profile = new \App\models\Profile();

    $sideBar_page   = ["lvl1" => "dashboard"];
    $myTeam         = $Profile->get(["m" => 4]);
    $resTasks       = $Task->get(["m" => 3, "limit" => 20, "status" => 0]);
    $pageTitle      = "Dashboard";

    include "App/views/main.php";

}

