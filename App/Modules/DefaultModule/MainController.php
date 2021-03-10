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
        self::$commands = require(__DIR__.'/'.'Commands.php');
        foreach (self::$commands as $key => $cmd) {
            echo $key.PHP_EOL;
            if (in_array($command, $cmd['triggers'])) {
                $execute = $key;
                break;
            } else {
                $execute = 'default';
            }
        }
        $this->$execute();
        //if ($execute = 'help') {$this->help();}
    }

    public function help() {
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