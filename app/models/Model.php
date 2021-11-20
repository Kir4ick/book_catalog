<?php

namespace App\models;

abstract class Model
{
    protected $connect;
    public function __construct($connect)
    {
        $this->connect = $connect;
    }
}