<?php


require_once('./LINEBotTiny.php');
$channelAccessToken = '3gZ2i4rD/Lx1ktw1MuFiIByX90Ls4gw+W8KACzlJgeKn2D73rb3A4eUtBWvaMIXIEpmyUTXPjjzlRPcEx0y0XeKaaJX0PlLBUcyIXju2CcHjti4As/9Pyc8JzV/hpDt876UAQusK7UfVrX3qIJ018QdB04t89/1O/w1cDnyilFU=';
$channelSecret = '3925686d451f48ecb64b9255c2b83a26';
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$user_name;
$user_stage=0;
$curretFlag=false;
$curretStop=0;
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $lineId = $event['source']['userId'];
            $lineMsg =$message['text'];

            switch ($message['type']) {
                case 'text':

                    if($lineMsg=="start")
                    {

                        $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                'messages' => array(
                                    array(
                                        'type' => 'text',
                                        'text' => '請輸入您的大名'
                                    )
                                )
                        ));

                        $curretFlag = true;
                        $curretStop=1;

                    }
                    if($curretStop==1 && $lineMsg!="")
                    {
                        $user_name=$lineMsg;
                        $curretStop=2;
                        $client->replyMessage(array(
                                                'replyToken' => $event['replyToken'],
                                                'messages' => array(
                                                    array(
                                                        'type' => 'template',
                                                        'altText' => '請至手機使用此功能喔',
                                                        'template' => array(
                                                            'type' => 'buttons',
                                                            'text' => $user_name.'剛進公司來到座位前,打開電腦後,發現桌上有一隻蟑螂,這時後'.$user_name
,
                                                            'actions' => array(
                                                                0 => array(
                                                                    'type' => 'message',
                                                                    'label' => '馬上拿筆記本打下去',
                                                                    'text' => '馬上拿筆記本打下去'
                                                                ),
                                                                1 => array(
                                                                    'type' => 'message',
                                                                    'label' => '舔一下嘴角',
                                                                    'text' => '舔一下嘴角'
                                                                )
                                                            )
                                                        )
                                                    )
                                                )
                             ));

                        

                }
                 if($curretStop==2 && preg_match('[馬上拿筆記本打下去]', $lineMsg) )
                {
                        $curretStop=3;
                        $client->replyMessage(array(
                                                'replyToken' => $event['replyToken'],
                                                'messages' => array(
                                                    array(
                                                        'type' => 'template',
                                                        'altText' => '請至手機使用此功能喔',
                                                        'template' => array(
                                                            'type' => 'buttons',
                                                            'text' => $user_name.'快速拿筆記本一陣狂打,可惜沒有一次命中,蟑螂馬上跑掉,這時後被通知準備要開'
,
                                                            'actions' => array(
                                                                0 => array(
                                                                    'type' => 'message',
                                                                    'label' => 'Audi的會',
                                                                    'text' => 'Audi的會'
                                                                ),
                                                                1 => array(
                                                                    'type' => 'message',
                                                                    'label' => '午後的會',
                                                                    'text' => '午後的會'
                                                                ),
                                                                2 => array(
                                                                    'type' => 'message',
                                                                    'label' => '繼續抓蟑螂',
                                                                    'text' => '繼續抓蟑螂'
                                                                )
                                                            )
                                                        )
                                                    )
                                                )
                             ));


                }

                    
                // if (preg_match('[傲嬌創意設計]', $lineMsg) ) {

                //             $client->replyMessage(array(
                //                 'replyToken' => $event['replyToken'],
                //                 'messages' => array(
                //                     array(
                //                         'type' => 'text',
                //                         'text' => '請輸入您的大名'
                //                     )
                //                 )
                //             ));

                //             //$curretFlag = true;
                //      }

                    break;

                case 'image':

                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => 'cool'
                            )
                        )
                    ));

                    break;


                    
                default:
                    error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};

?>