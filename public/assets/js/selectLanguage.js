$(function() {
    $('.select-language').on('change', function(e) {
        var language = $('option:selected').val();
        var uri = $('.uri').val();

        $form = $(this).parents('form');
        $form.attr('action', uri);
        $form.attr('method', 'post');
        $form.submit();
        return false;
      });
  });