<?php


namespace App\Core;


class Controller {
    /**
     * Data json-object
     * @var object
     */
    private $data;
    static private $token;
    protected $access = "default";
    protected $binds;
    private $settings;

    public function __construct($data, $token)
    {
        $this->data = $data;
        $this->token = $token;
        $this->binds = require(_ROOT_.'/App/Config/binds.php');
        $this->route();
    }
    private function route() {
        $message_text = $this->data->object->message->text;
        $peer_id = $this->data->object->message->peer_id;
        if (!in_array(substr($message_text,0,1), ['+','!'])) {
            return;
        }
        /*if (array_key_exists($message_text, $this->binds)) {
            echo 'succ';
        }*/
        if ($message_text === '!расписание') {
            $response = '05.03.2021' . PHP_EOL .
                '1. -' . PHP_EOL .
                '2. ОАиП (лк.) | ауд. 311/1' . PHP_EOL .
                '3. Математика (пр.) | ауд. 8/ст.' . PHP_EOL .
                '4. ЭиЭПП (лк.) | ауд. 320/1' . PHP_EOL .
                '5. Белорусский язык (пр.) | ауд. 405а/2' . PHP_EOL .
                '6. -' . PHP_EOL;
        }
        self::sendMessage($response,$peer_id,$this->token);
    }
    static public function sendMessage($text, $peer_id, $token) {
        $request_params = array(
            'message' => $text,
            'peer_id' => $peer_id,
            'access_token' => $token,
            'v' => '5.130',
            'random_id' => '0'
        );
        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
    }
}