$(function () {
    // 候補値を更新
    var updateSelection = function ($target, dataArray) {
        var val = $target.val();
        $target.children().remove();

        dataArray.forEach(function (data) {
            $target.append($('<option>').val(data.id).text(data.name));
        });

        $target.val(val);
        if ($target.val() === null && !$target.prop('multiple')) {
            $target.prop('selectedIndex', 0);
        }

        if (!($.browser.android || $.browser.iphone || $.browser.ipad)) {
            $target.selectpicker('refresh');
        }
    };

    // フォーム更新
    $(document).on('ajax.done', '#change-form-submit', function (e, data) {
        // 作業日誌
        updateSelection($('#work_diary_ids'), data.workDiaries);
        // 作業内容
        var $workId = $('#work_id');
        updateSelection($fieldIds, data.works);
        window['works'] = data.works;
        $fieldIds.trigger('change');
        // 品種
        updateSelection($('#cultivar_id'), data.cultivars);
        // 農薬
        var $pesticideId = $('#pesticide_id');
        updateSelection($pesticideId, data.pesticides);
        $('#pesticide-table').find('tbody > tr').remove();
        window['pesticides'] = data.pesticides;
        $pesticideId.trigger('change');
    });

    $('#crop_id').on('change', function () {
        $('#change-form-submit').trigger('click');
    });

    $('#work_id').on('change', function () {
        var index = $(this).prop('selectedIndex');
        if (index === -1) {
            return;
        }

        var work = window['works'][index];
        var toggle = function ($target, use) {
            if (use) {
                $target.removeClass('hidden');
            } else {
                $target.addClass('hidden');
            }
        }

        toggle($('#option-complete'), work.use_complete);
        toggle($('#option-seeding'), work.use_seeding);
        toggle($('#option-pest-control'), work.use_pest_control);
    }).trigger('change');

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