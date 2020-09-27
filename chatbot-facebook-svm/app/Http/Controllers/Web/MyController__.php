<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class MyController extends Controller
{
    public function getxinchao($ten,$namsinh)
    {
        return 'Chào bạn: ' . $ten.'<br>Có năm sinh là: '.$namsinh;
    }

    public function gettambiet($ten,$namsinh)
    {
        return 'Tạm biệt bạn : ' . $ten.'<br>Có năm sinh là: '.$namsinh;
    }
    public function GetHome()
    {
        $user='nguyễn thế phúc';
        return view('home',['user' => $user]);
    }


 public function infor()
    {
        $user='nguyễn thế phúc';
        $year='1994';
        return view('infor',compact('user','year'));
    }
 public function GetThaygiaoquocdan()
    {
        $user='nguyễn thế phúc';
        $year='1994';
        return view('thaygiaoquocdan',['user'=>$user,'year'=>$year]);
    }
 public function infor2()
    {
        $user='nguyễn thế phúc';
        $year='1994';
        return view('infor',['user'=>$user,'year'=>$year]);
    }
public function GetLogin()
{
    return view('login');
}
    public function PostLogin(Request $request)
{
    echo $request->taikhoan.'<br>';
    echo $request->matkhau;
}

}
