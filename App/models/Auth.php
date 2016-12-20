<?php
namespace App\models;
use App\models;
use App\models\mail\libmail;

class Auth
{

    private  $timeToDestroy = "1 month";

    /**
     * Общий метод регистрации и авторизации
     * @param $array
     * @return array
     * @throws \Exception
     */
    public function enter($array)
    {
        $email = strtolower(trim($_POST["email"]));
        $pass  = $_POST["pass"];

        if(!$email || !$pass){ throw new \Exception("E-mail и пароль должны быть заполнены"); }
        if(!TextSecurity::is_email($email)){ throw new \Exception("Не коректный e-mail"); }

        //проверим есть ли такой пользователь в БД
        $DB = new DB();
        $resUser = $DB->get_row("SELECT * FROM users WHERE email = '".$email."'", true);
        if(!$resUser)
        {
            return $this->register($email, $pass);
        }

        //Сверим данные
        //1. подтвердил ли пользователь свой email?
        if(!$resUser["confirm_email"]){ throw new \Exception("Ожидается подтверждение регистрации"); }

        //2. Авторизуем, если пароль указан верно
        if(!password_verify($pass, $resUser["pass"])){ throw new \Exception("Не верный пароль"); }

        //Авторизуем
        return $this->setAuth($resUser["ID"], $resUser["token"]);

    }


    /**
     * Проверка авторизован ли пользователь
     * @return bool
     * @throws \Exception
     */
    public function check_auth()
    {
        if(!is_numeric($_COOKIE["user_id"]) || !$_COOKIE["token"]){ return false; }

        $token = TextSecurity::shield_hard($_COOKIE["token"]);

        $DB = new DB();
        $resDb = $DB->get_row("SELECT * FROM users WHERE ID = ".$_COOKIE["user_id"]." AND token ='".$token."'");

        if(!$resDb){ return false; }

        return $resDb["ID"];
    }

    /**
     * Де-авторизация
     */
    public function logout()
    {
        setcookie("user_id", '', strtotime("-1 day"), "/");
        setcookie("token", '', strtotime("-1 day"), "/");
    }


    /**
     * Создаёт куки для авторизованного пользователя
     * @param $user_id
     * @param $token
     * @return array
     */
    public function setAuth($user_id, $token)
    {
        if(!$token){ $token = $this->newToken(); }

        setcookie("user_id", $user_id, strtotime($this->timeToDestroy), "/");
        setcookie("token", $token, strtotime($this->timeToDestroy), "/");


        $res = ["type" => "auth", "status" => true, "data" => ["user_id" => $user_id]];

        return $res;

    }

    /**
     * Метод регистрации
     * @param $email
     * @param $pass
     * @return array
     * @throws \Exception
     */
    public function register($email, $pass)
    {
        //1. делаем запись в базу
        $arr = [
            "date"  => time(),
            "email" => $email,
            "pass"  => password_hash($pass, PASSWORD_DEFAULT),
            "token" => $this->newToken(),
        ];

        $DB = new DB();
        $resInsert = $DB->insert("users", $arr, true);


        //2. Соберем инфо
        $PATH = new Path();
        $body = file_get_contents("App/views/mail/confirm_email.php");
        $body = str_replace(["{{clear_url}}", "{{token}}"], [$PATH->clear_url()."/", $arr["token"]], $body);

        //3. отправим письмо
        $M = new libmail("utf-8");
        $M->To($email);
        $M->Subject("Подтверждение регистрации");
        $M->log_on(true);
        $M->Body($body, "html");
        $M->Send();

        if(!$M->status_mail["status"])
        {
            throw new \Exception($M->status_mail["message"]);
        }

        $res = ["type" => "register", "status" => true];

        return $res;

    }

    /**
     * Подтвердить email
     * @param $token
     * @return array
     * @throws \Exception
     */
    public function confirm_email($token)
    {
        if(!$token){
            throw new \Exception("Не верный параметр - token"); }

        $token = TextSecurity::shield_hard($token);

        $DB = new DB();
        $resDb = $DB->get_row("SELECT * FROM users WHERE token = '".$token."'");
        if(!$resDb){
            throw new \Exception("Такой token не найден");}

        //2
        if($resDb["confirm_email"] == 1){
            throw new \Exception("Этот token уже был использован");}

        //3
        $arr = [
            "token" => $this->newToken(),
            "confirm_email" => 1
        ];

        $resUpd = $DB->update("users", $arr, "ID = ".$resDb["ID"]);

        //4
        return $this->setAuth($resDb["ID"], $arr["token"]);


    }




    private function newToken()
    {
        return md5(time().rand());
    }


}