<!DOCTYPE html>
<html lang="vn">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="asset/style.css" rel="stylesheet">
    <link href="asset/chung.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <header class="w_100">
        <h1>-------------------------------------------Chào mừng bạn đến với chatbot---------------------------------</h1>
        <div class="thong_bao"></div>


    </header>

    <div id="menu">
        <div class="flex_center_row" id="button_menu_out">
            <img src="./icon/black/menu.svg" width="30px" alt="">
        </div>
        <div class="flex_center_row" id="button_menu_in">
            <nav><b>ẨN MENU</b></nav>
            <img src="./icon/black/left-arrow.svg" width="30px" alt="">
        </div>
        <div class="flex_center_col">
            <ul>
                <li><a href="{{url('/data')}}">Data train</a></li>
                <li><a href="{{url('/setting')}}">Setting</a></li>
                <li><a href="{{url('/fun_tem_mes')}}">Template</a></li>
                <li><a href="{{url('/show_all_mes')}}">Message history</a></li>
                <button style="width: 100%;height: 30px;"><a href="{{url('/data/train_chatbot_api')}}">Train</a></button>
            </ul>
        </div>

    </div>
    <main>
        <div class="data_train  w_100 ">
            <!-- --------------------------------- -->
            <div id="show_seting_data" class="table-wrapper" ma_data="" style="display:none;">
                <div class="button_close">
                    <img src="./icon/color/error.svg" width="30px" alt="">
                </div>
                <h1>Mã example :{} | dữ liệu loai {}</h1>
                <table class="w_100 fl-table">
                    <thead>
                        <!-- Thay doi vao javascrip thay doi -->
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Mã Lable</th>
                            <th style="width: 80%;">Data</th>
                            <th style="width: 5%;">Hành động </th>

                        </tr>
                    </thead>
                    <tr id="1">
                        <td>null</td>
                        <td>null</td>
                        <td>null</td>
                        <td class="flex_center_row flex_space-around" id="button_delete">
                            <nav class="btn_delete flex_center_row"><img src="./icon/color/x-button.svg" width="30px" alt=""></nav>
                        </td>
                    </tr>
                    <tr class="add_data">
                        <td colspan="4"><img src="./icon/color/plus.svg" width="40px" alt=""></td>
                    </tr>

                </table>
            </div>
            <!-- ------------------------------------------- -->
            <div id="show_insert_data" class="table-wrapper" ma_data="" style="display:none;">
                <div class="button_close">
                    <img src="./icon/color/error.svg" width="30px" alt="">
                </div>
                <h1>insert more data</h1>
                <table class="w_100 fl-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Mã Lable</th>
                            <th style="width: 37%;">Input</th>
                            <th style="width: 38%;">Output</th>

                        </tr>
                    </thead>
                    <tr id="data_post">
                        <td name="auto">auto</td>
                        <td contenteditable='true' name="lable">auto</td>
                        <td contenteditable='true' name="input"></td>
                        <td contenteditable='true' name="output"></td>

                    </tr>
                    <tr>
                        <td colspan="4"><img id="buttom_submit_data" src="./icon/color/up-arrow.svg" width="40px" alt=""></td>
                    </tr>

                </table>
            </div>
            <!-- ------------------------------------- -->

            <div class="w_100" id="main_data">
                <table class="w_100 fl-table">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Mã Lable</th>
                            <th style="width: 40%;">Input</th>
                            <th style="width: 40%;">Output </th>
                            <th style="width: 5%;">Hành động </th>
                        </tr>
                    </thead>

                    @foreach ($full_data as $full_data)
                    <tr ma_data="{{ $full_data->nhan_data }}">
                        <td> {{ $full_data->nhan_data }}</td>
                        <td class="tr_table__act input" contenteditable="true">{{ $full_data->input }} </td>
                        <td class="tr_table__act output" contenteditable="true">{{ $full_data->output }}</td>
                        <td class="flex_center_row flex_space-around" id="button_delete">
                            <nav class="btn_delete flex_center_row"><img src="./icon/color/x-button.svg" width="30px" alt=""></nav>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="tr_table__act insert_data" colspan="4"><img src="./icon/color/plus.svg" width="40px" alt=""></td>
                    </tr>
                </table>
            </div>

        </div>
    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./asset/js.js"></script>
<script type="text/javascript" src="./asset/menu.js"></script>

</html>
