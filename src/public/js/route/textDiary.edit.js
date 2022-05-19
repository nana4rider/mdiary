$(function () {
    $('#flickr-img').on('click', 'a', function () {
        $(this).parent().remove();
    })
});