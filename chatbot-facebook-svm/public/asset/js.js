// $(document).ready(function() {

// });

$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Khi phần tử add sau khi tao thì dùng cái này dung cho zindex1 input va output
    $(document).on("click", ".tr_table__act", function() {

        let ma_data = $(this).parent().attr("ma_data");
        let in_or_out = $(this).attr("class").split(" ")[1];
        let show_h1 = $("#show_seting_data").children("h1");
        let table = $("#show_seting_data").children("table");
        contten_h1 = `Mã example :${ma_data} | dữ liệu loai ${in_or_out}`
        $("#show_seting_data").attr("ma_data", ma_data);
        $("#show_seting_data").attr("in_or_out", in_or_out);
        table.empty()
        table.append(lable_table_add())

        if (in_or_out === "input") {
            $("#show_seting_data").css({
                display: "block",
            });
            $("#show_seting_data").attr("ma_data", ma_data);
            show_h1.text(contten_h1);
            // ajax--------------
            $.get(`/laravel/chatbot/public/data/get_input?nhan_data=${ma_data}`, function(data) {
                data.map(val => {
                    table.append(add_col_out_in_edit(val.id, val.nhan_data, val.input));

                });
            }).then(function() {

                table.append(add_button_add());
            });

        }
        if (in_or_out === "output") {
            $("#show_seting_data").css({
                display: "block",
            });
            $("#show_seting_data").attr("ma_data", ma_data);
            show_h1.text(contten_h1);
            // ajax
            $.get(`/laravel/chatbot/public/data/get_output?nhan_data=${ma_data}`, function(data) {
                data.map(val => {
                    table.append(add_col_out_in_edit(val.id, val.nhan_data, val.output));
                });
            }).then(function() {
                table.append(add_button_add());
            });
        }
        if (in_or_out === "insert_data") {
            $("#show_insert_data").css({
                display: "block",
            });
            $("#show_insert_data").closest("td['lable']").text("auto");
        }
    });
    // add data tu z-index 1
    $(document).on("click", ".add_data img", function() {
        let parent = $(this).closest("table");
        let tr = $(this).closest("tr");
        $(this).closest("tr").remove();
        let ma_data = $("#show_seting_data").attr("ma_data");
        parent.append(add_col_out_in_edit("auto", ma_data, ""));
        parent.append(tr);

    });

    // Them data mau
    $(document).on("click", "#buttom_submit_data", function() {

        let data_post = $(this).closest("html").find("#data_post");
        let auto = data_post.find("td[name='auto']").text();
        let nhan_data = data_post.find("td[name='lable']").text().toUpperCase();
        let input = data_post.find("td[name='input']").text();
        let output = data_post.find("td[name='output']").text();
        if (nhan_data && input && output) {
            $("#show_insert_data").css({
                display: "none",
            });
            let data = {
                nhan_data: nhan_data,
                input: input,
                output: output
            }

            $.ajax({
                url: '/laravel/chatbot/public/data/get_full',
                type: "POST",
                data: data,
                success: function(msg) {
                    let nhan_data = JSON.parse(msg).nhan_data;
                    $("#main_data table").append(add_col_main_data(nhan_data, input, output));
                    thong_bao("ok", "Đã thêm thành công");
                },
                error: function(msg) {
                    console.log("loi");
                }
            });

        } else {
            alert("hay nhap du");
        }

    });
    // insert output or input
    $(document).on("change", "#show_seting_data table tr td input", function() {
        let in_or_out = $("#show_seting_data").attr("in_or_out");
        let ma_data = $("#show_seting_data").attr("ma_data");
        let id = $(this).closest("tr");
        data_out_in = $(this).val();
        // alert(data_out_in+in_or_out+id+ma_data);

        let url = "";
        if (in_or_out === "input") {
            url = '/laravel/chatbot/public/data/get_input';
        } else if (in_or_out === "output") {
            url = '/laravel/chatbot/public/data/get_output';
        }
        $.ajax({
            url: url,
            type: "PUT",
            data: {
                nhan_data: ma_data,
                id: id.attr("id"),
                data_out_in: data_out_in
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
        if ($(this).closest('div').attr("id") === "main_data") {
            let nhan_data = $(this).parent().attr("ma_data")
            $.ajax({
                url: '/laravel/chatbot/public/data/get_full',
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
            let in_or_out = $("#show_seting_data").attr("in_or_out");
            let url = "";
            if (in_or_out === "input") {
                url = '/laravel/chatbot/public/data/get_input';
            } else if (in_or_out === "output") {
                url = '/laravel/chatbot/public/data/get_output';
            }
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

var add_col_out_in_edit = function(id, ma_data, contten) {
    return `
<tr id="${id}" ma_data="${ma_data}">
    <td>${id}</td>
    <td >${ma_data}</td>
    <td>
    <input type="text" name="" value="${contten}">
    </td>
    <td class="flex_center_row flex_space-around" id="button_delete">
        <nav class="btn_delete flex_center_row"><img src="./icon/color/x-button.svg" width="30px" alt=""></nav>
    </td>
</tr>`
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
var add_col_main_data = function(nhan_data, input, output) {
    return `
<tr ma_data="${nhan_data}">
    <td> ${nhan_data}</td>
    <td class="tr_table__act input" contenteditable="true">${input} </td>
    <td class="tr_table__act output" contenteditable="true">${output}</td>
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
