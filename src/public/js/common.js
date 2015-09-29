$(function () {
    /*
     * 二重送信防止
     */
    var $forms = $('form');
    $forms.on('submit', function () {
        $forms.on('submit', function () {
            return false;
        });

        return true;
    });

    $('select').wrap('<div></div>').multiselect();
})
;