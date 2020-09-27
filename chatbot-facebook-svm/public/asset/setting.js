// $(document).ready(function() {

// });

$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Khi phần tử add sau khi tao thì dùng cái này dung cho zindex1 input va output

    // add data tu z-index 1
    $(document).on("click", ".add_data img", function() {
        let parent = $(this).closest("tbody");
        let tr = $(this).closest("tr");
        $(this).closest("tr").remove();
        if(parent.closest("div").attr("id") == "setting"){
            parent.append(add_col_setting("auto", "null", "null"));
        }
        else{
            let ma_data = $("#show_seting_data").attr("ma_data");
            parent.append(add_col_out_in_edit("auto", ma_data, ""));
        }
        parent.append(tr);

    });
    $(document).on("click", ".tr_table__act", function() {
        let ma_data = $(this).parent().attr("ma_data");
        let show_h1 = $("#show_seting_data").children("h1");
        let table = $("#show_seting_data").find("tbody");
        contten_h1 = `Mã example :${ma_data} |input`
        $("#show_seting_data").attr("ma_data", ma_data);
        table.empty()
        $("#show_seting_data").css({
                    display: "block",
                });

        $("#show_seting_data").attr("ma_data", ma_data);
            show_h1.text(contten_h1);
            // ajax--------------
                $.get(`/laravel/chatbot/public/data/get_input?nhan_data=${ma_data}`, function(data) {
                    data.map(val => {
                        table.append(add_col_out_in_edit(val.id,val.nhan_data,val.input));
                    });

                }).then(function() {

                    table.append(add_button_add());
                });
            // table.append(add_button_add());
    });

    // insert key_api
    $(document).on("change", "#key_api table tbody tr td input", function() {
        let id = $(this).closest("tr").attr("id");
        data_out_in = $(this).val();
        let hubVerifyToken=$(this).closest("tr").find("input[name='hubVerifyToken']").val()
        let accessToken=$(this).closest("tr").find("input[name='accessToken']").val()
        let id_page=$(this).closest("tr").find("input[name='id_page']").val()
        // console.log(hubVerifyToken);
        // console.log(accessToken);
        console.log(id_page);
         let url = '/laravel/chatbot/public/data/key_api';
        $.ajax({
            url: url,
            type: "PUT",
            data: {
                hubVerifyToken: hubVerifyToken,
                id: id,
                accessToken: accessToken,
                id_page:id_page
            },
            success: function(msg) {
                console.log(JSON.parse(msg));
                // id.attr("id", JSON.parse(msg).id);
                // id.children().eq(0).text(JSON.parse(msg).id);
                thong_bao("ok", "Đã sửa thành công");

            },
            error: function(msg) {
                console.log("loi");
            }
        });

    });
// insert code
    $(document).on("change", "#setting table tbody tr td input", function() {
        let ma_data = $(this).closest("tr").attr("ma_data");
        let code=$(this).closest("tr").find("input[name='code']").val()
        let url = '/laravel/chatbot/public/data/setting';
        let this_=$(this);
        // console.log(ma_data);
        // console.log(code);
        $.ajax({
            url: url,
            type: "PUT",
            data: {
                ma_data: ma_data,
                code: code
            },
            success: function(msg) {
                console.log(JSON.parse(msg));
                // id.attr("id", );
                // id.children().eq(0).text(JSON.parse(msg).id);
                thong_bao("ok", "Đã sửa thành công");
                if(ma_data == "auto"){
                    console.log(this_.closest("tr").attr("ma_data",JSON.parse(msg).ma_data));
                    this_.closest("tr").find("td").eq(0).text(JSON.parse(msg).ma_data);
                    // console.log(JSON.parse(msg).ma_data);
                }

            },
            error: function(msg) {
                console.log("loi");
            }
        });

    });
    // sua input
    $(document).on("change", "#show_seting_data table tr td input", function() {
        let ma_data = $("#show_seting_data").attr("ma_data");
        let id = $(this).closest("tr");
        let data = $(this).val();
        // alert(data+id.attr("id")+ma_data);


        let url = '/laravel/chatbot/public/data/get_input_setting';

        $.ajax({
            url: url,
            type: "PUT",
            data: {
                nhan_data: ma_data,
                id: id.attr("id"),
                data_out_in: data
            },
            success: function(msg) {
                console.log(JSON.parse(msg));
                id.attr("id", JSON.parse(msg).id);
                id.children().eq(0).text(JSON.parse(msg).id);
                thong_bao("ok", "Đã sửa thành công");

            },
            error: function(msg) {
                console.log("loi");
            }
        });

    });
    // delete
    $(document).on("click", "#button_delete", function() {
        let self = $(this);
        if ($(this).closest('div').attr("id") === "setting") {
            let nhan_data = $(this).parent().attr("ma_data")
            $.ajax({
                url: '/laravel/chatbot/public/data/setting',
                type: "DELETE",
                data: {
                    nhan_data: nhan_data
                },
                success: function(msg) {
                    // alert(nhan_data);
                    self.parent().remove();
                    thong_bao("ok", "Đã xóa thành công");

                },
                error: function(msg) {
                    console.log("loi");
                }
            });

        }
        if ($(this).closest('div').attr("id") === "show_seting_data") {
            let id = $(this).parent().attr("id");
            let url="/laravel/chatbot/public/data/get_input";
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    id: id
                },
                success: function(msg) {
                    console.log(msg);
                    self.parent().remove();
                    thong_bao("ok", "Đã xóa thành công");

                },
                error: function(msg) {
                    console.log("loi");
                }
            });
        }


    });

});

var add_button_add = function() {
    return `
 <tr class="add_data">
    <td colspan="4"><img src="./icon/color/plus.svg" width="40px" alt=""></td>
</tr>`;
}
var add_col_out_in_edit = function(id, ma_data,input) {
    return `
    <tr id="${id}">
    <td>${id}</td>
    <td>${ma_data}</td>
    <td><input type="text" value="${input}"></td>
    <td class="flex_center_row flex_space-around" id="button_delete">
        <nav class="btn_delete flex_center_row"><img src="./icon/color/x-button.svg" width="30px" alt=""></nav>
    </td>
</tr>
    `;
}
var lable_table_add = function() {
    return `<thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 10%;">Mã Lable</th>
                <th style="width: 80%;">Data</th>
                <th style="width: 5%;">Hành động </th>

            </tr>
        </thead>`
}
var add_col_setting = function(nhan_data, input, code) {
    return `
<tr ma_data="${nhan_data}">
                        <td>${nhan_data}</td>
                        <td class="tr_table__act">${input}</td>
                        <td><input name="code" type="text" value="${code}"></td>
                        <td class="flex_center_row flex_space-around" id="button_delete">
                            <nav class="btn_delete flex_center_row"><img src="./icon/color/x-button.svg" width="30px" alt=""></nav>
                        </td>
                    </tr>
`;
}

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
