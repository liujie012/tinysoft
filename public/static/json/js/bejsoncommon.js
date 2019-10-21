
$(function () {
    $('[click-type="copy"]').each(function () {
        var clipboard = new Clipboard(this);
        clipboard.on('success', function (e) {
            layer.msg('复制成功');
        });
        clipboard.on('error', function (e) {
            layer.msg('复制失败');
        });
    });
})