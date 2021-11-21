$(document).ready(function () {

    $.ajax({
        method: "GET",
        url: "/get/authors",
        success: function (response) {
            for (const element of response) {
                $('.genre_table').append(`<button onclick="SerchAuthor('${element.name}')" >${element.name}</button>`);
            }
        }
    });

    $.ajax({
        method: "GET",
        url: "/get/books",
        success: function (response) {
            for (const element of response) {
                $('.conteiner_content').append(`
                <div onclick="GetPageBooks(${element.id})" class="content_block">
                    <img src="${element.illustration}" alt="">
                    <h3>Название</h3>
                    <h3>${element.name_book}</h3>
                    <p>Автор(ы)</p>
                    <p>${element.authors_book}</p>
                    <p>Год выпуска: ${element.year}</p>
                </div>
                `);
            }
        }
    });

    $('.reset').click(() => {
        $('.content_block').remove();
        $('.conteiner_content h1').remove();
        $.ajax({
            method: "GET",
            url: "/get/books",
            success: function (response) {
                for (const element of response) {
                    $('.conteiner_content').append(`
                    <div onclick="GetPageBooks(${element.id})" class="content_block">
                        <img src="${element.illustration}" alt="">
                        <h3>Название</h3>
                        <h3>${element.name_book}</h3>
                        <p>Автор(ы)</p>
                        <p>${element.authors_book}</p>
                        <p>Год выпуска: ${element.year}</p>
                    </div>
                    `);
                }
            }
        });
    });

    $('.button_search').click(function (e) {
        let name = $('.search_name_book').val(); 
        $('.content_block').remove();
        $('.conteiner_content h1').remove();
        $.ajax({
            method: "GET",
            url: "/get/booksName/"+name,
            success: function (response) {
                        if(response.error){
                            $('.conteiner_content').append(`<h1>Такой книги нет</h1>`);
                        }else{
                            for (const element of response) {
                                $('.conteiner_content').append(`
                                <div onclick="GetPageBooks(${element.id})" class="content_block">
                                    <img src="${element.illustration}" alt="">
                                    <h3>Название</h3>
                                    <h3>${element.name_book}</h3>
                                    <p>Автор(ы)</p>
                                    <p>${element.authors_book}</p>
                                    <p>Год выпуска: ${element.year}</p>
                                </div>
                                `);
                            }       
                        }        
                }
            });
    });

});


async function GetPageBooks(id){
    location.href = '/book/page/'+id;
}

async function SerchAuthor(name){
    $('.content_block').remove();
    $('.conteiner_content h1').remove();
    $.ajax({
        method: "GET",
        url: "/get/booksinauthor/"+ name,
        success: function (response) {
            for (const element of response) {
                $('.conteiner_content').append(`
                <div onclick="GetPageBooks(${element.id})" class="content_block">
                    <img src="${element.illustration}" alt="">
                    <h3>Название</h3>
                    <h3>${element.name_book}</h3>
                    <p>Автор(ы)</p>
                    <p>${element.authors_book}</p>
                    <p>Год выпуска: ${element.year}</p>
                </div>
                `);
            }
        }
    });
}