$(function () {
    // フォーム更新
    $(document).on('ajax.done', '#change-form-submit', function (e, data) {
        // 作業日誌
        $('#field_ids').updateSelection(data.workFields);
        // 作業内容
        $('#work_id').updateSelection(data.works);
    });

    $('#crop_id').on('change', function () {
        $('#change-form-submit').trigger('click');
    });
});