<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $css ?>">
    <title>Libraria</title>
</head>
<body class="body">
    <header>
        <div class="conteiner_header">
            <div class="name_page">
                <h1>Libraria</h1>
                <p>Книжный каталог</p>
            </div>
            <?php if(!$_SESSION['user']){?>
            <div class="registr_autoriz">
                <button class="registracia_user">Зарегестрироваться</button>
                <button class="login_user">Авторизоваться</button>
            </div>
            <?php }else{ ?>
            <div class="registr_autoriz">
                <h1><?= $_SESSION['user']['login'] ?></h1>
                <button class="exit_user">Выйти</button>
            </div>
            <?php }?>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="<?= $js ?>"></script>