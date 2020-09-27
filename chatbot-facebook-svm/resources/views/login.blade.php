<!DOCTYPE html>
<html lang="vn">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="asset/login.css" rel="stylesheet">
        <link href="asset/chung.css" rel="stylesheet">
    </head>
    <body>
        <main class="flex_center_row">
            <div class="login_container flex_center_col">
                <nav>Login</nav>
               <form method="POST" action="{{url('/login')}}">
                    {{ csrf_field()}}
                    <div class="item">
                            <input type="text" placeholder="nhap tai khoan" name="email">
                    </div>
                    <div class="item">
                            <input type="text" placeholder="nhap passwork" name="password">
                    </div>
                    <div class="item w_100 flex_center_row button">
                        <input type="submit" value="Login">
                    </div>
               </form>
               <div class="item">
                            <a href="{{url('/register')}}">register</a>
                    </div>
            </div>
        </main>
    </body>
</html>
