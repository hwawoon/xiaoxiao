$(function (){
    $("#tags span").each(function(i,obj){
        if(i%5 == 0)
        {
            $(obj).css("font-size","14px");
            $(obj).addClass("label-primary");
        }
        else if(i%5 == 1)
        {
            $(obj).css("font-size","12px");
            $(obj).addClass("label-success");
        }
        else if(i%5 == 2)
        {
            $(obj).css("font-size","17px");
            $(obj).addClass("label-info");
        }
        else if(i%5 == 3)
        {
            $(obj).css("font-size","15px");
            $(obj).addClass("label-warning");
        }
        else if(i%5 == 4)
        {
            $(obj).css("font-size","19px");
            $(obj).addClass("label-danger");
        }
    });

});