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
        var $this = $(this);

        var $button = $('<span class="input-group-addon">' +
            '<span class="glyphicon glyphicon-folder-open"></span>' +
            '</span>').on('click', function () {
            $this.trigger('click');
        });

        var $textBox = $('<input type="text" class="form-control" readonly>').prop('placeholder', $this.prop('placeholder') || 'select file...');

        $this.after($('<div class="input-group file">').append($textBox).append($button));

        $this.on('change', function () {
            $textBox.val(Array.prototype.map.call($this.prop('files'), function (file) {
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
        var $this = $(this);
        var format = {datetime: 'YYYY/MM/DD HH:mm', date: 'YYYY/MM/DD', time: 'HH:mm'}
            [$this.data('datetimepicker')];

        $this.prop('readonly', 'readonly');

        $this.wrap('<div class="input-group date"></div>');
        var $group = $this.parent();

        $group.append(
            '<span class="input-group-addon">' +
            '<span class="glyphicon glyphicon-calendar"></span>' +
            '</span>');

        $group.datetimepicker({locale: 'ja', format: format, ignoreReadonly: true});
        $this.val(moment().format(format));
    });

    /**
     * トグルメニューのアイコン
     */
    $('a[data-toggle="collapse"]').on('click', function (e) {
        var $this = $(this);

        var removeClass;
        var addClass;
        if ($this.attr('aria-expanded') === 'true') {
            removeClass = 'glyphicon-chevron-down';
            addClass = 'glyphicon-chevron-up';
        } else {
            removeClass = 'glyphicon-chevron-up';
            addClass = 'glyphicon-chevron-down';
        }
        $this.parent().find('.' + removeClass)
            .removeClass(removeClass).addClass(addClass);
    });

    /**
     * テキスト表示ダイアログ
     */
    $('a[data-dialog-message]').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);

        BootstrapDialog.show({
            title: $this.data('dialog-title'),
            message: $this.data('dialog-message')
        });
    });

    /**
     * HTML表示ダイアログ
     */
    $('a[data-dialog-content]').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);

        BootstrapDialog.show({
            title: $this.data('dialog-title'),
            message: $($this.data('dialog-content')).clone().removeClass('hidden')
        });
    });
});