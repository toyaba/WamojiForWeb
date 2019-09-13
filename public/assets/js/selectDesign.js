$(function() {
    $('.btn-forward').on('click', function(e) {
      var design = $('input[name=design]:checked').val();
      if(design == undefined) {
        $('.alert-danger').removeClass('dn');
        $('.alert-danger').addClass('db');
        return false;
      }

      // overlayの表示
      showLoadingOverlay();

      $('#'+$('input[name=design]:checked').prop('id')).prop('checked', true);

      $form = $('form');
      $form.attr('action', ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'convert/purchase');
      $form.attr('method', 'post');
      $form.submit();
      return false;
    });
  
    $('.btn-back').on('click', function(e) {
      $form = $('form');
      var convertType = $('input[name=convertType]').val();
      if(convertType) {
        if(convertType == 1) {
          $form.attr('action', ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'convert/luckyName');
        }
        if(convertType == 2) {
          $form.attr('action', ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'convert/kanjiSelect');
        }
        $form.attr('method', 'post');
        $form.submit();
      } else {

      }
      return false;
    });
});  
