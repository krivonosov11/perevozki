$(document).ready(function () {
    if ((location.href).indexOf('sending') >= 0) {
        $('.popoup_block .title span').html(languages_consts.INFORMATION);
        var line = '';
        line += '<h1 align="center">' + languages_consts.YOUR_MESSAGE_SENDING + '</h1>';
        $('.popoup_block .body').html(line);

        $('.block_body').fadeIn(300);
        $('.popoup_block').fadeIn(300);

        var x = setTimeout(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        }, 2000);

        $('.popoup_block .close_popoup').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

    }

    $('.header_menu_wrapper .header_options ul.menu > li').off('click').click(function () {
        if (screen.width <= 1024) {
            if ($(this).hasClass('show')) {
                $(this).find('i').css('transform', 'rotate(-360deg)');
                $(this).css('background-color', '#d3a981');
                $(this).removeClass('show')
                $(this).find('.submenu').css('display', 'none !important');
            } else {
                $(this).find('i').css('transform', 'rotate(180deg)');
                $(this).css('background-color', '#4a5a61');
                $(this).addClass('show')
                $(this).find('.submenu').css('display', 'contents')
            }
        }
    });

    $('.logo_text').off('click').click(function () {
        location.href = '/';
    });

    $('.registration').off('click').click(function () {

        $('.popoup_block .title span').html(languages_consts.REGISTRATION);
        var line = '';

        line += '<form action="/auth/registration" method="post">';
        line += '<input type="text" name="name" placeholder="' + languages_consts.NAME + '" required>';
        line += '<input type="text" name="surname" placeholder="' + languages_consts.SURNAME + '" required>';
        line += '<input type="text" name="login" placeholder="' + languages_consts.LOGIN_TEXT + '" required>';
        line += '<input type="password" name="password" placeholder="' + languages_consts.PASSWORD_TEXT + '" required>';
        line += '<input type="submit" value="' + languages_consts.SIGN + '">';
        line += '<div class="button">' + languages_consts.CANCEL + '</div>';
        line += '</form>';
        $('.popoup_block .body').html(line);

        $('.block_body').fadeIn(300);
        $('.popoup_block').fadeIn(300);

        $('.popoup_block .button').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

        $('.popoup_block .close_popoup').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });
    });

    $('.login').off('click').click(function () {
        $('.popoup_block .title span').html(languages_consts.LOGIN);
        var line = '';

        line += '<form action="/auth/login" method="post">';
        line += '<input type="text" name="login" required placeholder="' + languages_consts.LOGIN_TEXT + '">';
        line += '<input type="password" name="password" required placeholder="' + languages_consts.PASSWORD_TEXT + '">';
        line += '<input type="submit" value="' + languages_consts.SIGN + '">';
        line += '<div class="button">' + languages_consts.CANCEL + '</div>';
        line += '</form>';
        $('.popoup_block .body').html(line);

        $('.block_body').fadeIn(300);
        $('.popoup_block').fadeIn(300);

        $('.popoup_block .close_popoup').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

        $('.popoup_block .button').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });
    });


    $('.add_new_post').off('click').click(function () {
        $('.add_post').slideToggle();
    });

    $('.to_up').off('click').click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
    });


    $('.burger_menu').off('click').click(function () {
        if (screen.width <= 1024) {
            $('.menu').fadeIn(200);
            $('.block_body').fadeIn(300);

            $('.block_body').off('click').click(function () {
                $(this).fadeOut(300);
                $('.menu').fadeOut(300);
            });
            $('.close_menu ').off('click').click(function () {
                $('.block_body').fadeOut(300);
                $('.menu').fadeOut(300);
            });


        }

    });


    $('.add_new_parish').off('click').click(function () {

        $('.popoup_block .title span').html(languages_consts.PLEASE_ENTER_INFORMATION);
        var line = '';
        line += '<div class="add_post" style="display: block; border: none;">';
        line += '<form action="/archdiocese/add-new-parish" method="post" enctype="multipart/form-data">';
        line += '<div style="display: inline-block;" class="image_info">';
        line += '<img src="/public/images/image.jpg" alt="" class="img_to_public">';
        line += '<label class="fileContainer">ВЫБРАТЬ ФАЙЛ';
        line += '<input type="file" name="image_url" onchange="previewFile()">';
        line += '</label>';
        line += '</div>';
        line += '<input type="text" name="city" placeholder="' + languages_consts.CITY + '">';
        line += '<input type="text" name="name" placeholder="' + languages_consts.NAME_OF + '">';
        line += '<input type="text" name="parent" placeholder="' + languages_consts.PARENT + '">';
        line += '<textarea name="description" placeholder="' + languages_consts.DESCRIPTION + '"></textarea>';
        line += '<input type="submit" value="' + languages_consts.SEND + '">';
        line += '<div class="button">' + languages_consts.CANCEL + '</div>';
        line += '</form>';
        line += '</div>';
        $('.popoup_block .body').html(line);

        $('.block_body').fadeIn(300);
        $('.popoup_block').fadeIn(300);

        $('.popoup_block .button').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

        $('.popoup_block .close_popoup').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });
    });
    $('.add_new_hor').off('click').click(function () {

        $('.popoup_block .title span').html(languages_consts.PLEASE_ENTER_INFORMATION);
        var line = '';
        line += '<div class="add_post" style="display: block; border: none;">';
        line += '<form action="/archdiocese/add-new-hor" method="post" enctype="multipart/form-data">';
        line += '<div style="display: inline-block;" class="image_info">';
        line += '<img src="/public/images/image.jpg" alt="" class="img_to_public">';
        line += '<label class="fileContainer">ВЫБРАТЬ ФАЙЛ';
        line += '<input type="file" name="image_url" onchange="previewFile()">';
        line += '</label>';
        line += '</div>';
        line += '<input style="margin-top: 10px;" type="text" name="name" placeholder="' + languages_consts.NAME_OF + '">';
        line += '<textarea name="description" placeholder="' + languages_consts.DESCRIPTION + '"></textarea>';
        line += '<input type="submit" value="' + languages_consts.SEND + '">';
        line += '<div class="button">' + languages_consts.CANCEL + '</div>';
        line += '</form>';
        line += '</div>';
        $('.popoup_block .body').html(line);

        $('.block_body').fadeIn(300);
        $('.popoup_block').fadeIn(300);

        $('.popoup_block .button').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

        $('.popoup_block .close_popoup').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });
    });

    $('.add_new_document').off('click').click(function () {
        $('.popoup_block .title span').html(languages_consts.PLEASE_ENTER_INFORMATION);
        var line = '';
        line += '<div class="add_post" style="display: block; border: none;">';
        line += '<form action="/document/add-new-document" method="post" enctype="multipart/form-data">';
        line += '<div style="display: inline-block;" class="image_info">';
        line += '<img src="/public/images/image.jpg" alt="" class="img_to_public">';
        line += '<label class="fileContainer">ВЫБРАТЬ ФАЙЛ';
        line += '<input type="file" name="image_url" onchange="previewFileDoc()">';
        line += '</label>';
        line += '</div>';
        line += '<input style="margin-top: 10px" type="text" id="name_file" name="name" placeholder="' + languages_consts.NAME_OF + '">';
        line += '<input type="hidden" name="block" value="' + block + '">';
        line += '<input type="hidden" id="type" name="type" value="">';
        line += '<input type="submit" value="' + languages_consts.SEND + '">';
        line += '<div class="button">' + languages_consts.CANCEL + '</div>';
        line += '</form>';
        line += '</div>';
        $('.popoup_block .body').html(line);

        $('.block_body').fadeIn(300);
        $('.popoup_block').fadeIn(300);

        $('.popoup_block .button').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

        $('.popoup_block .close_popoup').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });
    });


    $('.add_new_books').off('click').click(function () {
        $('.popoup_block .title span').html(languages_consts.PLEASE_ENTER_INFORMATION);
        var line = '';
        line += '<div class="add_post" style="display: block; border: none;">';
        line += '<form action="/books/add-new-book" method="post" enctype="multipart/form-data">';
        line += '<div style="display: inline-block; cursor: pointer" class="image_info">';
        line += '<img src="/public/images/image.jpg" alt="" class="img_to_public">';
        line += '<label class="fileContainer">ОБЛОЖКА';
        line += '<input type="file" name="image_url" onchange="previewFile()">';
        line += '</label>';
        line += '</div>';
        line += '<div style="display: block; cursor: pointer;" class="image_info">';
        line += '<label class="fileContainer change_book">Выбрать файл';
        line += '<input type="file" name="file_url" onchange="previewDoc()">';
        line += '</label>';
        line += '</div>';
        line += '<input style="margin-top: 20px" type="text" id="name_file" name="name" placeholder="' + languages_consts.NAME_OF + '">';
        line += '<input type="hidden" name="block" value="' + block + '">';
        line += '<input type="hidden" id="type" name="type" value="">';
        line += '<input type="submit" value="' + languages_consts.SEND + '">';
        line += '<div class="button">' + languages_consts.CANCEL + '</div>';
        line += '</form>';
        line += '</div>';
        $('.popoup_block .body').html(line);

        $('.block_body').fadeIn(300);
        $('.popoup_block').fadeIn(300);

        $('.popoup_block .button').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });

        $('.popoup_block .close_popoup').off('click').click(function () {
            $('.block_body').fadeOut(300);
            $('.popoup_block').fadeOut(300);
        });
    });

    $('.done').off('click').click(function () {
        var event = $(this).parent();
        var id = $(this).parent().data('id');
        $.ajax({
            'url': '/all/done-alms',
            'method': 'post',
            'dataType': 'json',
            'data': {id: id}
        }).always(function () {
            event.slideToggle();
        });
    });

    $('.delete').off('click').click(function () {
        var alm = $(this).closest('.item_news');
        var id = $(this).parent().data('id');
        $.ajax({
            'url': '/all/delete-alms',
            'method': 'post',
            'dataType': 'json',
            'data': {id: id}
        }).always(function () {
            alm.slideToggle();
        });
    });
});

