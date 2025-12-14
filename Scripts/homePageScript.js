$(document).ready(function(){
    //image alternation script
setInterval(function(){
        //
    console.log($("#photo1").css("display"));
    if($("#photo1").css("display") == "block"){
        $("#photo1").fadeOut(400);
        $("#photo2").delay(400).fadeIn(400);
    }
    if($("#photo2").css("display") == "block"){
        $("#photo2").fadeOut(400);
        $("#photo3").delay(400).fadeIn(400);
    }
    if($("#photo3").css("display") == "block"){
        $("#photo3").fadeOut(400);
        $("#photo1").delay(400).fadeIn(400);
    }
        //
},7000)
    //social media hover script
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