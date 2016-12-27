<?php
if(!$Auth->check_auth()){ header("Location: /"); exit;}

/*-----------------------------------
Global
-----------------------------------*/
$Invite     = new \App\models\Invite();
$referer    = ($_POST["referer"])? $_POST["referer"] : $_SERVER["HTTP_REFERER"];


/*-----------------------------------
POST
-----------------------------------*/
if($_POST["method_name"])
{
    switch ($_POST["method_name"]):
        case "create":


            try{
                $resInv = $Invite->create($_POST);
//                header("Location: ".$referer);

            }
            catch(Exception $e)
            {
                $error      = ["error_text" => $e->getMessage()];
                $inputs_val = $_POST;
//                include "App/views/task/create.php";
//                exit;
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
        case "delete":

            try{
                $Invite->delete($_GET["ID"]);
                header("Location: ".$referer);
            }
            catch (Exception $e)
            {
                $error  = ["error_text" => $e->getMessage()];

                $resInv    = $Invite->get(["m" => 1, "limit" => 30, "p" => $_GET["p"]]);
                $thisUrl   = $Path->withoutGet();
                $pageTitle = "Приглашения";
                include "App/views/invite/my.php";
            }

        break;

    endswitch;
}
else
{
    $resInv    = $Invite->get(["m" => 1, "limit" => 30, "p" => $_GET["p"]]);
    $thisUrl   = $Path->withoutGet();
    $pageTitle = "Приглашения";
    include "App/views/invite/my.php";
}

