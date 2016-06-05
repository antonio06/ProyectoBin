$(document).ready(function () {
    var overlay = $(".overlay")[0];
    console.log(overlay);
    var menu = $("#submenuMovil");
    $("#btnResponsive").click(function (event) {
        event.preventDefault();
        $(overlay).css({display: "block"});
        menu.css({transform: "translateX(0px)"});
    });

    $(overlay).click(function () {
        $(this).css({display: "none"});
        menu.css({transform: "translateX(-200px)"});
    });
});