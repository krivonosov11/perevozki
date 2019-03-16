$(document).ready(function () {
    $('.image_info img').off('click').click(function () {
        var input = $(this).parent().find('input');
        $(input).click();
        $(input).change(function () {

        });
    });
});