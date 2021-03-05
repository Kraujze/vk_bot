<?php
use App\Config\Config;
use App\Core\Controller;

class Bootstrap {
    /**
     * Config Object
     * @var object
     */
    private $config;

    /**
     * Data json-object
     * @var object
     */
    protected $data;
    public function __construct()
    {
        $this->config = new Config();
        $this->data = json_decode(file_get_contents('php://input'));
    }
    public function start() {
        $event = $this->data->type;
        $this->route($event);
    }
    private function route($event) {
        switch($event) {
            case 'confirmation':
                //echo Config::get('confirmation_token');
                echo $this->config->get('confirmation_token');
                break;
            case 'message_new':
                $controller = new Controller($this->data,$this->config->get('token'));
                echo('ok');
                break;
        }
    }
    static public function test($t) {
        return $t;
    }
}