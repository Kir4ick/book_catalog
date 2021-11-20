<?php

namespace App\controller;

use App\database\DB;
use App\models\BooksModel;
use PDO;
class BooksController extends Controller
{

    public function NewBooks($data,$files_data){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $newBook = new BooksModel($this->ConnectDB());
        $result = $newBook->NewBook($data,$files_data);
        if($result != 'yes'){
            http_response_code(400);
            echo json_encode(['error' => true, 'message' => $result]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['message' => 'Новая книга создана']);
        exit();
    }

    public function GetBooks($data){
        $books = new BooksModel($this->ConnectDB());
        $listBooks = $books->GetBooks();
        http_response_code(200);
        echo json_encode($listBooks);
        exit();
    }

    public function GetBooksByName($data){
        $booksName = $this->SearchId($data);
        $books = new BooksModel($this->ConnectDB());
        $books = $books->GetBooksByName($booksName);
        http_response_code(200);
        echo json_encode($books);
        exit();
    }
    public function GetBooksById($data){
        $booksId = $this->SearchId($data);
        $books = new BooksModel($this->ConnectDB());
        $books = $books->GetBooksById($booksId);
        http_response_code(200);
        echo json_encode($books);
        exit();
    }

    public function PutBooks($data){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $books = new BooksModel($this->ConnectDB());
        $dataInput = file_get_contents('php://input');
        $dataInput = json_decode($dataInput,true);
        $id = $this->SearchId($data);
        $result = $books->PutBooks($id,$dataInput);
        if($result==false){
            http_response_code(404);
            echo json_encode(['error'=>true,'message'=>'Ошибка при изменении данных']);
            exit();
        }
        http_response_code(200);
        echo json_encode('Книга успешно обновлена');
    }
    public function DeleteBooks($data){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            http_response_code(405);
            echo json_encode(['error'=>true,'message'=>'Нет информации']);
            exit();
        }
        $books = new BooksModel($this->ConnectDB());
        $id = $this->SearchId($data);
        $result = $books->DeleteBooks($id);
        if ($result == false){
            http_response_code(404);
            echo json_encode(['error'=>true,'message'=>'Не удалось удалить Книгу']);
            exit();
        }else{
            http_response_code(204);
            exit();
        }
    }
    public function NewAuthBook($data){
        $id = $this->SearchId($data);
        $book = new BooksModel($this->ConnectDB());
        $data = file_get_contents('php://input');
        $result = $book->NewAuthor($id,$data);
        if ($result == false){
            http_response_code(404);
            echo json_encode(['error'=>true,'message'=>'Не удалось добавить автора']);
            exit();
        }else{
            http_response_code(200);
            exit();
        }
    }
    public function NewGenre($data){
        $id = $this->SearchId($data);
        $book = new BooksModel($this->ConnectDB());
        $data = file_get_contents('php://input');
        $result = $book->NewGenre($id,$data);
        if ($result == false){
            http_response_code(404);
            echo json_encode(['error'=>true,'message'=>'Не удалось добавить жанр автора']);
            exit();
        }else{
            http_response_code(200);
            exit();
        }
    }
    public function GetBookInAuthorName($data){
        $id = $this->SearchId($data);
        $book = new BooksModel($this->ConnectDB());
        $result = $book->GetBooksByAuthorName($id);
        if ($result == false){
            http_response_code(404);
            echo json_encode(['error'=>true,'message'=>'Нет такой книги']);
            exit();
        }else{
            http_response_code(200);
            echo json_encode($result);
            exit();
        }
    }
}