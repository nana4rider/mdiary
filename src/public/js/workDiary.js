$(function () {
    $('#update-archive').on('change', function () {
        if ($(this).prop('checked')) {
            $('#btn-update').removeData('confirm-disabled');
        } else {
            $('#btn-update').data('confirm-disabled', '');
        }
    });

    $('#btn-update').data('confirm-disabled', '');
});