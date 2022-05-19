$(function () {
    var work = window['work'];
    var toggle = function ($target, use) {
        if (use) {
            $target.removeClass('hidden');
        } else {
            $target.addClass('hidden');
        }
    };

    toggle($('#option-complete'), work.use_complete);
    toggle($('#option-seeding'), work.use_seeding);
    toggle($('#option-pest-control'), work.use_pest_control);

    $('#pesticide_id').on('change', function () {
        var index = $(this).prop('selectedIndex');
        if (index === -1) {
            return;
        }

        var pesticide = window['pesticides'][index];
        var $pesticideUsage = $('#pesticide_usage');
        var $formGroup = $pesticideUsage.parents('.form-group');

        $pesticideUsage.val(pesticide.minimum_usage);
        $formGroup.find('.input-group-addon').text(pesticide.unit.name);
    }).trigger('change');

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