<?php

namespace App\controller;
use App\database\DB;
use App\models\UserModel;



class UserController extends Controller
{

    public function RegistrationUser($data,$d){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(402);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $newUser = new UserModel($this->ConnectDB());
        $created = $newUser->Create($data);
        if ($created == 'Заполните все строки'){
            http_response_code(401);
            echo json_encode(['error'=>true,'message'=>'Заполните все строки']);
            exit();
        }
        if ($created == 'Пользователь существует'){
            http_response_code(400);
            echo json_encode(['error'=>true,'message'=>'Такой пользователь существует']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['message'=>'Пользователь создан']);
        exit();
    }

    public function GetUsers($data){
        $newUser = new UserModel($this->ConnectDB());
        $listUser = $newUser->GetUsers();
        http_response_code(200);
        echo json_encode($listUser);
        exit();
    }

    public function GetUserID($data){
        $userId = $this->SearchId($data);
        $newUser = new UserModel($this->ConnectDB());
        $listUser = $newUser->GetUserId($userId);
        http_response_code(200);
        echo json_encode($listUser);
        exit();
    }

    public function PutUser($data){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $userId = $this->SearchId($data);
        $data = file_get_contents('php://input');
        $newUser = new UserModel($this->ConnectDB());
        $result = $newUser->PutUser($userId,$data);
        if ($result == false){
            http_response_code(400);
            echo json_encode(['error'=>true,'message'=>'Не удалось обновить пользователя']);
            exit();
        }else{
            http_response_code(202);
            $listUser = $newUser->GetUserId($userId);
            echo json_encode($listUser);
            exit();
        }
    }

    public function DeleteUser($data){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $userId = $this->SearchId($data);
        $newUser = new UserModel($this->ConnectDB());
        $result = $newUser->DeleteUser($userId);
        if ($result == false){
            http_response_code(404);
            echo json_encode(['error'=>true,'message'=>'Не удалось удалить пользователя']);
            exit();
        }else{
            http_response_code(204);
            exit();
        }
    }

    public function LoginUser($data){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $user = new UserModel($this->ConnectDB());
        $result = $user->LoginUser($data);
        if($result == false){
            echo json_encode(['error'=>true,'message'=>'При авторизации произошла ошибка']);
            exit();
        }else{
            echo json_encode(['message'=>'Вы успешно зашли']);
            $_SESSION['user'] = $result;
            exit();
        }
    }
    public function ExitUser($data){
        unset($_SESSION['user']);
    }
}