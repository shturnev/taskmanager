<?php
namespace App\models;
use App\models\mail\libmail;

class Task
{

    public function __construct()
    {
        $this->DB = new DB();
    }


    public function get($array)
    {
        $O = new TaskGet();
        return $O->get($array);
    }

    public function create($array)
    {
        $title          = TextSecurity::shield_hard($array["title"]);
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


    public function change_status($array)
    {
        if(!is_numeric($id = $array["ID"])){
            throw new \Exception("Не корректный ID");}

        $status = (!is_numeric($array["status"]))? 0 : $array["status"];
        if($status > 2){ $status = 2; }
        $me = $_COOKIE["user_id"];

        //сделаем выборку этой записи
        $sql = "SELECT * FROM task WHERE ID = ".$id." AND (from_user_id = ".$me." OR for_user_id = ".$me.")";
        $resItem = $this->DB->get_row($sql);
        if(!$resItem){
            throw new \Exception("Такой записи нет");}

        $time = ($status)? time() : 0;
        $this->DB->update("task", ["status" => $status, "date_finished" => $time], "ID = ".$id, true);

        if($resItem["from_user_id"] == $resItem["for_user_id"]){ return true; }

        //отправим письмо с уведомлением
        $oponentId = ($resItem["from_user_id"] != $me)? $resItem["from_user_id"] : $resItem["for_user_id"];
        $P = new Profile();
        $oponentInfo = $P->get(["m" => 1, "ID" => $oponentId]);

        $statuses = [
            0 => ["type" => "default", "text" => "в работе"],
            1 => ["type" => "success", "text" => "выполнено"],
            2 => ["type" => "danger", "text" => "провален"],
        ];

        $PATH = new Path();
        $body = file_get_contents("App/views/mail/change_task_status.php");
        $body = str_replace(["{{id}}", "{{clear_url}}", "{{title}}", "{{status}}"],
                            [$id, $PATH->clear_url(), $resItem["title"], $statuses[$status]["text"]], $body);


        $M = new libmail("utf-8");
        $M->To($oponentInfo["email"]);
        $M->Subject("Сменился статус задачи");
        $M->log_on(true);
        $M->Body($body, "html");
        $M->Send();

        if(!$M->status_mail["status"])
        {
            throw new \Exception($M->status_mail["message"]);
        }


        //response
        return true;


    }
}