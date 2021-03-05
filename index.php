<?php

if (!isset($_REQUEST)) {
    return;
}

if ($_GET["dev"] == 1) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

define('_ROOT_', __DIR__);

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) { require $path; }
});


$app = new Bootstrap();
$app->start();

/*


$confirmation_token = 'd53f57ae';
$token = '583b76fb56997af743aa23750b5b8bf4a8368647ad51fc39eaf4221de295baf46bfa24f599ab15f9b2952';
$data = json_decode(file_get_contents('php://input'));

function sendMessage($text,$user_id,$user_name) {
    $request_params = array(
        'message' => $text,
        'peer_id' => $user_id,
        'access_token' => getenv('TOKEN'),
        'v' => '5.130',
        'random_id' => '0'
    );

    $get_params = http_build_query($request_params);

    file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
}

switch ($data->type) {
    case 'confirmation':
        echo getenv('CONFIRMATION_TOKEN');
        break;
    case 'message_new':
        $user_id = $data->object->message->from_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.103"));
        $user_name = $user_info->response[0]->first_name;
        $msg_text = $data->object->message->text;
        sendMessage($msg_text,$user_id,$user_name);
        echo('ok');

        break;

}*/