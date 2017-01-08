<?php
// require_once 'VkAPI.php';

// $vk = new VkAPI('5800720', '387468926');

// $result = $vk->execute('audio.search', [
//     	'q'=>'The Beatles',
//     	'auto_complete'=>'1',
//     	'sort'=>'2',
//     	'count'=>'25',
//     	'offset'=>'0'
//     ]
// );

// var_dump($result);


    // //Инициализация curl
    // $curlInit = curl_init('http://www.ruseller.com');
    // curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
    // curl_setopt($curlInit,CURLOPT_HEADER,true);
    // curl_setopt($curlInit,CURLOPT_NOBODY,true);
    // curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
    
    // //Получаем ответ
    // $response = curl_exec($curlInit);
    // var_dump($response);

// $request_params = array(
//     'user_id' => 387468926,
//     'fields' => 'bdate',
//     'v' => '5.52'
// );
// $get_params = http_build_query($request_params);
// $result = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params));
// var_dump($result);

    // $url = 'https://api.vk.com/method/audio.search?q=Hasley&uid=387468926&access_token=30be4334c77c38e0900e921db27b9442873af27d7407f35b79ad95ed8c4e44791b84f65af57aa60b4ed8957aa60b4ed89';
    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_URL, $url);
    // $response = curl_exec($curl);
    // var_dump($response);
    // curl_close($curl);
    

$url = sprintf('https://api.vk.com/method/%s', 'users.search');

$ch = curl_init();
curl_setopt_array( $ch, array(
    CURLOPT_POST    => TRUE,            // это именно POST запрос!
    CURLOPT_RETURNTRANSFER  => TRUE,    // вернуть ответ ВК в переменную
    CURLOPT_SSL_VERIFYPEER  => FALSE,   // не проверять https сертификаты
    CURLOPT_SSL_VERIFYHOST  => FALSE,
    CURLOPT_POSTFIELDS      => array(   // здесь параметры запроса:
        'sex' => 1,
        'status' => 6,
        'age_from' => 20,
        'age_to' => 24,
        'count' => 50,
        'city' => 650,
        'fields' => 'city',
        'access_token' => '57cc55469979692631e7e1b1f52393c20b69c65945732ec9934cbfbbaaebadfcc2e1597c51816d05b4658',
    ),
    CURLOPT_URL             => $url,    // веб адрес запроса
));

$vk_response = curl_exec($ch); // запрос выполняется и всё возвращает в переменную
curl_close( $ch);
$response = json_decode($vk_response);
var_dump($response);

// $request_params = array(
//     'user_id' => 387468926,
//     'owner_id' => 77215815,
//     'access_token' => 'c19174fde823aa6c8e11cfcfd53e78d5d720f1a8611a27220c586154528e5b516b54249bd07c6e3f9746f',
//     'v' => '5.60'
// );
// $get_params = http_build_query($request_params);
// $result = json_decode(file_get_contents('https://api.vk.com/method/audio.get?'. $get_params));
// var_dump($result->response);
