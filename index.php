<?php
require_once("vendor/autoload.php");

$DB = new App\models\DB();

try{

//    $resInsert = $DB->update("forTest", ["title" => "бла бла", "date" => time()], "ID = 2");
//    $resInsert = $DB->insert("forTest", ["title" => "бла бла 2", "date" => time()]);
//    $resInsert = $DB->get_row("SELECT * FROM forTest");
    $resInsert = $DB->get_rows("SELECT * FROM forTest");

    $ggg = 1;


//    $DB->connect();
}
catch (Exception $e)
{
    echo $e->getMessage();
}