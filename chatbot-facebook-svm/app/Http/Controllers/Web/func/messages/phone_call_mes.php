<?php
namespace App\Http\Controllers\Web\func;
use DB;
$answer =[
    "attachment"=>[

            "type"=>"template",
            "payload"=>[

                    "template_type"=>"button",
                    "text"=>"Gọi để biết thêm thông tin",
                    "buttons"=>[
                      [

                            "type"=>"phone_number",
                            "title"=>"Gọi ngay",
                            "payload"=>"+84345459398"

                      ]
                    ]

            ]

    ]
];

$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => $answer,
];

include("request.php");


