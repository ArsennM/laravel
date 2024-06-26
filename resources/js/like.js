// JavaScript код для кнопки Like
$(document).ready(function() {
    $('.like-btn').click(function() {
        var postId = $(this).data('post-id'); // Получаем ID поста из атрибута data
        var likeButton = $(this); // Сохраняем ссылку на кнопку лайка

        // Отправляем асинхронный POST запрос на сервер
        $.ajax({
            url: '/like/' + postId, // URL, по которому отправляется запрос
            method: 'POST', // Метод запроса
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Заголовок с CSRF токеном
            },
            success: function(response) { // Функция, вызываемая при успешном ответе от сервера
                // Если лайк успешно поставлен, изменяем иконку кнопки
                if (response.liked) {
                    likeButton.find('i').removeClass('fa-heart-o').addClass('fa-heart');
                } else { // Если лайк успешно убран, изменяем иконку кнопки обратно
                    likeButton.find('i').removeClass('fa-heart').addClass('fa-heart-o');
                }
            },
            error: function(xhr, status, error) { // Функция, вызываемая в случае ошибки запроса
                console.error(error); // Выводим ошибку в консоль браузера
            }
        });
    });
});
