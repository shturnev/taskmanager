<?php
/**
 * Project taskmanager.
 * User: sht-home
 * Date: 25.12.2016
 * Time: 0:05
 */

namespace App\models;

use App\models\DB;
use App\models\TextSecurity;
use App\models\Path;
use abeautifulsite\SimpleImage;
use App\models\ProfileGet;

class Profile
{
    private $DB;
    private $avatarPath;

    public function __construct()
    {
        $this->DB = new DB();
        $this->Path = new Path();
        $this->avatarPath = $this->Path->clear_path()."/resources/FILES";

    }

    public function get($array)
    {
        $O = new ProfileGet();
        return $O->get($array);
    }

    public function edit($array)
    {
        $nickname   = TextSecurity::shield_hard($array["nickname"]);
        $text       = TextSecurity::shield_medium($array["text"]);
        $inputName  = (!$array["input_name"])? "avatar" : $array["input_name"];
        $me         = $_COOKIE["user_id"];

        //cобирем инфо про пользователя
        $sql = "SELECT * FROM users WHERE ID = ".$me;
        $resItem = $this->DB->get_row($sql);

        //Если есть файл
        if($_FILES[$inputName]["tmp_name"])
        {
            $avatarName = $this->upload_photo($_FILES[$inputName]["tmp_name"]);

            //Удалим старую фотографию
            if($resItem["avatar"])
            {
                if(file_exists($this->avatarPath."/big/".$resItem["avatar"])){ unlink($this->avatarPath."/big/".$resItem["avatar"]); }
                if(file_exists($this->avatarPath."/small/".$resItem["avatar"])){ unlink($this->avatarPath."/small/".$resItem["avatar"]); }
            }

        }else
        {
            $avatarName = $resItem["avatar"];
        }

        //пишем в базу
        $arr = [
            "nickname"  => $nickname,
            "text"      => $text,
            "avatar"    => $avatarName,
        ];

        $res =  $this->DB->update("users", $arr, "ID = ".$me, true);

        //response
        return $arr;

    }

    public function delete($user_id = null)
    {
        $user_id = (!is_numeric($user_id))? $_COOKIE["user_id"] : $user_id;

        $resItem = $this->DB->get_row("SELECT avatar FROM users WHERE ID = ".$user_id);

        //Удалим старую фотографию
        if($resItem["avatar"])
        {
            if(file_exists($this->avatarPath."/big/".$resItem["avatar"])){ unlink($this->avatarPath."/big/".$resItem["avatar"]); }
            if(file_exists($this->avatarPath."/small/".$resItem["avatar"])){ unlink($this->avatarPath."/small/".$resItem["avatar"]); }
        }

        //удалим саму запись
        $this->DB->delete("users", "ID = ".$user_id, true);



        //response
        return true;

    }

    private function checkDir()
    {
        if(!is_dir($this->avatarPath."/big")){ mkdir($this->avatarPath."/big", "0777", true); }
        if(!is_dir($this->avatarPath."/small")){ mkdir($this->avatarPath."/small", "0777", true); }
    }

    public function upload_photo($file)
    {
        $this->checkDir();
        $avatarName = md5(time().rand()).".jpg";

        $img = new SimpleImage($file);
        $img->best_fit(600, 600)->save($this->avatarPath."/big/".$avatarName);
        $img->best_fit(200, 200)->save($this->avatarPath."/small/".$avatarName);

        return $avatarName;
    }
}