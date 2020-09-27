<?php
namespace App\Http\Controllers\Web\func;
use DB;
$answer = ["attachment"=>[
    "type"=>"template",
    "payload"=>[
      "template_type"=>"generic",
      "elements"=>[
        [
          "title"=>"Welcome to Peter\'s Hats",
          "item_url"=>"https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",
          "image_url"=>"https://img.thuthuatphanmem.vn/uploads/2018/09/25/hinh-anh-hoa-cuc-cau-vong-dep_110817989.jpg",
          "subtitle"=>"We\'ve got the right hat for everyone.",
          "buttons"=>[
            [
              "type"=>"web_url",
              "url"=>"https://petersfancybrownhats.com",
              "title"=>"View Website"
            ],
            [
              "type"=>"postback",
              "title"=>"Start Chatting",
              "payload"=>"DEVELOPER_DEFINED_PAYLOAD"
            ]
          ]
            ],
            [
                "title"=>"Welcome to Peter\'s Hats",
                "item_url"=>"https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",
                "image_url"=>"https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
                "subtitle"=>"We\'ve got the right hat for everyone.",
                "buttons"=>[
                  [
                    "type"=>"web_url",
                    "url"=>"https://petersfancybrownhats.com",
                    "title"=>"View Website"
                  ],
                  [
                    "type"=>"postback",
                    "title"=>"Start Chatting",
                    "payload"=>"DEVELOPER_DEFINED_PAYLOAD"
                  ]
                ]
                  ],
                  [
                    "title"=>"Welcome to Peter\'s Hats",
                    "item_url"=>"https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",
                    "image_url"=>"https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
                    "subtitle"=>"We\'ve got the right hat for everyone.",
                    "buttons"=>[
                      [
                        "type"=>"web_url",
                        "url"=>"https://petersfancybrownhats.com",
                        "title"=>"View Website"
                      ],
                      [
                        "type"=>"postback",
                        "title"=>"Start Chatting",
                        "payload"=>"DEVELOPER_DEFINED_PAYLOAD"
                      ]
                    ]
                  ]
      ]
    ]
  ]];

$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => $answer,
];

include("request.php");


