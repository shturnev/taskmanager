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
        case is_numeric($_GET["method"]):

            $profileInfo = $Profile->get(["m" => 1, "ID" => $_GET["method"]]);
            if(!$profileInfo)
            {
                $error["error_text"] = "Такого пользователя не найдено";
                include "App/views/for_error.php";
                exit;
            }
            else
            {

                $thisUrl   = $Path->withoutGet();
                $pageTitle = "Информация о профиле ".$profileInfo["nickname"];
                include "App/views/profile/profile_show.php";

            }

            break;


    endswitch;
}
else
{
    $profileInfo = $Profile->get(["m" => 1]);
    if(!$profileInfo)
    {
        $error["error_text"] = "Такого пользователя не найдено";
        include "App/views/for_error.php";
        exit;
    }
    else
    {

        $thisUrl   = $Path->withoutGet();
        $pageTitle = "Информация о профиле ".$profileInfo["nickname"];
        include "App/views/profile/profile_show.php";

    }
}

