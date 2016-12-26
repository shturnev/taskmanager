<?php
namespace App\models;


class TextSecurity
{

    public static function is_email($email){
        return filter_var(strtolower($email), FILTER_VALIDATE_EMAIL);
    }

    public static function shield_hard($string){

        $string = htmlspecialchars($string, ENT_QUOTES);
        $string = addslashes($string);
        $string = str_replace(["`"], ["&lsquo;"], $string);
        $string = trim($string);
        return $string;

    }

    /**
     * HTML без JS
     * @param $string
     * @return mixed|string
     */
    public static function shield_medium($string){

        $string = addslashes($string);
        $string = str_replace(["`"], ["&lsquo;"], $string);

        return $string;
    }

    /**
     * Чистый HTML + JS
     * @param $string
     * @return mixed|string
     */
    public static function shield_light($string){

        $string = addslashes($string);
        $string = str_replace(["`"], ["&lsquo;"], $string);

        return $string;

    }



}