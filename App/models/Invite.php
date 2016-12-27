<?php
/**
 * Project taskmanager.
 * User: sht-home
 * Date: 26.12.2016
 * Time: 21:26
 */

namespace App\models;
use App\models\mail\libmail;

class Invite
{

    public function __construct()
    {
        $this->DB = new DB();
    }

    public function get($array)
    {
        $O = new InviteGet();
        return $O->get($array);
    }

    public function create($array)
    {
        $email = TextSecurity::is_email($array["email"]);
        if(!$email){
            throw new \Exception("Не корректный параметр - email");}

        $me = $_COOKIE["user_id"];

        //собирем инфо про owner
        $P = new Profile();
        $ownerInfo = $P->get(["m" =>1]);

        //Собирем инфо про user with email
        $sql = "SELECT ID FROM users WHERE email = '".$email."'";
        $userInfo = $this->DB->get_row($sql);


        //проверим есть ли уже у них connect
        $sql = "SELECT * FROM invites WHERE (from_user_id = ".$me." AND for_email = '".$email."')";
        if($userInfo)
        {
            $sql .= " OR (from_user_id = ".$userInfo["ID"]." AND for_email = '".$ownerInfo["email"]."')";
        }

        $resItem = $this->DB->get_row($sql);
        if($resItem){
            throw new \Exception("Приглашение не требуется");}


        //создадим приглашение
        $arr = [
            "date"          => time(),
            "for_email"     => $email,
            "from_user_id"  => $me,
        ];
        $this->DB->insert("invites", $arr, true);


        //Отправим письмо
        $PATH = new Path();
        $viewUrl = ($userInfo)? "App/views/mail/invite1.php" : "App/views/mail/invite2.php";
        $body = file_get_contents($viewUrl);
        $body = str_replace(["{{owner_nickname}}", "{{clear_url}}"], [$ownerInfo["nickname"], $PATH->clear_url()], $body);


        $M = new libmail("utf-8");
        $M->To($email);
        $M->Subject("Приглашение");
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

    public function delete($id)
    {
        if(!is_numeric($id)){
            throw new \Exception("Не корректный id");}

        $me = $_COOKIE["user_id"];

        //сделаем выборку этой записи
        $sql = "SELECT * FROM invites WHERE ID = ".$id;
        $resItem = $this->DB->get_row($sql);
        if(!$resItem){
            throw new \Exception("Такой записи нет");}

        //ифно про пользвоателя
        $sql = "SELECT * FROM users WHERE ID = ".$me;
        $resUser = $this->DB->get_row($sql);

        //есть ли право на delete
        if($resItem["from_user_id"] != $me and $resItem["for_email"] != $resUser["email"]){
            throw new \Exception("Не достаточно прав");
        }

        if($resItem["from_user_id"] != $me){
            $this->DB->update("invites", ["delete_2" => 1], "ID = ".$id, true);
            return true;
        }

        if($resItem["delete_2"]){
            $this->DB->delete("invites", "ID = ".$id, true);
            return true;
        }
        else{
            $this->DB->update("invites", ["delete_1" => 1], "ID = ".$id, true);
            return true;
        }
    }

    public function change_status($array)
    {
        if(!is_numeric($status = $array["status"]) or !is_numeric($id = $array["ID"]))
        {
            throw new \Exception("Не корректные параметры id или status");
        }

        if($status > 2){ $status = 2; }
        $me = $_COOKIE["user_id"];

        //сделаем выборку этой записи
        $sql = "SELECT * FROM invites WHERE ID = ".$id;
        $resItem = $this->DB->get_row($sql);
        if(!$resItem){
            throw new \Exception("Такой записи нет");}

        //ифно про пользвоателя
        $sql = "SELECT * FROM users WHERE ID = ".$me;
        $resUser = $this->DB->get_row($sql);

        //есть ли право на delete
        if($resItem["from_user_id"] != $me and $resItem["for_email"] != $resUser["email"]){
            throw new \Exception("Не достаточно прав");
        }

        $this->DB->update("invites", ["status" => $status], "ID = ".$id, true);
        return true;

    }

}