<?php
namespace App\models;


class TextSecurity
{

    public static function is_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}