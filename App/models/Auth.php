<?php
namespace App\models;
use App\models;


class Auth
{

    private  $timeToDestroy = "1 month";


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
        if(!$resUser["confirm_email"]){ throw new \Exception("Ожидается подтверждения e-mail"); }

        //2. Авторизуем, если пароль указан верно
        if(!password_verify($pass, $resUser["pass"])){ throw new \Exception("Не верный пароль"); }

        //Авторизуем
        return $this->setAuth($resUser["ID"], $resUser["token"]);

    }


    public function setAuth($user_id, $token)
    {
        if(!$token){ $token = md5(time().rand()); }

        setcookie("user_id", $user_id, strtotime($this->timeToDestroy), "/");
        setcookie("token", $token, strtotime($this->timeToDestroy), "/");

        return $user_id;

    }


    public function register($email, $pass)
    {
        //1. делаем запись в базу
        $arr = [
            "date" => time(),
            "email" => $email,
            "pass" => password_hash($pass, PASSWORD_DEFAULT),
        ];

        $DB = new DB();
        $resInsert = $DB->insert("users", $arr, true);

        //2. отправим письмо



    }

}