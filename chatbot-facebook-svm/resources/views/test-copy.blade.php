<!DOCTYPE html>
<html lang="vn">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="asset/chung.css" rel="stylesheet">
    <link href="asset/style_all_mes.css" rel="stylesheet">
</head>

<body>
    <header class="w_100">
        Chao mung ban den voi abc
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
                <li><a href="#">Trang chu</a></li>
                <li><a href="#">Quan Ly</a></li>
                <li class="active_menu"><a href="{{url('/show_all_mes')}}">message send</a></li>
                <li><a href="{{url('/data')}}">Train CHat Bot</a></li>
            </ul>
        </div>

    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./asset/js_show_all_mes.js"></script>
<script type="text/javascript" src="./asset/menu.js"></script>

</html>
