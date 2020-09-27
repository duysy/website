<!DOCTYPE html>
<html lang="vn">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="asset/chung.css" rel="stylesheet">
    <link href="asset/style_all_mes.css" rel="stylesheet">
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
    <!-- {{print_r($his_mes)}} -->
        <table class="w_100 fl-table">
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 5%;">Mã Lable</th>
                    <th style="width: 40%;">Input</th>
                    <th style="width: 40%;">Output </th>
                    <th style="width: 5%;">Add </th>
                </tr>
            </thead>
            @foreach($his_mes as $his_mes)
            <tr id="{{$his_mes->id}}">
                <td>{{$his_mes->id}}</td>
                <td>{{$his_mes->nhan_data}}</td>
                <td class="tr_table__act input change">{{$his_mes->message_in}}</td>
                <td class="tr_table__act output change" id="{{$his_mes->id}}">
                    <input type="text" value=" {{$his_mes->output}}">
                    <ul class="show_detail"></ul>

                    </div>
                </td>

                <td>
                    <button type="Train">Add</button>
                </td>
            </tr>
            @endforeach

        </table>
    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./asset/js_show_all_mes.js"></script>
<script type="text/javascript" src="./asset/menu.js"></script>

</html>
