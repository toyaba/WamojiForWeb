$(function() {
    $('.btn_lucky_name').on('click', function() {
        // $data = $('form').serialize();
        $form = $('form');
        $form.attr('action', ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'convert/luckyName');
        $form.attr('method', 'post');
        $form.submit();
        return false;
    });
    $('.btn_select_kanji').on('click', function() {
        // $data = $('form').serialize();
        $form = $('form');
        $form.attr('action', ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'convert/kanjiSelect');
        $form.attr('method', 'post');
        $form.submit();
        return false;
    });
});
