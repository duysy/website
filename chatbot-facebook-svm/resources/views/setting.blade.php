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
            </ul>
        </div>

    </div>
    <main>
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
        <div class="w_100" id="key_api">
            <table class="w_100 fl-table">
                <thead>
                    <tr>
                        <th style="width: 25%;">ID</th>
                        <th style="width: 25%;">hubVerifyToken</th>
                        <th style="width: 25%;">accessToken </th>
                        <th style="width: 25%;">id_page </th>
                    </tr>
                </thead>
                <tr id="{{ $key_api[0]->id }}">
                    <td>{{ $key_api[0]->id }}</td>
                    <td><input type="text" name="hubVerifyToken" value="{{ $key_api[0]->hubVerifyToken }}"></td>
                    <td><input type="text" name="accessToken" value="{{ $key_api[0]->accessToken }}"></td>
                    <td><input type="text" name="id_page" value="{{ $key_api[0]->id_page }}"></td>
                </tr>
            </table>
        </div>
        <br>
        <br>
        <br>
        <div class="w_100" id="setting">
            <table class="w_100 fl-table">
                <thead>
                    <tr>
                        <th style="width: 15%;">Nhan</th>
                        <th style="width: 30%;">Input</th>
                        <th style="width: 50%;">Code </th>
                        <th style="width: 5%;">Xoa </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_out_fun_mes as $out_fun_mes)
                    <tr ma_data="{{ $out_fun_mes->nhan_data }}">
                        <td>{{ $out_fun_mes->nhan_data }}</td>
                        <td class="tr_table__act">{{ $out_fun_mes->input }}</td>
                        <td><input name="code" type="text" value="{{ $out_fun_mes->code }}"></td>
                        <td class="flex_center_row flex_space-around" id="button_delete">
                            <nav class="btn_delete flex_center_row"><img src="./icon/color/x-button.svg" width="30px" alt=""></nav>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="add_data" colspan="4"><img src="./icon/color/plus.svg" width="40px" alt=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./asset/setting.js"></script>
<script type="text/javascript" src="./asset/menu.js"></script>

</html>
