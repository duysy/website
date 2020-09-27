// $(document).ready(function() {
//     alert("id");
// });

$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on("click", ".list ul li", function() {
        let id = $(this).attr("id");
        $.get(`/laravel/chatbot/public/data/fun_tem_mes?id=${id}`, function(data) {
            var textedJson = JSON.stringify(JSON.parse(data), undefined, 4);
            $('#myTextarea').text(textedJson);

            });


    });
    $(document).on("change", ".list ul li", function() {
        let id = $(this).attr("id");
        $.get(`/laravel/chatbot/public/data/fun_tem_mes?id=${id}`, function(data) {
            var textedJson = JSON.stringify(JSON.parse(data), undefined, 4);
            $('#myTextarea').text(textedJson);

            });


    });


});


