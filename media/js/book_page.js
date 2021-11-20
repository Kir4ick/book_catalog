$(document).ready(function () {
    let url = location.href;
    let id = url.split('/');
    id = id[5];
    $.ajax({
        method: "GET",
        url: "/get/booksId/"+id,
        success: function (response) {
            for (const element of response) {
                $('.main_conteiner').append(`
                <div class="content">
                <img src="../../${element.illustration}" alt="">
                    <div class="content_text">
                        <h1>Название: ${element.name_book}</h1>
                        <h2>Автор(ы) ${element.authors_book}</h2>
                        <h4>Год написания: ${element.year}</h4>
                        <h3>Описание:</h3>
                        <p>${element.description}</p>
                    </div>
                </div>
                `);
            }
        }
    });
});