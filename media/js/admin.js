$(document).ready(function () {
    $('.users').click( () => { 
        $('.content_block').remove();
        $.ajax({
            method: "GET",
            url: "/get/users",
            success: function (response) {
                $('.form_book').remove();
                GetUsers(response);
            }
        }
        );
    });

    $('.books').click( () => {
        $('.content_block').remove();
        $.ajax({
            method: "GET",
            url: "/get/books",
            success: function (response) {
                $('.form_book').remove();
               GetBooks(response);
            }
        });
    });

    $('.authors').click( () => {
        $('.content_block').remove();
        $.ajax({
            method: "GET",
            url: "/get/authors",
            success: function (response) {
                $('.form_book').remove();
               GetAuthor(response);
            }
        });
    });

    $('.exit').click(()=>{ 
        location.reload();
        $.ajax({
            type: "GET",
            url: "/exit/user",
        });
        
    });
});

//Работа с пользователями
async function DeleteUser(id){
    $.ajax({
        method: "DELETE",
        url: "/delete/user/"+id,
        success: function () {
            $('.content_block').remove();
            $.ajax({
                method: 'GET',
                url: "/get/users",
            }).then((response) => {
                GetUsers(response);
            });
        }
    });
}

async function PutAdmin(id){
    let groups = {groups:2};
    $.ajax({
        method: "PUT",
        url: "/put/user/"+id,
        data: JSON.stringify(groups),
        success: function () {
            $('.content_block').remove();
            $.ajax({
                method: 'GET',
                url: "/get/users",
            }).then((response) => {
                GetUsers(response);
            });
        }
    });
}

async function DelAdmin(id){
    let groups = {groups:1};
    $.ajax({
        method: "PUT",
        url: "/put/user/"+id,
        data: JSON.stringify(groups),
        success: function () {
            $('.content_block').remove();
            $.ajax({
                method: 'GET',
                url: "/get/users",
            }).then((response) => {
                GetUsers(response);
            });
        }
    });
}

function GetUsers(response){
    for (let element of response) {
        $('.content').append(`
        <div class="content_block" >
            <h3>Login: ${element.login}</h3>
            <h3>E-mail: ${element.email}</h3>
            <h3>Groups: ${element.groups}</h3>
            <h3>Date: ${element.date_registration}</h3>
            <button class="DELETE_user" onclick="DeleteUser(${element.id})">Удалить</button>
            <button class="PUT_user" onclick="PutAdmin(${element.id})">Дать админские права</button>
            <button class="PUT_user" onclick="DelAdmin(${element.id})">Удалить админские права</button>
        </div>
    `);
    }
}
//Работа с книгами
async function DeleteBooks(id){
    $.ajax({
        method: "DELETE",
        url: "/delete/books/"+id,
        success: function () {
            $('.content_block').remove();
            $.ajax({
                method: 'GET',
                url: "/get/books",
            }).then((response) => {
                GetBooks(response);
            });
        }
    });
}

function GetBooks(response){
    $('.new_booksss').remove();
    $('.content_block').remove();
    $('.form_book').remove();
    for (let element of response) {
        $('.content').append(`
        <div class="content_block">
        <img class="table_img" src="${element.illustration}">
        <h3>${element.name_book}</h3>
        <p>${element.year}</p>
        <h5>${element.authors_book}</h5>
        <button class="DELETE_books" onclick="DeleteBooks(${element.id})">Удалить</button>
        <button class="PUT_books" onclick="GetInfoBooks(${element.id},'${element.name_book}','${element.description.replace(/\s/g, '')}','${element.year}')">Изменить</button>
        <button class="PUT_authors" onclick="NewAuthorBooks(${element.id},'${element.name_book}')">Добавить автора</button>
        </div>
    `);
    }
    $('.main').append(`
    <div class="form_book">
    <form action="/new/book" class='new_booksss' onsubmit="return false" name="new_book" enctype="multipart/form-data">
    <input placeholder="Название книги" class="name_book" type="text" name="name_book">
    <div>
    <p>Обложка книги</p>
    <input placeholder="Обложка книги" class="illustration" type="file" name="illustrastion">
    </div>
    <input placeholder="Автор книги" class="authors_book" type="text" name="autors">
    <textarea placeholder="Описание книги" class="description" name="description" cols="30" rows="10"></textarea>
    <div>
    <p>Дата написания книги</p>
    <input placeholder="Дата написания книги" type="date" name="year">
    </div>
    <button class="dob_book" type="submit" onclick=" NewBook()">Добавить Книгу</button>
    </form>
    </div>
    `);
}
async function GetInfoBooks(id, name_book, description, year){
    $('.new_booksss').remove();
    $('.main').append(`
    <div class="new_booksss">
    <div>
    <p>Название книги</p>
    <input class="name_book" type="text" placeholder="Введите имя автора" value="${name_book}">
    </div>
    <textarea class="description" name="description" cols="30" rows="10"></textarea>
    <div>
    <p>Время написания</p>
    <input class="year" type="date" placeholder="Введите имя автора" value="${year}">
    </div>
    <button onclick="Put_books(${id})">Изменить</button>
    </div>
    `)
    $('.description').val(description);
}

