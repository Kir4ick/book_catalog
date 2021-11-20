<?php
    if($_SESSION['user']['groups'] ==1 || !$_SESSION['user']){
        header('Location: /');
    }
    $css = '../media/css/admin.css';
    $js = '../media/js/header.js';
    require_once 'media/views/build/header.php';
?>
    <main class="main">
        <section>
            <div class="buttons">
                <button class="users">Пользователи</button>
                <button class="books">Книги</button>
                <button class="authors">Авторы</button>
            </div>
            <div class="content"></div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="../media/js/admin.js"></script>
</body>
</html>