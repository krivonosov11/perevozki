$(document).ready(function () {
    $('.send_comment').off('click').click(function () {
        var id_news = $(this).data('news_id');
        var text = $(this).parent().find('textarea').val();
        var clas = ($(this).hasClass('forum') ? 'all' : 'news');
        if (text !== '') {
            $.ajax({
                'url': '/' + clas + '/send-comment',
                'method': 'post',
                'dataType': 'json',
                'data': {id_news: id_news, text: text}
            }).always(function (res) {
                var line = '';
                line += '<div class="comment_item">';
                line += '<img src="/public/images/user_photo.png" alt="">';
                line += '<div class="name_user">';
                line += '<h4>' + res.name + '&nbsp;' + res.surname + '</h4>';
                line += '<span>' + res.date_created + '</span>';
                line += '<p class="text">' + res.text + '</p>';
                line += '</div>';
                line += '</div>';
                $('.list_comments').prepend(line);
                $('textarea').val('');
            });
        }
    });

});
