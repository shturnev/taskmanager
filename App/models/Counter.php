<?php
namespace App\models;

class Counter{


    /**
     *
     * @param $array - [limit, page, posts, max_pages]
     * @return mixed
     */
    public static function get_nav($array)
    {

        $limit      = $array["limit"]; //сколько штук выдать
        $page       = $array["page"];  //аткивный номер страницы
        $posts      = $array["posts"]; // сколько всего записей в бд
        $max_pages  = $array["max_pages"]; //сколько штук-страниц отдать в стэк


        //проверки
        if(!$limit or !$posts) { return false;  }
        if(!$max_pages) { $max_pages = 3; }


        // Находим общее число страниц
        $total = (($posts - 1) / $limit) + 1; //((10 - 1) / 5) + 1 = 2,8
        $total = intval($total);

        // Определяем начало сообщений для текущей страницы
        $page = intval($page);

        // Если значение $page меньше единицы или отрицательно переходим на первую страницу
        // А если слишком большое, то переходим на последнюю
        if(empty($page) or $page < 0)   { $page = 1; }
        if($page > $total)              { $page = $total; }

        // Вычисляем начиная с какого номера
        // следует выводить сообщения
        $start = $page * $limit - $limit; //2 * 5 - 5 = 5

        // Выбираем $limit сообщений начиная с номера $start
        if ($start < 0) {$start = 0;}


        /*
            2ая часть
        */

        // Проверяем нужны ли стрелки назад
        if ($page != 1) { $pervpage = $page - 1; }

        // Проверяем нужны ли стрелки вперед
        if ($page != $total) { $nextpage = $page + 1; }

        //находим страницу для стрелочек на самую первую (в начало)
        if($pervpage) { $beginning = 1; }



        //формируем arr для отправки
        $arr["start"] = $start;
        $arr["limit"] = $limit;

        //формируем стэк
        if(!$pervpage && !$nextpage) { $arr["stack"] = false; return $arr; }

        $arr["stack"]["first"]   = $beginning;
        $arr["stack"]["last"]    = $total;
        $arr["stack"]["center"]  = $page;
        $arr["stack"]["prev"]    = $pervpage;
        $arr["stack"]["next"]    = $nextpage;
        $arr["stack"]["left"]    = array();
        $arr["stack"]["right"]   = array();

        // Находим две ближайшие станицы с обоих краев, если они есть
        for($i=$max_pages; $i>=1; --$i)
        {
            if($page - $i > 0) { $arr["stack"]["left"][] = $page - $i; }
        }


        for($i=1; $i<=$max_pages; ++$i)
        {
            if($page + $i <= $total) { $arr["stack"]["right"][] = $page + $i; }
        }


        //response
        return $arr;

    }

}