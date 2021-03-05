<?php

namespace App\Config;

class Config {
    /**
     * @var array
     */
    protected $settings;

    public function __construct()
    {
        $this->settings = require('env.php');
    }

    public function get($variable)
    {
       return $this->settings[$variable];
    }
}