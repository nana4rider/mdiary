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
        updateSelection($('#field_ids'), data.workFields);
        // 作業内容
        updateSelection($('#work_id'), data.works);
    });

    $('#crop_id').on('change', function () {
        $('#change-form-submit').trigger('click');
    });
});