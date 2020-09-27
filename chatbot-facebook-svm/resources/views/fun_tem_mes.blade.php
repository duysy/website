<!DOCTYPE html>
<html lang="vn">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="asset/fun_tem_mes.css" rel="stylesheet">
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
        <div class="col">
            <div class="list">
                <ul>
                        @foreach ($list as $list)
                            <li id="{{$list->id}}"> {{ $list->loai }}</li>
                        @endforeach
                </ul>
            </div>
            <div class="detail">
                    <textarea name="" id="myTextarea" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="col">

        </div>

    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./asset/fun_tem_mes.js"></script>
<script type="text/javascript" src="./asset/menu.js"></script>

</html>
