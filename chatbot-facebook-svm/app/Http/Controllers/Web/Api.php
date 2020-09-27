<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class Api extends Controller
{
    public function Api_data_get(Request $request,$todo)
    {
        $user_id=Auth::user()["id"];
        switch ($todo){
            case "test":{
                // $data =strtoupper(Str::random(10));
                // return response()->json($answer, 200);
            break;
            }
            case "data_train":{
                $data =DB::table('chatbot_input')->get();
                return($data);
            break;
            }
            case "get_full":{
                $data=DB::table('chatbot_input')
                ->Join('chatbot_output', 'chatbot_input.nhan_data', '=', 'chatbot_output.nhan_data')
                ->groupBy('chatbot_input.nhan_data')
                ->where("user_id",$user_id)
                ->get();
                return($data);
                break;
            }
            case "search_nhan_data":{
                $term = $request->input('data');
                $data = DB::table('chatbot_output')
                ->where('output', 'LIKE', "%{$term}%")
                ->where("user_id",$user_id)
                ->get();
                return($data);
                break;
            }
            case "get_input":{
                $nhan_data= $request->input('nhan_data');
                $data=DB::table('chatbot_input')
                ->where("nhan_data",$nhan_data)
                ->where("user_id",$user_id)
                ->get();
                return($data);
                break;
            }
            case "get_output":{
                $nhan_data= $request->input('nhan_data');
                $data=DB::table('chatbot_output')
                ->where("nhan_data",$nhan_data)
                ->where("user_id",$user_id)
                ->get();
                return($data);
                break;
            }
            case "train_chatbot_api":{
                $res=file_get_contents('http://localhost:5000/api/train_model/sajkfh8dhfs87fhds/');
                echo $res;
            break;
            }
            case "fun_tem_mes":{
                $id= $request->input('id');
                $list =DB::table('fun_tem_mes')
                ->where("user_id",$user_id)
                ->where("issetting",false)
                ->where("id",$id)
                ->value("code");
                // $list= json_decode($list);
                return response()->json($list, 200);
            break;
            }

            default:{
                return "sai sai gì gì đó";
            }

        }
    }
    public function Api_data_post(Request $request,$todo)
    {
        $user_id=Auth::user()["id"];
        switch ($todo){
            case "test":{
                // $data =strtoupper(Str::random(15));
                echo Auth::user();
            break;
            }

            case "get_full":{
                $nhan_data= $request->input('nhan_data');
                if($nhan_data == "AUTO"){
                    $nhan_data = strtoupper(Str::random(10));
                }
                $input=$request->input('input');
                $output=$request->input('output');

                DB::table('chatbot_output')->insert([
                ['nhan_data' => $nhan_data,'output' => $output,"user_id"=>$user_id]
                ]);

                DB::table('chatbot_input')->insert([
                ['nhan_data' => $nhan_data, 'input' => $input,"user_id"=>$user_id],
                ]);

                return response()->json(['nhan_data' => $nhan_data], 200)->header('Content-Type', 'text/plain');
                break;
            }

            default:{
                return "sai sai gì đó";
            }

        }
    }
    public function Api_data_delete(Request $request,$todo)
    {
        $user_id=Auth::user()["id"];
        switch ($todo){
            case "test":{
                // $data =strtoupper(Str::random(15));
                echo Auth::user();
            break;
            }
            case "get_full":{
                $nhan_data= $request->input('nhan_data');
                DB::table('chatbot_input')->where('nhan_data', '=', $nhan_data)->where("user_id",$user_id)->delete();
                DB::table('chatbot_output')->where('nhan_data', '=', $nhan_data)->where("user_id",$user_id)->delete();
                return response()->json(['message' => 'ok'], 200)->header('Content-Type', 'text/plain');
                break;
            }
            case "get_input":{
                $id= $request->input('id');
                $nhan_data=DB::table("chatbot_input")->where("id","=",$id)->where("user_id",$user_id)->value("nhan_data");
                $count = DB::table('chatbot_input')->where("nhan_data","=",$nhan_data)->where("user_id",$user_id)->count();
                if($count == 1){
                    DB::table('chatbot_input')->where("nhan_data","=",$nhan_data)->where("user_id",$user_id)->delete();
                    DB::table('chatbot_output')->where("nhan_data","=",$nhan_data)->where("user_id",$user_id)->delete();
                }
                else{
                    DB::table('chatbot_input')->where("id","=",$id)->where("user_id",$user_id)->delete();
                }

                return response()->json(['message' =>  "ok"], 200)->header('Content-Type', 'text/plain');
                break;
            }
            case "get_output":{
                $id= $request->input('id');
                DB::table('chatbot_output')->where("id","=",$id)->where("user_id",$user_id)->delete();
                return response()->json(['message' => 'ok'], 200)->header('Content-Type', 'text/plain');
                break;
            }
            case "setting":{
                $nhan_data= $request->input('nhan_data');
                DB::table('chatbot_input')->where('nhan_data', '=', $nhan_data)->where("user_id",$user_id)->delete();
                DB::table('out_tem_mes')->where('nhan_data', '=', $nhan_data)->where("user_id",$user_id)->delete();
                return response()->json(['message' => 'ok'], 200)->header('Content-Type', 'text/plain');
                break;
            }

            default:{
                return "sai sai gì đó";
            }

        }
    }
    public function Api_data_put(Request $request,$todo)
    {
        $user_id=Auth::user()["id"];

        switch ($todo){
            case "test":{
                // $data =strtoupper(Str::random(15));

            break;
            }
            case "setting":{
                $ma_data = $request->input('ma_data');
                $code = $request->input('code');
                if($ma_data == "auto"){
                    $ma_data=strtoupper("FUN-".Str::random(10));
                    DB::table('out_tem_mes')
                    ->insert(array('nhan_data' =>$ma_data,'code' => $code,"user_id"=>$user_id));
                    DB::table('chatbot_input')
                    ->insert(array('nhan_data' =>$ma_data,'input' => "null","isfun"=>true,"user_id"=>$user_id));
                    return response()->json(['ma_data' => $ma_data], 200)->header('Content-Type', 'text/plain');
                }
                else{
                    DB::table('out_tem_mes')
                    ->where("user_id",$user_id)
                    ->where("nhan_data",$ma_data)
                    ->update(['code' => $code]);
                    return response()->json(['message' =>  'ok'], 200)->header('Content-Type', 'text/plain');
                }

                break;
            }


            case "key_api":{
                $id= $request->input('id');
                $hubVerifyToken=$request->input('hubVerifyToken');
                $accessToken=$request->input('accessToken');
                $id_page=$request->input('id_page');
                DB::table('key_api')
                ->where("user_id",$user_id)
                ->update(['hubVerifyToken' => $hubVerifyToken, 'accessToken' => $accessToken,"id_page"=>$id_page]);
                return response()->json(['message' =>  'ok'], 200)->header('Content-Type', 'text/plain');

            break;
            }
            case "get_input":{
                $id= $request->input('id');
                $nhan_data=$request->input('nhan_data');
                $data_out_in = $request->input('data_out_in');
                if($id == "auto"){
                    $id_ = DB::table('chatbot_input')->insertGetId(
                        ['nhan_data' =>$nhan_data, 'input' => $data_out_in,"user_id"=>$user_id]
                    );
                    return response()->json(['id' =>  $id_], 200)->header('Content-Type', 'text/plain');
                }
                else{
                    DB::table('chatbot_input')
                    ->where('id', $id)
                    ->update(['input' => $data_out_in]);
                    return response()->json(['message' =>  'ok'], 200)->header('Content-Type', 'text/plain');
                }

                break;
            }
            case "get_input_setting":{
                $id= $request->input('id');
                $nhan_data=$request->input('nhan_data');
                $data_out_in = $request->input('data_out_in');
                if($id == "auto"){
                    $id_ = DB::table('chatbot_input')->insertGetId(
                        ['nhan_data' =>$nhan_data, 'input' => $data_out_in,"isfun"=>true,"user_id"=>$user_id]
                    );
                    return response()->json(['id' =>  $id_], 200)->header('Content-Type', 'text/plain');
                }
                else{
                    DB::table('chatbot_input')
                    ->where('id', $id)
                    ->update(['input' => $data_out_in]);
                    return response()->json(['message' =>  'ok'], 200)->header('Content-Type', 'text/plain');
                }

                break;
            }
            case "get_output":{
                $id= $request->input('id');
                $nhan_data=$request->input('nhan_data');
                $data_out_in = $request->input('data_out_in');
                if($id == "auto"){
                    $id_ = DB::table('chatbot_output')->insertGetId(
                        ['nhan_data' =>$nhan_data, 'output' => $data_out_in,"user_id"=>$user_id]
                    );
                    return response()->json(['id' =>  $id_], 200)->header('Content-Type', 'text/plain');
                }
                else{
                    DB::table('chatbot_output')
                    ->where('id', $id)
                    ->update(['output' => $data_out_in,"user_id"=>$user_id]);
                    return response()->json(['message' =>  'ok'], 200)->header('Content-Type', 'text/plain');
                }
                break;
            }

            case "his_mes":{
                $id= $request->input('id');
                $nhan_data=$request->input('nhan_data');
                DB::table('his_mes')
                ->where('id', $id)
                ->update(['nhan_data' => $nhan_data,"user_id"=>$user_id]);
                return response()->json(['message' =>  'ok'], 200)->header('Content-Type', 'text/plain');
                break;
            }
            default:{
                return "sai sai gì đó";
            }

        }
    }





}
