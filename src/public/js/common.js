/**
 * 二重送信防止、getメソッド時のトークン削除
 */
$(function () {
    var method = null;

    $(document).on('submit', 'form', function (e) {
        if (method === null) {
            method = $(this).prop('method');
        }

        if (method === 'get') {
            // トークンの送信を無効化
            $(this).find('input[name="_token"]').attr('disabled', true);
        }

        $(document).on('submit', 'form', function (e) {
            // 送信ボタンを無効化
            e.preventDefault();
        });
    });

    $(document).on('click', 'button[type="submit"]', function (e) {
        var m = $(this).attr('formmethod');

        if (m === undefined) {
            method = null;
        } else {
            method = m.toLowerCase();
        }
    });
});

/**
 * HTML要素のUI変更
 */
$(function () {
    /**
     * multiselect日本語化
     */
    $.extend($.fn.multiselect.Constructor.prototype.defaults, {
        selectAllText: ' 全選択',
        filterPlaceholder: '検索',
        nonSelectedText: '未選択',
        nSelectedText: '件選択',
        allSelectedText: '全選択'
    });

    /**
     * セレクトボックスのUI変更
     */
    $('select').wrap('<div></div>').multiselect({
        includeSelectAllOption: true
    });

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
     * datetimepickerの初期設定
     */
    $.extend($.fn.datetimepicker.defaults,
        {dayViewHeaderFormat: "YYYY年 MMMM"}
    );

    /**
     * 日付選択
     */
    $('input[data-datetimepicker]').each(function () {
        var format = {datetime: 'YYYY/MM/DD HH:mm', date: 'YYYY/MM/DD', time: 'HH:mm'}
            [$(this).data('datetimepicker')];

        $(this).wrap('<div class="input-group date"></div>');
        var $group = $(this).parent();

        $group.append(
            '<span class="input-group-addon">' +
            '<span class="glyphicon glyphicon-calendar"></span>' +
            '</span>');

        $group.datetimepicker({locale: 'ja', format: format, focusOnShow: false, showClose: true});

        if ($(this).val() === '') {
            $(this).val(moment().format(format));
        }
    });
});

$(function () {
    /**
     * トグルメニューのアイコン
     */
    $('a[data-toggle="collapse"]').on('click', function () {
        var removeClass;
        var addClass;

        if ($(this).attr('aria-expanded') === 'true') {
            removeClass = 'glyphicon-chevron-down';
            addClass = 'glyphicon-chevron-up';
        } else {
            removeClass = 'glyphicon-chevron-up';
            addClass = 'glyphicon-chevron-down';
        }

        $(this).parent().find('.' + removeClass)
            .removeClass(removeClass).addClass(addClass);
    });

    /**
     * テキスト表示ダイアログ
     */
    $('a[data-dialog-message]').on('click', function (e) {
        e.preventDefault();

        BootstrapDialog.show({
            title: $(this).attr('title'),
            message: $(this).data('dialog-message')
        });
    });

    var showContentDialog = function (title, $content) {
        $content = $('<div>').append($content.children().clone());

        var buttons = [];
        $content.find('form > .btn').each(function () {
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
            message: $content,
            buttons: buttons
        });
    };

    /**
     * HTML表示ダイアログ(リンク)
     */
    $('a[data-dialog-content]').on('click', function (e) {
        e.preventDefault();

        var $content = $($(this).data('dialog-content'));

        showContentDialog($(this).attr('title'), $content);
    });

    /**
     * HTML表示ダイアログ(初期表示)
     */
    $('div[data-dialog-onload]').each(function () {
        showContentDialog($(this).attr('title'), $(this));
    });
});