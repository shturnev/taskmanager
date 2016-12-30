<?php

/*-----------------------------------
Авторизация через соц сети
-----------------------------------*/
if($_GET["method"] == "social" and $_POST["token"])
{
    try{
        $AuthSocial = new \App\models\AuthSocial();
        $AuthSocial->enter($_POST);
        header("Location: /");
    }
    catch(Exception $e)
    {
        $error  = ["error_text" => $e->getMessage()];
        include "App/views/for_error.php";
    }
}




/*-----------------------------------
Task
-----------------------------------*/
if($_POST["method_name"] == "getTaskCount_forMe")
{
    $Task = new \App\models\Task();
    try{
        $res  = $Task->get(["m" => 4]);
        echo json_encode(["response" => $res]);
        exit();
    }
    catch(Exception $e)
    {
        echo json_encode(["error" => $e->getMessage()]);
        exit();
    }

}

