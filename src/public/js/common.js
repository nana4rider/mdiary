/**
 * Localize
 */
$(function () {
    /**
     * datetimepickerの初期設定
     */
    $.extend($.fn.datetimepicker.defaults,
        {dayViewHeaderFormat: "YYYY年 MMMM"}
    );

    BootstrapDialog.DEFAULT_TEXTS['CANCEL'] = 'キャンセル';
    BootstrapDialog.DEFAULT_TEXTS['CONFIRM'] = '確認';
});

/**
 * Laravel Form
 */
$(function () {
    var stop = false;
    var $button = null;
    var buttonMethod = null;

    $(document).on('submit', 'form', function (e) {
        var $form = $(this);

        if (buttonMethod === 'get'
            || (buttonMethod === null && $form.prop('method') === 'get')) {
            // トークンとメソッド送信を無効化
            $form.children('input[name="_token"]').attr('disabled', true);
        }

        /*
         * メソッドをボタン毎に切り替え
         * <button data-method="PUT">Update</button>
         */
        if (buttonMethod === 'post' || buttonMethod === 'get') {
            $form.prop('method', buttonMethod.toUpperCase());
            $form.children('input[name="_method"]').attr('disabled', true);
        } else if (buttonMethod === 'put' || buttonMethod === 'delete') {
            $form.prop('method', 'POST');
            var $_method = $form.children('input[name="_method"]');

            if ($_method.length === 0) {
                $_method = $('<input type="hidden" name="_method">');
                $form.append($_method);
            }

            $_method.val(buttonMethod.toUpperCase());
        }

        // 二重送信防止
        if (stop) {
            // 送信ボタンを無効化
            e.preventDefault();
            return;
        } else {
            stop = true;
        }

        var ajaxDataType = $button.data('ajax');
        if (ajaxDataType === undefined) {
            return;
        }

        $.ajax({
            type: $form.prop('method'),
            url: $button.attr('formaction') || $form.prop('action'),
            data: $form.serialize(),
            dataType: ajaxDataType,
            timeout: 30000
        }).done(function (data) {
            // エラーをリセット
            $form.trigger('ajax.resetError');
            // カスタムイベントを呼び出し
            $button.trigger('ajax.done', data);
        }).fail(function (xhr) {
            if (xhr.status === 422) {
                var data = JSON.parse(xhr.responseText);
                // エラーをリセット
                $form.trigger('ajax.resetError');
                // バリデーションエラー
                Object.keys(data).forEach(function (key) {
                    var $formGroup = $('#' + key).parents('.form-group').addClass('has-error');
                    var $errorBlock = $('<p>').addClass('help-block ajax-error').text(data[key][0]);
                    // 既存のヘルプを隠す
                    $formGroup.find('.help-block').addClass('hidden');
                    // エラーメッセージを追加
                    $formGroup.append($errorBlock);
                });
            }
            // カスタムイベントを呼び出し
            $button.trigger('ajax.fail', xhr);
        }).always(function () {
            // 送信ボタンを有効化
            stop = false;
        });

        // 送信ボタンを無効化
        e.preventDefault();
    });

    $(document).on('click', 'button[type="submit"]', function (e) {
        $button = $(this);
        var m = $(this).data('method');

        if (m === undefined) {
            buttonMethod = null;
        } else {
            buttonMethod = m.toLowerCase();
        }
    });

    /**
     * Ajaxフォームを元の状態に戻す
     */
    $(document).on('ajax.resetError', 'form', function () {
        $(this).find('.form-group.has-error').removeClass('has-error');
        $(this).find('.help-block.hidden').removeClass('hidden');
        $(this).find('.help-block.ajax-error').remove();
    });
});

/**
 * HTML要素のUI変更
 */
$(function () {
    if ($.browser.android || $.browser.iphone || $.browser.ipad) {
        $('select').css('visibility', 'visible');
    } else {
        /**
         * セレクトボックスのUI変更
         */
        $('select').each(function () {
            $(this).selectpicker({
                style: 'btn-default',
                size: 5
            });
        });
    }

    /**
     * ファイルアップロードのUI変更
     */
    $('input[type="file"]').hide().each(function () {
        var $file = $(this);

        var $button = $('<span class="input-group-addon">' +
            '<span class="glyphicon glyphicon-folder-open"></span>' +
            '</span>').on('click', function () {
            $file.trigger('click');
        });

        var $textBox = $('<input type="text" class="form-control">')
            .prop('placeholder', $file.prop('placeholder') || 'select file...')
            .attr('readonly', true)
            .on('click', function () {
                $file.trigger('click');
            });

        $file.after($('<div class="input-group file">').append($textBox).append($button));

        $file.on('change', function () {
            $textBox.val(Array.prototype.map.call($file.prop('files'), function (file) {
                return file.name;
            }).join(', '));
        });
    });

    /**
     * 日付選択
     */
    $('input[type="datetime-local"]').each(function () {
        var format = 'YYYY/MM/DD HH:mm';
        var w3cFormat = 'YYYY-MM-DD[T]HH:mm';

        if ($(this).val() === '') {
            // 初期値
            $(this).val(moment().format(w3cFormat));
        }

        if ($.browser.android || $.browser.iphone || $.browser.ipad) {
            return;
        }

        var name = $(this).prop('name');

        // 表示用
        $(this).prop('type', 'text').removeAttr('name').datetimepicker({
            locale: 'ja',
            format: format
        });

        // 送信用
        var $send = $('<input type="hidden">').attr('name', name);
        $(this).after($send);

        $(this).on("dp.change", function () {
            $send.val(moment($(this).val(), format).format(w3cFormat));
        }).trigger('dp.change');
    });
});

$(function () {
    /**
     * テキスト表示ダイアログ
     */
    $('[data-dialog-message]').on('click', function (e) {
        e.preventDefault();

        BootstrapDialog.show({
            title: $(this).attr('title'),
            message: $(this).data('dialog-message')
        });
    });

    var showContentDialog = function (title, $content) {
        var $temp = $content.children();
        var $dialogBody = $('<div>').append($temp);

        var buttons = [];
        $dialogBody.find('form > .btn').each(function () {
            var $button = $(this);

            buttons.push({
                label: $button.text(),
                cssClass: $button.attr('class'),
                action: function () {
                    $button.trigger('click');
                }
            });
        });

        BootstrapDialog.show({
            title: title,
            message: $dialogBody,
            buttons: buttons,
            onhide: function () {
                $content.append($temp);
                $content.find('form').trigger('ajax.resetError');
            }
        });
    };

    /**
     * HTML表示ダイアログ(リンク)
     */
    $('[data-dialog-content]').on('click', function (e) {
        e.preventDefault();

        var $content = $($(this).data('dialog-content'));

        showContentDialog($(this).attr('title'), $content);
    });

    /**
     * HTML表示ダイアログ(初期表示)
     */
    $('[data-dialog-onload]').each(function () {
        showContentDialog($(this).attr('title'), $(this));
    });

    /**
     * 確認ダイアログ
     */
    $('[data-confirm]').each(function () {
        var $element = $(this);
        var confirm = false;

        $element.on('click', function (e) {
            if (confirm || $element.data('confirm-disabled') !== undefined) {
                confirm = false;
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            var options = {
                message: $element.data('confirm'),
                callback: function (result) {
                    if (result) {
                        confirm = true;
                        $element.trigger('click');
                    }
                }
            };

            var type = $element.data('dialog-type');
            if (type !== undefined) {
                options['type'] = BootstrapDialog['TYPE_' + type.toUpperCase()];
            }

            BootstrapDialog.confirm(options);
        });
    });
});
