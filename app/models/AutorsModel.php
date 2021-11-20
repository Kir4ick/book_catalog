<?php

namespace App\models;

class AutorsModel extends Model
{

    //При создании экземпляра, передаём подключение к бд
    public function __construct($connect)
    {
        parent::__construct($connect);
    }
    public function __destruct(){}

    public function NewAutor($data){
        if(empty($data['name'])){
            return 'Заполните поля';
        }
        $name = $data['name'];
        $authDB = $this->connect->query("SELECT * FROM `autors` WHERE `name` = '$name'");
        if (!empty($authDB->fetch())){
            return 'Автор существует';
        }
        $result = $this->connect->prepare("INSERT INTO `autors` (`id`, `name`) VALUES (NULL, :name)");
        $result->execute(['name'=>$name]);
        return 'Yes';
    }

    public function GetAuthorInId($id){
        $result = $this->connect->query("SELECT * FROM `autors` WHERE id = '$id'");
        $listAuthors = $result->fetchAll();
        if(empty($listAuthors)){
            return 'Такого автора нет';
        }
        return $listAuthors;
    }

    public function GetAuthors(){
        $result = $this->connect->query("SELECT * FROM `autors`");
        $listAuthors = $result->fetchAll();
        return $listAuthors;
    }

    public function PutAuthor($id,$data){
        $author = json_decode($data,true);
        $newAuthor = $author['name'];
        If(empty($author['name'])){
            return 'Заполните поля';
        }
        $result = $this->connect->prepare("UPDATE `autors` SET `name` = :newAuthor WHERE `autors`.`id` = :id");
        $result->execute(['newAuthor'=>$newAuthor, 'id'=>$id]);
        return 'yes';
    }

    public function DeleteAuthor($id){
        $result = $this->connect->prepare("DELETE FROM `autors` WHERE `autors`.`id` = :id");
        $result = $result->execute(['id'=>$id]);
        return $result;
    }
}