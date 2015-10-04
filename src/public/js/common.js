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
     * リンクのタイトルをツールチップ化
     */
    $("a").tooltip();

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

        var $button = $('<button class="btn btn-default" type="button">' +
            '<span class="glyphicon glyphicon-folder-open"></span>' +
            '</button>').on('click', function () {
            $this.trigger('click');
        });

        var $textBox = $('<input type="text" class="form-control" readonly>').prop('placeholder', $this.prop('placeholder') || 'select file...');

        $this.after($('<div class="input-group">').append($textBox).append($('<span class="input-group-btn">').append($button)));

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
     * テーブル表示ダイアログ
     */
    $('a.dialog-table').on('click', function () {
        var $this = $(this);
        var title = $this.data('original-title');
        var header = $this.data('table-header');
        var body = $this.data('table-body');

        var $header = $('<tr>');
        var $table = $('<table class="table table-bordered">');

        $header.append('<th>#</th>');

        Object.keys(header).forEach(function (key) {
            $header.append('<th>' + header[key] + '</th>');
        });
        $table.append($header);

        body.forEach(function (entry, idx) {
            var $body = $('<tr>');

            $body.append('<td>' + (idx + 1) + '</td>');
            Object.keys(header).forEach(function (key) {
                $body.append('<td>' + entry[key] + '</td>');
            });
            $table.append($body);
        });

        BootstrapDialog.show({
            title: title,
            message: $table
        });

        return false;
    });
});