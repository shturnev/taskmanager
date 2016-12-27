$(document).ready(function () {

/*    var clear_url = window.location.protocol + "//" + window.location.hostname + "/"
        , this_page = window.location.href
        , optHref = clear_url + "face/options.php";*/


    $(".js-delete").on("click", function () {
        if(!confirm("Вы уверены?")){ return false; }

    });



}); //Конец Ready