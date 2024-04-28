$(document).ready(function () {
    $(".menuClose").click(function(){                
        $(".sidebar").fadeOut();
    });
    $(".mobilemenushow").click(function(){                
        $(".sidebar").fadeIn();
    });

    $(".menuHide").on('click', function () {
        // $(".sidebar").fadeOut();
        $(".sidebar").animate({
            width: "50px",
            // opacity: "0",
        });
        $(".main_content").animate({
            margin: "0",
        },1500);
        $(".menushow").fadeIn("slow");
        $(this).fadeOut("fast");
    });
    $(".menushow").on('click', function () {
        $(".sidebar").animate({
            width: "270px",
            opacity: "1",
        });
        $(".main_content").animate({
            marginLeft: "270px",
        },500);
        $(".menuHide").fadeIn("slow");
        $(this).fadeOut("fast");
    });
    $(".sidebar_menu li").on('click', function () {
        $(this).animate().toggleClass('active');
    });
})