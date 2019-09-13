$(function() {
    // $('.btn-forward').on('click', function(e) {
    //   // overlayの表示
    //   showLoadingOverlay();

    //   $form = $('form');
    //   $form.attr('action', '/complete');
    //   $form.attr('method', 'post');
    //   $form.submit();
    //   return false;
    // });
  
    $('.btn-back').on('click', function(e) {
      $form = $('form');
      $form.attr('action', '/maintenance/facilityManagement');
      $form.attr('method', 'post');
      $form.submit();
      return false;
    });
});  
