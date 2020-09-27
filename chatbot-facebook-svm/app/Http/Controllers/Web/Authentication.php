<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
class Authentication extends Controller
{
    public function getLogin(){
        return view('login');
    }
    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials,true)) {
            return redirect('/data');
        }
        else{
            return "sai roi";
        }
    }
    public function getRegister(){
        return view('register');
    }
    public function postRegister(Request $request){
        $email = $request->email;
        $passwork = $request->passwork;
        $id=DB::table('users')->insertGetId(
            array('email' => $email, 'password' => bcrypt($passwork))
        );
        DB::table('key_api')->insert([
            ['hubVerifyToken' => 'null', 'accessToken' => 'null',"id_page"=>"null",'user_id'=>$id]
        ]);
        return redirect('/login');



    }
    public function logout(){
       Auth::logout();
    }




}
