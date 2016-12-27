<?php
namespace App\models;

use App\models\DB;
use App\models\Counter;

class InviteGet
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
//            case 1: $res = $this->method_1($array); break; //Вывод всех "моих" записей

        endswitch;


        return $res;
    }


    private function method_1($array){

        $limit = (!is_numeric($array["limit"]))? $this->limit : $array["limit"];
        $page  = (!is_numeric($array["p"]))? 0 : $array["p"];
        $me    = $_COOKIE["user_id"];

        //проверки

        //узнаем сколько всего у нас таких записей?
        $sql = "SELECT COUNT(*) AS n FROM invites WHERE delete_1 != 1 AND from_user_id = ".$me;
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
        $sql = "SELECT * FROM invites WHERE delete_1 != 1 AND from_user_id = ".$me." LIMIT ".$resNav["start"].",".$resNav["limit"];
        $resItems = $this->DB->get_rows($sql, true);


        //Соберём инфо про пользователей по email
        $P = new Profile();
        $usersInfo = $P->get(["m" => 2, "email" => array_column($resItems, "for_email")])["items"];
        if($usersInfo)
        {
            $usersInfo = array_combine(array_column($usersInfo, "email"), $usersInfo);
        }


        //response
        $res = ["items" => $resItems, "users_info" => $usersInfo, "stack" => $resNav["stack"]];
        return $res;


    }
}