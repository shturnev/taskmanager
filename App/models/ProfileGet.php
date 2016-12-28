<?php
namespace App\models;

use App\models\DB;
use App\models\Counter;

class ProfileGet
{

    private $limit = 30;
    private $DB;
    private $no_photo = "/resources/img/nobody.png";

    public function __construct()
    {
        $this->DB = new DB();
    }

    public function get($array)
    {
        switch ($array["m"]):
            case 1: $res = $this->method_1($array); break; //Вывод by ID
            case 2: $res = $this->method_2($array); break; //Вывод by email array
            case 3: $res = $this->method_3($array); break; //Вывод by ID array
            case 4: $res = $this->method_4($array); break; //Вывод пользователей в команде

        endswitch;

        return $res;
    }


    private function method_1($array){

        $ID = (is_numeric($array["ID"]))? $array["ID"] : $_COOKIE["user_id"];

        //Сделаем выборку из БД
        $resItem = $this->DB->get_row("SELECT * FROM users WHERE ID = ".$ID);
        if(!$resItem){ return false; }


        //--
        if(!$resItem["nickname"]){ $resItem["nickname"] = explode("@", $resItem["email"])[0]; }
        $resItem["avatar_big_url"] = (!$resItem["avatar"])? $this->no_photo : "/resources/FILES/big/".$resItem["avatar"];
        $resItem["avatar_small_url"] = (!$resItem["avatar"])? $this->no_photo : "/resources/FILES/small/".$resItem["avatar"];


        return $resItem;

    }




    private function method_2($array){

        if(!$email = array_filter($array["email"], function($item){ return TextSecurity::is_email($item); })){ return false; }

        //делаем выборку из бд
        $sql = "SELECT ID,email,nickname FROM users WHERE email IN ('".implode("','", $email)."')";
        $resItems = $this->DB->get_rows($sql);
        if(!$resItems){ return false; }

        foreach ($resItems as $index => $resItem) {
            if(!$resItem["nickname"]){ $resItems[$index]["nickname"] = explode("@", $resItem["email"])[0]; }
        }

        return ["items" => $resItems];

    }

    private function method_3($array){

        if(!$IDs = array_filter($array["ID"], function($item){ return is_numeric($item); })){ return false; }

        //делаем выборку из бд
        $sql = "SELECT ID,email,nickname FROM users WHERE ID IN (".implode(",", $IDs).")";
        $resItems = $this->DB->get_rows($sql);
        if(!$resItems){ return false; }

        foreach ($resItems as $index => $resItem) {
            if(!$resItem["nickname"]){ $resItems[$index]["nickname"] = explode("@", $resItem["email"])[0]; }
        }

        return ["items" => $resItems];

    }


    private function method_4($array = null){

        $me = $_COOKIE["user_id"];
        $sql = "SELECT ID, email FROM users WHERE ID=".$me;
        $resMe = $this->DB->get_row($sql);

        //Соберем записи из invites
        $sql = "SELECT for_email, from_user_id FROM invites WHERE status = 1 AND (from_user_id = ".$me." OR for_email = '".$resMe["email"]."')";
        $resInv = $this->DB->get_rows($sql);
        if(!$resInv){ return false; }


        //разделим
        $IDs = array_unique(array_column($resInv, "from_user_id", "from_user_id"));
        $emails = array_unique(array_column($resInv, "for_email", "for_email"));
        unset($IDs[$me], $emails[$resMe["email"]]);

        if(!$IDs and !$emails){ return false; }

        //делаем выборку users
        $sql = "SELECT * FROM users WHERE ";
        $sql1 = ($IDs)? "ID IN (".implode(",",$IDs).")" : null;
        $sql2 = ($emails)? "emails IN ('".implode("','",$emails)."'')" : null;
        if($sql1 && $sql2){ $sql1 .= " OR "; }

        $resItems = $this->DB->get_rows($sql.$sql1.$sql2);
        if(!$resItems){return false;}

        foreach ($resItems as $index => $resItem) {
            if(!$resItem["nickname"]){ $resItems[$index]["nickname"] = explode("@", $resItem["email"])[0]; }
        }

        return ["items" => $resItems];

    }
}