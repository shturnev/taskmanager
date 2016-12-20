<?php
namespace App\models;


class TextSecurity
{

    public static function is_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function shield_hard($string){

        $string = htmlspecialchars($string);
        $string = addslashes($string);
        $string = str_replace(["`", "'", "\""], ["&lsquo;", "&lsquo;", "&quot;"], $string);

        return $string;

    }



}