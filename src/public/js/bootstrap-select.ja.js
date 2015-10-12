/*!
 * Bootstrap-select v1.7.2 (http://silviomoreto.github.io/bootstrap-select)
 *
 * Copyright 2013-2015 bootstrap-select
 * Licensed under MIT (https://github.com/silviomoreto/bootstrap-select/blob/master/LICENSE)
 */

(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module unless amdModuleId is set
        define(["jquery"], function (a0) {
            return (factory(a0));
        });
    } else if (typeof exports === 'object') {
        // Node. Does not work with strict CommonJS, but
        // only CommonJS-like environments that support module.exports,
        // like Node.
        module.exports = factory(require("jquery"));
    } else {
        factory(jQuery);
    }
}(this, function () {

    (function ($) {
        $.fn.selectpicker.defaults = {
            noneSelectedText: '未選択',
            noneResultsText: '{0} は見つかりませんでした',
            countSelectedText: function (numSelected, numTotal) {
                return (numSelected == 1) ? "{0}件選択" : "{0}件選択";
            },
            maxOptionsText: function (numAll, numGroup) {
                return [
                    (numAll == 1) ? '上限に達しました (最大{n}件)' : '上限に達しました (最大{n}件)',
                    (numGroup == 1) ? 'グループの上限に達しました (最大{n}件)' : 'グループの上限に達しました (最大{n}件)'
                ];
            },
            selectAllText: 'すべて選択',
            deselectAllText: 'すべての選択を解除',
            multipleSeparator: ', '
        };
    })(jQuery);


}));
