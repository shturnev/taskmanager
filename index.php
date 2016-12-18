<?php
require_once("vendor/autoload.php");

$DB = new App\models\DB();

try{

    $resInsert = $DB->insert("forTest", ["title" => "Привет. привет", "date" => time()]);

//    $DB->connect();
}
catch (Exception $e)
{
    echo $e->getMessage();
}