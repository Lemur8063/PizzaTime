<?php

namespace Classes;

use \PDO;

class Db {

    private static $instance;

    private function __construct()
    {
        $config = parse_ini_file("config.ini");
        $this->db_hostname = $config['db_hostname'];
        $this->db_username = $config['db_username'];
        $this->db_password = $config['db_password'];
        $this->db_name = $config['db_name'];

        $this->db= new PDO("mysql:host=".$this->db_hostname.';dbname='.$this->db_name, $this->db_username, $this->db_password);
    }

    public static function getInstance()
    {
        if (! self::$instance) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->db;
    }


    public function clean($value)
    {
        return strip_tags(trim($value));
    }

    public function escape($value)
    {
        return self::getInstance()->real_escape_string($value);
    }

    private function __clone()
    {
    }
    private function __wakeup()
    {
    }
}
