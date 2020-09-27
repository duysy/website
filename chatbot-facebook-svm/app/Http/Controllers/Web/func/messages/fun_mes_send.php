<?php
namespace App\Http\Controllers\Web\func;
use DB;
$data=DB::table('out_tem_mes')->where("nhan_data",$lable)->get();
// eval("\$answer=".$data[0]->code.";");
$answer=json_decode($data[0]->code);
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => $answer,
];
DB::table('his_mes')->insert([
    ['message_in' => $messageText,'nhan_data' => $lable,"idfacebook"=>$senderId,"user_id"=>"1"]
    ]);
include("request.php");



