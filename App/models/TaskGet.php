<?php
namespace App\models;

use App\models\DB;
use App\models\Counter;

class TaskGet
{

    private $limit = 30;
    private $DB;


    public function __construct()
    {
        $this->DB = new DB();
    }

    public function get($array)
    {
        switch ($array["m"]):
            case 1: $res = $this->method_1($array); break; //Вывод всех "моих" записей

        endswitch;


        return $res;
    }


    private function method_1($array){

        $limit = (!is_numeric($array["limit"]))? $this->limit : $array["limit"];
        $page  = (!is_numeric($array["p"]))? 0 : $array["p"];
        $me    = $_COOKIE["user_id"];


        //проверки

        //узнаем сколько всего у нас таких записей?
        $sql = "SELECT COUNT(*) AS n FROM task WHERE from_user_id = ".$me;
        $resCount = $this->DB->get_row($sql)["n"];
        if(!$resCount){ return false; }

        //Counter
        $arr = [
            "limit" => $limit,
            "page" => $page,
            "posts" => $resCount,
            "max_pages" => 3,
        ];

        $resNav = Counter::get_nav($arr);

        //Делаем быборку записей
        $sql = "SELECT * FROM task WHERE from_user_id = ".$me." LIMIT ".$resNav["start"].",".$resNav["limit"];
        $resItems = $this->DB->get_rows($sql, true);

        //response
        $res = ["items" => $resItems, "stack" => $resNav["stack"]];
        return $res;


    }
}