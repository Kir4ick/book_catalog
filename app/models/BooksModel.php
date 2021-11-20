<?php

namespace App\models;

class BooksModel extends Model
{

    //При создании экземпляра, передаём подключение к бд
    public function __construct($connect)
    {
        parent::__construct($connect);
    }

    public function __destruct(){}

    //Функция для записи новой книги
    public function NewBook($data, $file_data){
        foreach ($data as $userdata){
            if (empty($userdata)){
                return 'Поля не заполнены';
            }
        }
        $name_autors = $data['autors'];
        $name_book = $data['name_book'];
        $description = $data['description'];
        $year = $data['year'];

        $illustration = 'illustrations_book/'.time().$file_data['illustrastion']['name'];
        if(!move_uploaded_file($file_data['illustrastion']['tmp_name'],$illustration)){
            return 'Не удалось фотографию загрузить';
        }

        $result = $this->connect->prepare("INSERT INTO `books` (`id`, `name_book`, `illustration`, `description`, `year`)
        VALUES (NULL, :name_book, :illustration, :description, :year)");
        $result = $result->execute(['name_book'=>$name_book,'illustration'=>$illustration,'description'=>$description,'year'=>$year]);
        if($result == false){
            return 'Ошибка данных для книг';
        }

        $result = $this->connect->query("SELECT `id` FROM `autors` WHERE `name` = '$name_autors'");
        if(empty($result->fetchAll())){
            $result = $this->connect->prepare("INSERT INTO `autors` (`id`, `name`) VALUES (NULL, :name_autors)");
            $result->execute(['name_autors'=>$name_autors]);
        }

        $autor = $this->connect->query("SELECT `id` FROM `autors` WHERE `name` = '$name_autors'");
        $book = $this->connect->query("SELECT `id` FROM `books` WHERE `name_book` = '$name_book'");

        $author_id = $autor->fetch();
        $book_id = $book->fetch();
        $autor_id = $author_id['id'];
        $book_id = $book_id['id'];

        $result = $this->connect->prepare("INSERT INTO `book` (`id_autors`, `id_book`) VALUES (:author_id, :book_id)");
        $result = $result->execute(['author_id'=>$autor_id,'book_id'=>$book_id]);
        if($result == false){
            return 'Ошибка данных для авторов';
        }
        return 'yes';
    }
    //Функция для вывода всех книг
    public function GetBooks(){
        $books = $this->connect->query("SELECT books.*, GROUP_CONCAT(autors.name) AS authors_book FROM books 
    JOIN book ON books.id = book.id_book JOIN autors ON autors.id = book.id_autors GROUP BY books.id");
        $listBooks = $books->fetchAll();
        return $listBooks;
    }

    public function GetBooksByName($name)
    {
        $books = $this->connect->query("SELECT books.*, GROUP_CONCAT(autors.name) AS authors_book 
        FROM books JOIN book ON books.id = book.id_book AND books.name_book = '$name'
        JOIN autors ON autors.id = book.id_autors GROUP BY books.id");
        $listBooks = $books->fetchAll();
        if(empty($listBooks)){
            return 'Такой книги нет';
        }
       return $listBooks;
    }

    public function GetBooksById($id)
    {
        $books = $this->connect->query("SELECT books.*, GROUP_CONCAT(autors.name) AS authors_book 
        FROM books JOIN book ON books.id = book.id_book AND books.id = '$id'
        JOIN autors ON autors.id = book.id_autors GROUP BY books.id");
        $listBooks = $books->fetchAll();
        if(empty($listBooks)){
            return 'Такой книги нет';
        }
        return $listBooks;
    }

    public function PutBooks($id, $data){
        $name_book = $data['name_book'];
        $description = $data['description'];
        $year = $data['year'];
        $result = $this->connect->prepare("UPDATE `books` SET name_book = :name_book, description = :description, year = :year WHERE id = :id");
        $result = $result->execute(['name_book'=>$name_book, 'description'=>$description, 'year'=>$year, 'id'=>$id]);
        return $result;
    }

    public function DeleteBooks($id){
        $result = $this->connect->prepare("DELETE FROM `books` WHERE `books`.`id` = :id");
        $result = $result->execute(['id'=>$id]);
        return $result;
    }

    public function NewAuthor($id,$data){
        $data_auth = json_decode($data,true);
        $name_author = $data_auth['author'];

        $result = $this->connect->query("SELECT `id` FROM `autors` WHERE `name` = '$name_author'");
        if(empty($result->fetchAll())){
            $result = $this->connect->prepare("INSERT INTO `autors` (`id`, `name`) VALUES (NULL, :name_autors)");
            $result->execute([':name_autors'=>$name_author]);
        }

        $autor = $this->connect->query("SELECT `id` FROM `autors` WHERE `name` = '$name_author'");
        $author_id = $autor->fetch();
        $autor_id = $author_id['id'];

        $result = $this->connect->prepare("INSERT INTO `book` (`id_autors`, `id_book`) VALUES (:author_id, :book_id)");
        $result = $result->execute([':author_id'=>$autor_id,':book_id'=>$id]);
        return $result;
    }

    public function GetBooksByAuthorName($name){
        $books = $this->connect->query("SELECT books.*, GROUP_CONCAT(autors.name) AS authors_book 
        FROM books JOIN book ON books.id = book.id_book 
        JOIN autors ON autors.id = book.id_autors AND autors.name = '$name' GROUP BY books.id");
        $listBooks = $books->fetchAll();
        if(empty($listBooks)){
            return false;
        }
        return $listBooks;
    }

}