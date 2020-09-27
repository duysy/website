<?php
namespace App\Http\Controllers\Web\func;
use DB;
$data=[
    "whitelisted_domains"=>[
    "https://www.cloudways.com/",
    "https://petersfancybrownhats.com",
    "https://www.messenger.com",
    "http://sict.udn.vn/",
    "https://www.facebook.com/",
    "https://www.google.com/",
    "https://img.thuthuatphanmem.vn"
],
    "greeting"=>[
            [
            "locale"=> "default",
            "text"=> "Hello!"
            ],
            [
            "locale"=> "en_US",
            "text"=> "Timeless apparel for the masses."
            ]
     ]
];
$response = $data;

$ch = curl_init('https://graph.facebook.com/v5.0/me/messenger_profile?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
if(!empty($input)){
$result = curl_exec($ch);
}
curl_close($ch);


