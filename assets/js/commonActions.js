$(document).ready(function(){
    var main = $("#mainSectionContainer");
    var nav = $("#sideNavContainer");
    
    $(".navShowHide").on("click", function(){
        if(main.hasClass("leftPadding")){
            nav.hide();
        } else{
            nav.show();
        }
        main.toggleClass("leftPadding");
    });
});