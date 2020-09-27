$(document).ready(function(){
    $("#button_menu_in").click(function() {
        $("#menu").css({
            left: -200,
        });
        $("#button_menu_out").css({
            display: "flex",
        });

    });
    $("#button_menu_out").click(function() {
        $("#menu").css({
            left: 0,
        });
        $("#button_menu_out").css({
            display: "none",
        });
    });
    $(".button_close").click(function() {
        $("#show_seting_data").css({
            display: "none",
        });
        $("#show_insert_data").css({
            display: "none",
        });
    });
});
function thong_bao(loai, text) {
    if (loai === "ok") {
        console.log("thong bao");
        $(".thong_bao").text(text);
        $(".thong_bao").fadeIn(1500, function() {
            $(".thong_bao").css({
                display: "none",
            });
        });

    }
}
