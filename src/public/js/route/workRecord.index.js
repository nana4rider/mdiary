$(function () {
    // フォーム更新
    $(document).on('ajax.done', '#change-form-submit', function (e, data) {
        // 作業内容
        $('#work_ids').updateSelection(data.works);
    });

    $('#crop_id').on('change', function () {
        $('#change-form-submit').trigger('click');
    });
});