<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
class MyController extends Controller
{
    public function __construct() {
        $this->middleware('auth');

    }
    public function data()
    {
        $id_user=Auth::user()["id"];
        $data=DB::table('chatbot_output')
        ->rightJoin('chatbot_input', 'chatbot_input.nhan_data', '=', 'chatbot_output.nhan_data')
        ->select('chatbot_input.id','chatbot_input.isfun','chatbot_input.nhan_data','chatbot_input.input','chatbot_output.output','chatbot_input.user_id')
        ->where("chatbot_input.user_id",$id_user)
        ->groupBy("nhan_data")
        ->where("isfun",false)
        ->get();
        return view('data', ['full_data' =>  $data]);

    }
    public function show_all_mes(){
        $id_user=Auth::user()["id"];
        $data=DB::table('chatbot_output')
        ->rightJoin('his_mes', 'his_mes.nhan_data', '=', 'chatbot_output.nhan_data')
        ->groupBy("his_mes.id")
        ->where("his_mes.user_id",$id_user)
        ->get();
        return view('show_all_mes', ['his_mes' =>  $data]);

    }
    public function setting(){
        $id_user=Auth::user()["id"];
        $data_out_fun_mes=DB::table('chatbot_input')
        ->rightJoin('out_tem_mes', 'chatbot_input.nhan_data', '=', 'out_tem_mes.nhan_data')
        ->select('chatbot_input.isfun','chatbot_input.nhan_data','chatbot_input.input','out_tem_mes.code','chatbot_input.user_id')
        ->where("chatbot_input.user_id",$id_user)
        ->groupBy("nhan_data")
        ->where("isfun",true)
        ->get();
        $key_api =DB::table('key_api')
        ->where("user_id",$id_user)
        ->get();
        return view('setting', ['data_out_fun_mes' =>  $data_out_fun_mes,"key_api" =>$key_api]);
    }
    public function fun_tem_mes(){
        $id_user=Auth::user()["id"];
        $list =DB::table('fun_tem_mes')
        ->where("user_id",$id_user)
        ->where("issetting",false)
        ->get();
        return view('fun_tem_mes',['list' =>  $list]);
    }



}
