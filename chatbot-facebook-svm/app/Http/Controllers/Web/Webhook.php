<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;


class Webhook extends Controller
{
    // // check token at setup
    function get(Request $request,$id_page){
        $hubVerifyToken = DB::table('key_api')
        ->where("id_page",$id_page)
        ->value("hubVerifyToken");
        if ($request['hub_verify_token'] === $hubVerifyToken ) {
            echo $request['hub_challenge'];
            exit;
          }

    }

    // handle bot's anwser
    function post(Request $request,$id_page){
        $accessToken = DB::table('key_api')
        ->where("id_page",$id_page)
        ->value("accessToken");
        // $accessToken =  "EAAF7pwzf2ysBAHZAP2gapFWfe3xHsgnrZAphK3YWZCxGqwfk3mwIXURXZCjvSeCHkc7NTUbJZCldZCabiv0FEL3qxHYjvqaXvzrwTtD6uoIBj3NLNTde0UmR0k5Qt9fWV92qIZB0XUyYbME9rJ4KMtgY6KVdNK1Vfck6smQlZCKPyYmWafzkITeAgsDRKLtcEUQZD";
        $input= $request->all();
        $senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
        $messageText = $input['entry'][0]['messaging'][0]['message']['text'];
        $response = null;


    //     // set Message
        $postdata = http_build_query(
            array(
                'msg' => $messageText,
            )
        );
        $opts = array('http' =>
            array(
                'method'  => 'GET',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'protocol_version' => 1.1,
            )
        );
        $context = stream_context_create($opts);
        $lable = file_get_contents('http://localhost:5000/api/tra_loi/sajkfh8dhfs87fhds?'.$postdata, false, $context);
        //send message to facebook bot
        if(count(explode("-",$lable))==2){
            include("func/messages/fun_mes_send.php");
        }
        else{
            include("func/messages/send_mes.php");
        }
    }
}
