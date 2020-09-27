<?php
namespace App\Http\Controllers\Web\func;
use DB;
if($lable != "TOI-KHONG-HIEU"){
    $data =DB::table('chatbot_output')->where("nhan_data",$lable)->get();
    $answer = $data[mt_rand(0,count($data)-1)]->output;
}
else{
    $answer="Tôi chưa được dạy vấn đề này";
}
$response = [
    'recipient' => [ 'id' => $senderId],
    'message' => [ 'text' => $answer]
];
DB::table('his_mes')->insert([
    ['message_in' => $messageText,'nhan_data' => $lable,"idfacebook"=>$senderId,"user_id"=>"1"]
    ]);
include("request.php");


