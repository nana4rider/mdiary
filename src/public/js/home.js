$(function () {
    // お知らせの詳細を表示
    $('.information a.show').on('click', function () {
        var $this = $(this);
        BootstrapDialog.show({
            title: $this.find('.title').text(),
            message: $this.attr('data-message')
        });

        return false;
    });
});