window.onscroll = function () {
    var scrolled = window.pageYOffset - 10;
    if (screen.width < 1025) {
        if (scrolled > 300) {
            $('.header_options').css({'position': 'fixed', 'top': '-10px', 'z-index': '5'});
        } else {
            $('.header_options').css({'position': 'absolute', 'top': 'unset', 'z-index': 'unset'});
        }
    }

    if (scrolled > 350) {
        $('.to_up').fadeIn(300);
    } else {
        $('.to_up').fadeOut(300);
    }
}

function previewFile() {
    var preview = document.querySelector('.img_to_public'); //selects the query named img
    var file = document.querySelector('input[type=file]').files[0]; //sames as here
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file); //reads the data as a URL
    } else {
        preview.src = "/public/images/image.jpg";
    }
}


function previewFileDoc() {
    var preview = document.querySelector('.img_to_public'); //selects the query named img
    var file = document.querySelector('input[type=file]').files[0]; //sames as here
    var reader = new FileReader();
    var nameFile = document.getElementById('name_file');
    var typeFile = document.getElementById('type');

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    nameFile.value = file.name;

    if ((file.name).indexOf('.doc') >= 0) {
        typeFile.value = 'word';
        preview.src = "/public/images/word.png";
    } else if ((file.name).indexOf('.pdf') >= 0) {
        typeFile.value = 'pdf';
        preview.src = "/public/images/pdf.png";
    } else {
        typeFile.value = 'def_file';
        preview.src = "/public/images/def_file.png";
    }
}

function previewDoc() {
    var nameFile = document.getElementById('name_file');
    var file = document.querySelector('input[name=file_url]').files[0]; //sames as here

    nameFile.value = file.name;

}