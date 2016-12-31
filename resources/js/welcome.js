$(document).ready(function () {


    $.fn.extend({
        animateCss: function (animationName) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            this.addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);
            });
        }
    });


    $('label[for="forLoginCont"]').on("click", function () {

        var status = $("#login-cont").is(":visible");

        if(!status){
            $(".form-cont").animateCss('bounceInDown');
        }


    });


}); //Конец Ready