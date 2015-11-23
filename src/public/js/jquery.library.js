$(function () {
    $.fn.updateSelection = function (dataArray) {
        var $this = $(this);
        var val = $this.val();
        $this.children().remove();

        dataArray.forEach(function (data) {
            $this.append($('<option>').val(data.id).text(data.name));
        });

        $this.val(val);
        if ($this.val() === null && !$this.prop('multiple')) {
            $this.prop('selectedIndex', 0);
        }

        if (!($.browser.android || $.browser.iphone || $.browser.ipad)) {
            $this.selectpicker('refresh');
        }
    };
});