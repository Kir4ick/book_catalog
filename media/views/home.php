<?php
    $css = 'media/css/index.css';
    $js = 'media/js/header.js';
    require_once 'media/views/build/header.php'
    
?>
    <main>
        <div class="conteiner_main">
            <aside>
                <div class="search_book">
                    <input type="text" class="search_name_book" placeholder="Введите название книжки">
                    <button class="button_search" type="submit">Найти</button>
                </div>
                <div class="reset">
                    <button>Сбросить</button>
                </div>
                <div class="genre">
                    <h1>Авторы</h1>
                    <div class="genre_table">
                    </div>
                </div>
            </aside>
            <section>
                <h2>Список книг</h2>
                <div class="conteiner_content">
                </div>
            </section>
        </div>
    </main>
    <footer></footer>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="media/js/main.js"></script>
</body>
</html>