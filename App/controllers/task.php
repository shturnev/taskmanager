<?php
if(!$Auth->check_auth()){ header("Location: /"); exit;}

/*-----------------------------------
Global
-----------------------------------*/
$Task       = new \App\models\Task();
$Profile    = new \App\models\Profile();
$referer    = ($_POST["referer"])? $_POST["referer"] : $_SERVER["HTTP_REFERER"];


/*-----------------------------------
POST
-----------------------------------*/
if($_POST["method_name"])
{
    switch ($_POST["method_name"]):
        case "create":


            try{

                $resTask = $Task->create($_POST);
                header("Location: ".$referer);
            }
            catch(Exception $e)
            {
                $error      = ["error_text" => $e->getMessage()];
                $resTeam    = $Profile->get(["m" => 4]);
                $inputs_val = $_POST;
                include "App/views/task/create.php";
                exit;
            }

        break;
        case "edit":


            try{
                $resTask = $Task->edit($_POST);
                header("Location: ".$referer);
            }
            catch(Exception $e)
            {
                $error      = ["error_text" => $e->getMessage()];
                $resTeam    = $Profile->get(["m" => 4]);
                $inputs_val = $_POST;
                include "App/views/task/create.php";
                exit;
            }

        break;

    endswitch;
}


/*-----------------------------------
GET
-----------------------------------*/
if($_GET["method"])
{
    switch ($_GET["method"]):
        case "create":
            $resTeam   = $Profile->get(["m" => 4]);
            $pageTitle = "Добавить задачу";
            include "App/views/task/create.php";

        break;
        case "edit":
            $resTeam        = $Profile->get(["m" => 4]);
            $resItem        = $Task->get(["m" => 2, "ID" => $_GET["ID"]]);
            $inputs_val     = $resItem["item"];
            $pageTitle = "Добавить задачу";
            include "App/views/task/edit.php";

        break;
        case "change_status":

            try{
                $Task->change_status($_GET);
                header("Location: ".$referer);
            }
            catch (Exception $e)
            {
                $error  = ["error_text" => $e->getMessage()];
                include "App/views/for_error.php";
            }

            break;
        case "delete":

            try{
                $Task->delete($_GET["ID"]);
                header("Location: ".$referer);
            }
            catch (Exception $e)
            {
                $error  = ["error_text" => $e->getMessage()];
                include "App/views/for_error.php";
            }

            break;


    endswitch;
}
else
{
    $taskItems = $Task->get(["m" => 1, "limit" => 30, "p" => $_GET["p"]]);
    $thisUrl   = $Path->withoutGet();
    $pageTitle = "Задачи";
    include "App/views/task/task.php";
}

