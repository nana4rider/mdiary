$(document).ready(function () {
    var fitWidth = function () {
        var $affix = $('*[data-spy="affix"]');
        $affix.width($affix.parent().width());
    };

    $(window).on('resize', fitWidth);
    fitWidth();
});
