<?php
namespace App\Http\Controllers\Web\func;
use DB;
$answer =[
    "attachment"=>[
      "type"=>"template",
      "payload"=>[
        "template_type"=>"button",
        "text"=>"What do you want to do next?",
        "buttons"=>[
          [
            "title"=>"Kiem tra ngay",
            "type"=>"web_url",
            "url"=>"https://www.google.com/",
            "webview_height_ratio"=>"tall",
            "messenger_extensions"=> "true"
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


