$(function () {
    $('[data-change-form-create]').on('change', function () {
        $('#change-form-submit').trigger('click');
    });

    var $pesticideId = $('#pesticide_id');

    $pesticideId.on('change', function () {
        var index = $pesticideId.prop('selectedIndex');
        var pesticide = window['pesticides'][index];
        var $pesticideUsage = $('#pesticide_usage');
        var $formGroup = $pesticideUsage.parents('.form-group');

        $pesticideUsage.val(pesticide['minimum_usage']);
        $formGroup.find('.input-group-addon').text(pesticide['unit_name']);
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