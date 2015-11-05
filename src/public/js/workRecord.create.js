$(function () {
    $('[data-change-form-create]').on('change', function () {
        $('#change-form-submit').trigger('click');
    });

    var $pesticideId = $('#pesticideId');

    $pesticideId.on('change', function () {
        var index = $pesticideId.prop('selectedIndex');
        var pesticide = window['pesticides'][index];
        var $usage = $('#usage');
        var $formGroup = $usage.parents('.form-group');

        $usage.val(pesticide.minimumUsage);
        $formGroup.find('.input-group-addon').text(pesticide.unitName);
    });

    $pesticideId.trigger('change');

    // 農薬追加
    $('#pesticide-form button[type="submit"]').on('ajax.done', function (e, data) {
        console.log(data);
    });
});