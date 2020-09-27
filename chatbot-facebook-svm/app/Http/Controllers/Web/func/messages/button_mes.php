<?php
namespace App\Http\Controllers\Web\func;
use DB;
$answer = [
    "attachment"=>[
        "type"=>"template",
        "payload"=>[
            "template_type"=>"button",
            "text"=>"What do you want to do next?",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"http://sict.udn.vn/",
                "title"=>"Visit Messenger"
                ,
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


