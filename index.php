<?php
require_once("vendor/autoload.php");

if($_GET["c"]) //c - сокращенно от controller
{
    include("App/controllers/".$_GET["c"].".php");
}
else{

//    include("App/views/tamplate.php");
    include("App/controllers/main.php");


}