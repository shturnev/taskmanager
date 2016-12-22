<?php
namespace App\models;
use App\models\TextSecurity;
use App\models\DB;

class Task
{

    public function create($array)
    {
        $title          = $array["title"];
        $from_user_id   = $_COOKIE["user_id"];
        $for_user_id    = $array["for_user_id"];
        $date_deadline  = (!$array["date_deadline"])? 0 : strtotime($array["date_deadline"]);
        $text           = TextSecurity::shield_medium($array["text"]);


        //проверки
        if(!$title){ throw new \Exception("Заголовок не может быть пустым");}
        if(!is_numeric($for_user_id)){ $for_user_id = $from_user_id; }

        //Пишем в базу
        $arr = [
            "from_user_id"  => $from_user_id,
            "for_user_id"   => $for_user_id,
            "date_created"  => time(),
            "date_deadline" => $date_deadline,
            "title"         => $title,
            "text"          => $text,
        ];

        $DB = new DB();

        return $DB->insert("task", $arr, true);

    }
}