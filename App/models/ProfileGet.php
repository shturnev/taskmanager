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
}