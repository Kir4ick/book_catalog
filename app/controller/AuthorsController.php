<?php

namespace App\controller;

use App\database\DB;
use App\models\AutorsModel;

class AuthorsController extends Controller
{


    public function GetAuthors($data){
        $author = new AutorsModel($this->ConnectDB());
        $listAuthor = $author->GetAuthors();
        http_response_code(200);
        echo json_encode($listAuthor);
        exit();
    }

    public function GetAuthorId($data){
        $author = new AutorsModel($this->ConnectDB());
        $listAuthor = $author->GetAuthorInId($this->SearchId($data));
        http_response_code(200);
        echo json_encode($listAuthor);
        exit();
    }

    public function RegisterAuthor($data,$files){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $author = new AutorsModel($this->ConnectDB());
        $listAuthor = $author->NewAutor($data);
        if($listAuthor != 'Yes'){
            http_response_code(400);
            echo json_encode(['error' => true, 'message' => $listAuthor]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['message'=>'Новый автор успешно создан']);
    }
    public function PutAuthors($data){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $id = $this->SearchId($data);
        $dataAuth = file_get_contents('php://input');
        $auth = new AutorsModel($this->ConnectDB());
        $result = $auth->PutAuthor($id,$dataAuth);
        if($result != 'yes'){
            http_response_code(400);
            echo json_encode(['error' => true, 'message' => $result]);
            exit();
        }
        http_response_code(200);
        echo json_encode('Автор успешно обновлён');
    }
    public function DeleteAuthors($data){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $id = $this->SearchId($data);
        $auth = new AutorsModel($this->ConnectDB());
        $result = $auth->DeleteAuthor($id);
        if($result == false){
            http_response_code(400);
            echo json_encode(['error' => true, 'message' => 'Не удалось удалить автора']);
            exit();
        }
        http_response_code(204);
        echo json_encode('Автор успешно удалён');
    }
}