
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on("keyup", ".change input", function() {
        data_input = $(this).val();
        let self= $(this);
        let show_detail =  self.closest('tr').find("ul");

        $(".show_detail").css({
            display: "block",
        });
        show_detail.empty();
        new Promise(() => {
            $.get(`/laravel/chatbot/public/data/search_nhan_data?data=${data_input}`, function(data) {
                data.map(val => {
                    show_detail.append(`<li><strong>${val.output}</strong>|<small ma_data="${val.nhan_data}">${val.nhan_data.substring(0,5)}</small></li>`);
                });

            });

        })
    });

    $(document).on("click", ".show_detail li", function() {
        let nhan_data=$(this).find("small").attr("ma_data");
        td_nhan_data=$(this).closest("tr").find("td");
        let id = $(this).closest("tr").attr("id");
        $(this).closest('td').find("input").val($(this).find("strong").text());
        $(".show_detail").empty();

        $.ajax({
            url: "/laravel/chatbot/public/data/his_mes",
            type: "PUT",
            data: {
                id:id,
                nhan_data:nhan_data
            },
            success: function(msg) {
                console.log(msg);
                console.log(td_nhan_data.eq(1).text(nhan_data));
                thong_bao("ok","Đã sửa thành công");

            },
            error: function(msg) {
                console.log("loi");
            }
        });

    });
});


