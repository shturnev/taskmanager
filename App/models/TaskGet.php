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
            case 2: $res = $this->method_2($array); break; //Вывод by ID
            case 3: $res = $this->method_3($array); break; //Вывод всех "для меня" записей
            case 4: $res = $this->method_4($array); break; //Вывод подсчет задач "для меня" в разных статусах

        endswitch;


        return $res;
    }


    private function method_1($array){

        $limit = (!is_numeric($array["limit"]))? $this->limit : $array["limit"];
        $page  = (!is_numeric($array["p"]))? 0 : $array["p"];
        $me    = $_COOKIE["user_id"];

        $sortes  = ["ID", "date_created", "date_deadline", "date_finished", "status", "title"];
        $sort_by = (!in_array($array["sort_by"], $sortes))? "ID" : $array["sort_by"];


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
        $sql = "SELECT * FROM task WHERE from_user_id = ".$me." ORDER BY ".$sort_by." DESC LIMIT ".$resNav["start"].",".$resNav["limit"];
        $resItems = $this->DB->get_rows($sql, true);

        //response
        $res = ["items" => $resItems, "stack" => $resNav["stack"]];
        return $res;


    }

    private function method_2($array){

        if(!is_numeric($id = $array["ID"])){
            throw new \Exception("Не корректный ID");}
        $me = $_COOKIE["user_id"];

        //сделаем выборку этой записи
        $sql = "SELECT * FROM task WHERE ID = ".$id." AND (from_user_id = ".$me." OR for_user_id = ".$me.")";
        $resItem = $this->DB->get_row($sql);
        if(!$resItem){
            throw new \Exception("Такой записи нет");}

        //Найдем инфо про пользователей
        $P = new Profile();
        $usersInfo = $P->get(["m" => 3, "ID" => [$resItem["from_user_id"], $resItem["for_user_id"]]])["items"];
        if($usersInfo)
        {
            $usersInfo = array_combine(array_column($usersInfo, "ID"), $usersInfo);
        }


        //response
        $res = ["item" => $resItem, "usersInfo" => $usersInfo];
        return $res;


    }

    private function method_3($array){

        $limit = (!is_numeric($array["limit"]))? $this->limit : $array["limit"];
        $page  = (!is_numeric($array["p"]))? 0 : $array["p"];
        $me    = $_COOKIE["user_id"];

        $sortes  = ["ID", "date_created", "date_deadline", "date_finished", "status", "title"];
        $sort_by = (!in_array($array["sort_by"], $sortes))? "ID" : $array["sort_by"];

        $status  = (isset($array["status"]) and is_numeric($array["status"]))? $array["status"]: null;
        if($status > 2){ $status = 2; }
        if(!is_null($status)){ $status = " AND status = ".$status; }

        //проверки

        //узнаем сколько всего у нас таких записей?
        $sql = "SELECT COUNT(*) AS n FROM task WHERE deleted = 0 AND for_user_id = ".$me. $status;
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
        $sql = "SELECT * FROM task WHERE deleted = 0 AND for_user_id = ".$me. $status."  ORDER BY ".$sort_by." DESC LIMIT ".$resNav["start"].",".$resNav["limit"];
        $resItems = $this->DB->get_rows($sql, true);

        //response
        $res = ["items" => $resItems, "stack" => $resNav["stack"]];
        return $res;


    }

    private function method_4($array = null){

        $me = $_COOKIE["user_id"];

        for ($i = 0; $i < 3; $i++):
            $sql[] = "(SELECT COUNT(*) FROM task WHERE deleted = 0 AND for_user_id = ".$me. " AND status = ". $i .") AS status_".$i;
        endfor;

        $sql = "SELECT ".implode(",", $sql);
        $resCount = $this->DB->get_row($sql);

        return $resCount;

    }

}