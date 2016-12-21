<?php
require_once("vendor/autoload.php");
$Auth = new \App\models\Auth();
$Path = new \App\models\Path();

$Path->parse();


if($_GET["c"] && file_exists("App/controllers/".$_GET["c"].".php")) //c - сокращенно от controller
{
    include("App/controllers/".$_GET["c"].".php");
}
else{

//    include("App/views/tamplate.php");
    include("App/controllers/main.php");
}