<?php
namespace App\Http\Controllers\Web\func;
use DB;
$answer =[
    "attachment"=>[
        "payload"=>[
            "elements"=>[[
                "buttons"=> [[
                    "title"=>"Webview example",
                    "type"=>"web_url",
                    "url"=>"https://www.facebook.com/",
                    "webview_height_ratio"=>"tall",
                    "messenger_extensions"=> "true"
                ]],
                "image_url"=> "https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
                "item_url"=> "https://www.facebook.com/",
                "subtitle"=>"It's a TV!",
                "title"=>"Some TV"
            ]],
            "template_type"=>"generic"
        ],
        "type"=>"template"
    ]
];

$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => $answer,
];

include("request.php");


