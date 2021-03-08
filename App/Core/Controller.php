<?php


namespace App\Core;


class Controller {
    /**
     * Data json-object
     * @var object
     */
    private $data;
    /**
     * @var string
     */
    static private $token;
    /**
     * @var integer
     */
    protected $access = 0;
    /**
     * @var array
     */
    protected $binds;
    /**
     * @var array
     */
    private $settings;

    public function __construct($data, $token)
    {
        $this->data = $data;
        $this->token = $token; define('TOKEN', $this->token);
        $this->binds = require(_ROOT_.'/App/Config/binds.php');

        ###
        if ($data->object->message->from_id == '194301073') {
            $this->access = 1;
        }
        ###

        $this->route();
    }
    private function route() {
        $message_text = $this->data->object->message->text;
        $peer_id = $this->data->object->message->peer_id;

        if (!in_array(substr($message_text,0,1), ['+','!'])) {
            return;
        }

        if (array_key_exists($message_text, $this->binds)) {
            return;
        }

        $arguments = explode(' ',$message_text);
        $command = substr(array_shift($arguments),1);

        if (!($this->access >= $this->binds[$command]['Access'])) {
            return;
        }

        $command_controller_name = $this->binds[$command]['Controller'].'Controller';
        $command_controller_path = _ROOT_.'/App/Modules/'.$this->binds[$command]['Module'].'/'.$command_controller_name.'.php';
        require $command_controller_path;
        $command_controller = new $command_controller_name($this->data->object->message, $command, $arguments);

        /*if ($message_text === '!расписание') {
            $response = '05.03.2021' . PHP_EOL .
                '1. -' . PHP_EOL .
                '2. ОАиП (лк.) | ауд. 311/1' . PHP_EOL .
                '3. Математика (пр.) | ауд. 8/ст.' . PHP_EOL .
                '4. ЭиЭПП (лк.) | ауд. 320/1' . PHP_EOL .
                '5. Белорусский язык (пр.) | ауд. 405а/2' . PHP_EOL .
                '6. -' . PHP_EOL;
        }*/
        $response = '';



        //self::sendMessage($response,$peer_id,$this->token);

    }
    static public function sendMessage($text, $peer_id) {
        $request_params = array(
            'message' => $text,
            'peer_id' => $peer_id,
            'access_token' => TOKEN,
            'v' => '5.130',
            'random_id' => '0'
        );
        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
    }
}