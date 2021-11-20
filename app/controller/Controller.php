<?php

namespace App\controller;

use App\database\DB;

abstract class Controller
{
    protected function ConnectDB(){
        $conn = new DB();
        $connect = $conn->ConnBD();
        return $connect;
    }
    protected function SearchId($data){
        $uri = $data['uri'];
        $id_array = explode('/',$uri);
        $id = $id_array[2];
        return $id;
    }
}