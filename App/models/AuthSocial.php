<?php
/**
 * Project taskmanager.
 * User: sht-home
 * Date: 30.12.2016
 * Time: 22:15
 */

namespace App\models;
use App\models\mail\libmail;

class AuthSocial
{
    public function __construct()
    {
        $this->DB = new DB();
        $this->Auth = new Auth();
        $this->Profile = new Profile();
    }

    public function enter($array)
    {
        if(!$token = $array["token"]){
            throw new \Exception("Отсутствует токен");}

        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $token .
            '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($s, true);
        if(!$email = strtolower($user["email"])){
            throw new \Exception("Отсутствует email");}

        //проверим есть ли уже такой пользователь в базе
        $sql = "SELECT * FROM users WHERE email = '".$email."' AND confirm_email = 1";
        $resDb = $this->DB->get_row($sql);
        if($resDb){ return $this->Auth->setAuth($resDb["ID"], $resDb["token"]); }

        //Запишем в базу
        $pass   = $this->generate_password(6);
        $token  = $this->Auth->newToken();
        $avatar = ($user['photo_big'])? $this->Profile->upload_photo($user['photo_big']) : null;

        $arr = [
            "date"      => time(),
            "email"     => $email,
            "pass"      => password_hash($pass, PASSWORD_DEFAULT),
            "confirm_email" => 1,
            "token"     => $token,
            "nickname"  => $user['last_name']. " ".$user['first_name'],
            "avatar"    => $avatar,
        ];

        $user_id = $this->DB->duplicate_update("users", $arr, true);
        $this->Auth->setAuth($user_id, $token);

        //отправим письмо
        $PATH = new Path();
        $body = file_get_contents("App/views/mail/register_by_social.php");
        $body = str_replace(["{{clear_url}}", "{{email}}", "{{pass}}"], [$PATH->clear_url(), $email, $pass], $body);

        //3. отправим письмо
        $M = new libmail("utf-8");
        $M->To($email);
        $M->Subject("Спасибо, что присоединились к нам");
        $M->log_on(true);
        $M->Body($body, "html");
        $M->Send();

        if(!$M->status_mail["status"])
        {
            throw new \Exception($M->status_mail["message"]);
        }

    }


    public function generate_password($number)
    {

        $arr = array('a','b','c','d','e','f',

            'g','h','i','j','k','l',

            'm','n','o','p','r','s',

            't','u','v','x','y','z',

            'A','B','C','D','E','F',

            'G','H','I','J','K','L',

            'M','N','O','P','R','S',

            'T','U','V','X','Y','Z',

            '1','2','3','4','5','6',

            '7','8','9','0');

        // Генерируем пароль

        $pass = "";

        for($i = 0; $i < $number; $i++)
        {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }

        return $pass;
    }


}