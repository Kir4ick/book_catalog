<?php

namespace App\models;

class CommentsModel extends Model
{
    public function __construct($connect)
    {
        parent::__construct($connect);
    }

    public function NewComments($data){
        foreach ($data as $datum){
            if(empty($datum)){
                return 'Заполните поле';
            }
        }
        $text = $data['text'];
        $user = $data['user'];
    }
}