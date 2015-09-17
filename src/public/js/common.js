$(function () {

    var token = $('meta[name="csrf-token"]').attr('content');

    /*
     * CSRFトークンと擬似メソッドの自動設定
     */
    $('form[data-method]').each(function () {
        var $this = $(this);
        var method = $this.attr('data-method').toUpperCase();

        // method
        $this.prop('method', method === 'GET' ? 'GET' : 'POST');
        // _method
        if (method !== 'GET' && method !== 'POST') {
            $this.append($('<input>').attr('type', 'hidden').attr('name', '_method').val(method));
        }
        // _token
        if (method !== 'GET') {
            $this.append($('<input>').attr('type', 'hidden').attr('name', '_token').val(token));
        }
    });
});