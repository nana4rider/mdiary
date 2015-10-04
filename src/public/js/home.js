$(function () {
    // お知らせの詳細を表示
    $('a[data-information]').on('click', function () {
        var data = $(this).data('information');
        BootstrapDialog.show({
            title: data.title,
            message: data.message
        });

        return false;
    });
});