<?php

namespace App\models;

class UserModel extends Model
{

    //При создании экземпляра, передаём подключение к бд
    public function __construct($connect)
    {
        parent::__construct($connect);
    }

    public function __destruct(){}
    //Создание пользователя
    public function Create($data){
        if(empty($data['email'])){
            return 'Заполните все строки';
        }
        if(empty($data['login'])){
            return 'Заполните все строки';
        }
        if(empty($data['password'])){
            return 'Заполните все строки';
        }
        $email = $data['email'];
        $login = $data['login'];
        $password = md5($data['password']);
        $usersDB = $this->connect->query("SELECT * FROM `users` WHERE `login` = '$login' AND `email` = '$email'");
        if (!empty($usersDB->fetch())){
            return 'Пользователь существует';
        }
        $date_registr = date('Y-m-d H:i:s');
        $result = $this->connect->prepare("INSERT INTO `users` 
        (`id`, `email`, `login`, `password`, `groups`, `date_registration`) VALUES (NULL, :email, :login, :password, :groups, :date_registr)");
        $result->execute(['email'=>$email,'login'=>$login,'password'=>$password, 'groups'=>1 ,'date_registr'=>$date_registr]);
        return 'yes';
    }
    //Ищем пользователя
    public function GetUsers()
    {
        $users = $this->connect->query("SELECT * FROM `users`");
        $listUser = $users->fetchAll();
        return $listUser;
    }
    //Ищем по айди
    public function GetUserId($id)
    {
        $users = $this->connect->query("SELECT * FROM `users` WHERE id = $id");
        $listUser = $users->fetch();
        return $listUser;
    }
    //Обновляем
    public function PutUser($id,$data){
        $userInfo = json_decode($data,true);
        $groups = $userInfo['groups'];
        $result = $this->connect->prepare("UPDATE `users` SET `groups` = :groups WHERE `users`.`id` = :id");
        $result = $result->execute(['groups'=>$groups, 'id'=>$id]);
        return $result;
    }
    //Удаляем пользователя
    public function DeleteUser($id){
        $result = $this->connect->prepare("DELETE FROM `users` WHERE `users`.`id` = :id");
        $result = $result->execute(['id'=>$id]);
        return $result;
    }
    //Логиним пользователя
    public function LoginUser($data){
        if(empty($data['login'])){
            return 'Введите логин';
        }
        if(empty($data['password'])) {
            return 'Введите пароль';
        }
        $login = $data['login'];
        $password = md5($data['password']);
        $usersDB = $this->connect->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
        $user = $usersDB->fetch();
        if (empty($user)){
            return 'Такого пользователя не существует';
        }
        return $user;
    }
}