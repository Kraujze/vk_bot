<?php

use App\Core\Controller;

class MainController extends Controller {

    private $data;
    private $command;
    private static $commands = [];
    private $params = [];

    public function __construct(object $data, string $command, array $params) {
        $this->data = $data;
        $this->command = $command;
        $this->params = $params;
        self::$commands = require(__DIR__.'Commands.php');
        //if ($command = 'лёша') { parent::sendMessage('Лёша не лох, он красава!', $data->peer_id); } else { parent::sendMessage($command, $data->peer_id); }

        foreach (self::$commands as $key => $cmd) {
            if (in_array($command, $cmd['triggers'])) {
                $execute = $cmd;
            } else {
                $execute = 'default';
            }
        }
        $this->$execute();
    }

    public function help() {
        echo 'help';
        parent::sendMessage('Хелп', $this->data->peer_id);
    }
    public function test() {
        parent::sendMessage('Тест', $this->data->peer_id);
    }
    public function default() {
        parent::sendMessage('Дефолт', $this->data->peer_id);
    }
//
}