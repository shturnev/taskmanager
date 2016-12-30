<?php

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