async function Put_books(id){
    let name_book = $('.name_book').val();
    let description = $('.description').val();
    let year = $('.year').val();
    let data = {name_book: name_book, description:description,year:year };
    $.ajax({
        method: "PUT",
        url: "/put/books/"+id,
        data: JSON.stringify(data),
        success: function () {
            $.ajax({
                method: "GET",
                url: "/get/books",
                success: function (response) {
                    GetBooks(response);
                }
            });
        }
    });
}

async function NewBook(){
    let data = new FormData($('.new_booksss')[0]);
    console.log(data);
    $.ajax({
        type: "POST",
        url: "/new/book",
        data: data,
        processData: false,
        contentType: false,
        success: function (response) {
            $('.content_block').remove();
            $.ajax({
                method: "GET",
                url: "/get/books",
                success: function (response) {
                   GetBooks(response);
                }
            });
        }
    });
    
}

async function NewAuthorBooks(id, name_book){
    $('.form_book').remove();
    $('.main').append(`
    <div class="content_block">
    <form action="/delete/authors/${id}" class='new_auth_books' onsubmit="return false" name="new_auth_books" enctype="multipart/form-data">
    <h1>${name_book}</h1>
    <input class="author" type="text" name="author">
    <button class="dob_auth" type="submit" onclick="PutAuth(${id})">Добавить Автора</button>
    </form>
    </div>
    `);
}

async function PutAuth(id){
    let auth_name = $('.author').val();
    let data = {author: auth_name}
    data = JSON.stringify(data);
    $.ajax({
        type: "PUT",
        url: "/new/authbooks/"+id,
        data: data,
        success: function (response) {
            $('.content_block').remove();
        }
    });
    $('.content_block').remove();
        $.ajax({
            method: "GET",
            url: "/get/books",
            success: function (response) {
                $('.form_book').remove();
               GetBooks(response);
            }
        });
}

//Работа с авторами

async function DeleteAuthor(id){
    $.ajax({
        method: "DELETE",
        url: "/delete/authors/"+id,
        success: function () {
            $('.content_block').remove();
            $.ajax({
                method: 'GET',
                url: "/get/authors",
            }).then((response) => {
                GetAuthor(response);
            });
        }
    });
}

async function PutAuthor(id){
    let data = $('.name_author').val();
    let name = {name: data};
    console.log(name);
    $.ajax({
        method: "PUT",
        url: "/put/authors/"+id,
        data: JSON.stringify(name),
        success: function () {
            $.ajax({
                method: "GET",
                url: "/get/authors",
                success: function (response) {
                    $('.content_block').remove();
                   GetAuthor(response);
                }
            });
        }
    });
}

function GetAuthor(response){
    $('.new_booksss').remove();
    $('.content_block').remove();
    for (let element of response) {
        $('.content').append(`
        <div class="content_block" id="${element.id}">
        <h1>${element.name}</h1>
        <button class="DELETE_author" onclick="DeleteAuthor(${element.id})">Удалить</button>
        <button class="PUT_author" onclick="GetInfoAuthor(${element.id},'${element.name}')">Изменить</button>
        </div>
    `);
    }
    $('.main').append(`
    <div class=content_block>
    <input placeholder="Введите имя автора" class="name_auth" type="text">
    <button class="dob_auth" type="submit" onclick="NewAuthor()">Добавить автора</button>
    </div>
    `);
}

async function GetInfoAuthor(id, name){
    $('.main').append(`
    <div class="content_block">
    <input class="name_author" type="text" placeholder="Введите имя автора" value="${name}">
    <button onclick="PutAuthor(${id})">Изменить</button>
    </div>
    `)
}

async function NewAuthor(){
    let name = $('.name_auth').val();
    $.post("/new/authors", {name: name},
        function (data) {
            $('.content_block').remove();
        }
    );
    $.ajax({
        method: "GET",
        url: "/get/authors",
        success: function (response) {
           GetAuthor(response);
        }
    });
}
