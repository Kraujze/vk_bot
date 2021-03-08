<?php

use App\Core\Controller;

class MainController extends Controller {

    private $data;
    private $command;
    private $params = [];

    public function __construct(object $data, string $command, array $params) {
        $this->data = $data;
        $this->command = $command;
        $this->params = $params;
        if ($command = 'лёша') { parent::sendMessage('Лёша не лох, он красава!', $data->peer_id); } else { parent::sendMessage($command, $data->peer_id); }
    }
//
    public function execute() {

    }
}