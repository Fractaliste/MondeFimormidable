
// Menu
$("#menu li").click(function (){
    $(location).attr("href",$(this).find("a").attr("href"));
});
