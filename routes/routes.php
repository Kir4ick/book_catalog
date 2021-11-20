<?php
    use App\Router\Router;
    use App\controller\UserController;
    use App\controller\BooksController;
    use App\controller\AuthorsController;

    //Роуты для html страниц
    Router::Route('/','home');
    Router::Route('/book/page/'.SetId($_GET),'book_page');
    Router::Route('/admin','admin_panel');

    //Роуты для работы с пользователями
    Router::Action('/get/users','GET',
        UserController::class, 'GetUsers', false);
    Router::Action('/get/users/'.SetId($_GET),'GET',
        UserController::class, 'GetUserID', false);
    Router::Action('/registration/user','POST',
        UserController::class, 'RegistrationUser', false);
    Router::Action('/put/user/'.SetId($_GET),'PUT',
        UserController::class, 'PutUser', false);
    Router::Action('/delete/user/'.SetId($_GET),'DELETE',
        UserController::class, 'DeleteUser', false);
    Router::Action('/login/user','POST',
        UserController::class, 'LoginUser', false);
    Router::Action('/exit/user','GET',
        UserController::class, 'ExitUser', false);

    //Роуты для работы с книгами
    Router::Action('/new/book','POST',
        BooksController::class, 'NewBooks', true);
    Router::Action('/get/books','GET',
        BooksController::class, 'GetBooks', false);
    Router::Action('/get/booksName/'.SetId($_GET),'GET',
        BooksController::class, 'GetBooksByName', false);
    Router::Action('/get/booksId/'.SetId($_GET),'GET',
        BooksController::class, 'GetBooksById', false);
    Router::Action('/put/books/'.SetId($_GET),'PUT',
        BooksController::class, 'PutBooks', false);
    Router::Action('/delete/books/'.SetId($_GET),'DELETE',
        BooksController::class, 'DeleteBooks', false);
    Router::Action('/new/authbooks/'.SetId($_GET),'PUT',
        BooksController::class, 'NewAuthBook', false);
    Router::Action('/get/booksinauthor/'.SetId($_GET),'GET',
    BooksController::class, 'GetBookInAuthorName', false);

    //Роуты для работы с авторами
    Router::Action('/get/authors','GET',
        AuthorsController::class, 'GetAuthors', false);
    Router::Action('/get/authors/'.SetId($_GET),'GET',
        AuthorsController::class, 'GetAuthorId', false);
    Router::Action('/new/authors','POST',
        AuthorsController::class, 'RegisterAuthor', false);
    Router::Action('/put/authors/'.SetId($_GET),'PUT',
        AuthorsController::class, 'PutAuthors', false);
    Router::Action('/delete/authors/'.SetId($_GET), 'PUT',
        AuthorsController::class, 'DeleteAuthors', false);

    //Роуты для рабо


    Router::En();

    function SetId($data){
        $id = $data['uri'];
        $id = explode('/',$id);
        $userId = $id[2];
        return $userId;
    }