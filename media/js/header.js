$(document).ready(function () {
    $('.registracia_user ').click(() => { 
        $('.registr').remove();
        $('.autorize').remove();
        $('.body').append(`
        <div class="registr">
        <h1>Регистрация</h1>
        <form action="/registration/user" onsubmit="return false;" method="post" class="sign_up">
            <input type="text" placeholder="Придумайте логин" name="login" required>
            <input type="email" placeholder="Введите свой email" name="email" required>
            <input type="password" placeholder="Придумайте пароль" name="password" required>
            <button type="submit" onclick="SubMit('sign_up', '/registration/user')" >Зарегестрироваться</button>
        </form>
        <button class="exit" onclick="Delete('registr')" >Закрыть</button>
        </div>
        `);
    });

    $('.login_user').click(() => { 
        $('.registr').remove();
        $('.autorize').remove();
        $('.body').append(`
        <div class="autorize">
        <h1>Авторизация</h1>
        <form action="/login/user" onsubmit="return false;" method="post" class="sign_in">
            <input type="text" name="login" placeholder="Введите логин" required>
            <input type="password" name="password" placeholder="Введите пароль" required>
            <button type="submit" onclick="SubMit('sign_in', '/login/user')"> Войти</button>
        </form>
        <button class="exit" onclick="Delete('autorize')">Закрыть</button>
        </div>
        `);
    });

    $('.exit_user').click(function () { 
        $.ajax({
            method: "GET",
            url: '/exit/user',
            success: location.reload()
        });
    });
});

async function SubMit(selector, url){
    $('.error').remove();
    let data = new FormData($('.'+selector)[0]);
    $.ajax({
        method: "POST",
        url: url,
        data: data,
        processData: false,
        contentType: false,
        success:(response) => {
            window.location.reload();
        }
    });
}

async function Delete(selector){
    $('.'+selector).remove();
}