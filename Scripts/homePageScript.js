$(document).ready(function(){
    $(".social-img").hover(function(){
        $(this).animate({bottom: '10px'})
        $(this).css("border-color", "#ff8c42")
    },
    function(){
        $(this).animate({bottom: '0px'})
        $(this).css("border-color", "#ffffff")
    }
    );
}); 