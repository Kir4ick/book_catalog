<?php

namespace App\database;
use PDO;
class DB
{
    private $host = '127.0.0.1:3307';
    private $db   = 'studypractic';
    private $user = 'root';
    private $pass = 'root';
    private $charset = 'utf8';
    public $connect = false;

    public function ConnBD(){
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->connect = new PDO($dsn, $this->user, $this->pass, $opt);
        return $this->connect;
    }
}