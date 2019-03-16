$(document).ready(function () {
    var item_imgs = new Array();
    if (typeof $('.img_swipe') != undefined) {
        $('.img_swipe').each(function (val) {
            var object = {src: $(this).attr('src'), msrc: $(this).attr('src'), w: 0, h: 0};
            item_imgs.push(object);
        });
    }
    $('.add_new_album').off('click').click(function () {
        var url = new URL(location.href);
        var c = url.pathname;
        var type = c.substr(11, (c.length - 11));

        $('.popoup_block .title span').html(languages_consts.NEW_ALBUM);
        var line = '';

        line += '<input type="text" name="login" required placeholder="' + languages_consts.NAME_OF + '">';
        line += '<textarea required placeholder="' + languages_consts.DESCRIPTION + '"></textarea>';
        line += '<div class="send_comment">' + languages_consts.ADD + '</div>';
        $('.popoup_block .body').html(line);

        $('.block_body').fadeIn(300);
        $('.popoup_block').fadeIn(300);

        $('.send_comment').off('click').click(function () {
            var name = $('.popoup_block').find('input').val();
            var description = $('.popoup_block').find('textarea').val();
            $.ajax({
                'url': '/galleries/add-album',
                'method': 'post',
                'dataType': 'json',
                'data': {name: name, description: description, type: type}
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
        });

        $('.popoup_block .close_popoup').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

        $('.popoup_block .button').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

    });
    $('.back_for_block').off('click').click(function () {
        location.href = '/galleries/photo/album?id=' + $(this).data('id');
    });


    $('.add_photo_to_album').off('click').click(function () {
        if ($(this).hasClass('disabled') == false) {
            $('.filePhoto').click();
            $('.filePhoto').change(function () {
                $('.popoup_block .title').remove();
                var line = '<h1 align="center">' + languages_consts.LOADER + '</h1>';
                line += '<img style="width: 250px; display: block; margin: auto" src="/public/images/preloader.gif">';
                $('.popoup_block .body').html(line);
                $('.block_body').fadeIn(300);
                $('.popoup_block').fadeIn(300);
                var max_size = 45000000;
                var this_size = 0;
                $.map(this.files, function (val) {
                    this_size += val.size;
                });
                if (this_size > max_size) {
                    $('.popoup_block .body').html('<h1 align="center">' + languages_consts.LIMIT_IS_EXCEEDED + '</h1>');
                    var timerId = setTimeout(function () {
                        $('.block_body').fadeOut(300);
                        $('.popoup_block').fadeOut(300);
                    }, 2500);
                } else {
                    $(this).parent().submit();
                }
            });
        }
    });

    $('.img_swipe').off('click').click(function () {
        var pswpElement = document.querySelectorAll('.pswp')[0];
        var options = {
            index: $(this).data('nummber'), // start at first slide
            bgOpacity: 0.9,
            allowPanToNext: true,
            history: true,
            closeOnScroll: true,
            timeToIdle: 4000,
            timeToIdleOutside: 1000,
            loadingIndicatorDelay: 1000,
            closeEl: true,
        };

        var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, item_imgs, options);
        gallery.listen('gettingData', function (index, item) {
            if (item.w < 1 || item.h < 1) { // unknown size
                var img = new Image();
                img.onload = function () { // will get size after load
                    item.w = this.width; // set image width
                    item.h = this.height; // set image height
                    gallery.invalidateCurrItems(); // reinit Items
                    gallery.updateSize(true); // reinit Items
                }
                img.src = item.src; // let's download image
            }
        });


        gallery.init();
    });

    $('.search_input').keyup(function () {
        var search_text = $(this).val();
        $('.audio_content .item_audio').each(function (i, val) {
            if ($(val).find('.name_track').attr('title').indexOf(search_text) == -1) {
                $(val).hide();
            } else {
                $(val).show();
            }
        });
    });

    $('.link_site').keyup(function () {
        if ($(this).val().length > 0) {
            $('.add_photo_to_album').addClass('disabled');
        } else {
            $('.add_photo_to_album').removeClass('disabled');
        }
    });

    $('.send_link').off('click').click(function () {
        if ($('.link_site').val().length > 0) {
            $('form').submit();
        }
    });
});

