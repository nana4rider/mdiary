$(function () {
    $('[data-change-form-create]').on('change', function () {
        $('#change-form-submit').trigger('click');
    });

    var $pesticideId = $('#pesticideId');

    $pesticideId.on('change', function () {
        var index = $pesticideId.prop('selectedIndex');
        var pesticide = window['pesticides'][index];
        var $pesticideUsage = $('#pesticideUsage');
        var $formGroup = $pesticideUsage.parents('.form-group');

        $pesticideUsage.val(pesticide['minimumUsage']);
        $formGroup.find('.input-group-addon').text(pesticide['unitName']);
    });

    $pesticideId.trigger('change');

    // 農薬追加
    $(document).on('ajax.done', '#add-pesticide', function (e, data) {
        // テーブルに反映
        $('#pesticide-table > tbody').html(data);
    });

    // 農薬追加
    $(document).on('ajax.done', '.delete-pesticide', function (e, data) {
        // テーブルに反映
        $('#pesticide-table > tbody').html(data);
    });
});