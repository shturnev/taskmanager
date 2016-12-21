<?php

if(!$Auth->check_auth())
{
    include "App/views/tamplate.php";
}
else
{
    include "App/views/main.php";

}

