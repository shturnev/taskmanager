<?php
if(!$Auth->check_auth()){ header("Location: /"); exit;}

/*-----------------------------------
Global
-----------------------------------*/
$Profile    = new \App\models\Profile();
$referer    = ($_POST["referer"])? $_POST["referer"] : $_SERVER["HTTP_REFERER"];


/*-----------------------------------
POST
-----------------------------------*/
if($_POST["method_name"])
{
    switch ($_POST["method_name"]):
        case "edit_profile_info":


            try{
                $resTask = $Profile->edit($_POST);
                header("Location: ".$referer);

            }
            catch(Exception $e)
            {
                $error      = ["error_text" => $e->getMessage()];
                $inputs_val = $_POST;
                include "App/views/profile/profile_settings.php";
                exit;
            }

        break;
        case "edit_pass":


            try{
                $resTask = $Auth->change_password($_POST);
                header("Location: ".$referer);
            }
            catch(Exception $e)
            {
                $error      = ["error_text" => $e->getMessage()];
                $inputs_val = $_POST;
                include "App/views/profile/profile_settings.php";
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
        case "settings":

            $profileInfo = $Profile->get(["m" => 1]);

            $thisUrl   = $Path->withoutGet();
            $pageTitle = "Настройки профиля";
            include "App/views/profile/profile_settings.php";

        break;
        case "change_token":

            $Auth->changeToken();
            header("Location: ".$referer);

        break;
        case "delete":

            $Profile->delete();
            $Auth->logout();
            header("Location: /");

        break;

    endswitch;
}
else
{
    $thisUrl   = $Path->withoutGet();
    $pageTitle = "Настройки профиля";
    include "App/views/profile/profile_settings.php";
}

