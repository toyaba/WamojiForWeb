$(function() {
  $('.btn-forward').on('click', function(e) {
    $form = $('form');
    $form.attr('action', ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'convert/selectDesign');
    $form.attr('method', 'post');
    $form.submit();
    return false;
  });

  $('.btn-back').on('click', function(e) {
    $form = $('form');
    $form.attr('action', ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'convert');
    $form.attr('method', 'post');
    $form.submit();
    return false;
  });

  $('.btn-convert').on('click', function(e) {
    e.preventDefault();

    // 入力された文字を取得
    var inputText = $(this).parent().find('.input-convert__text').val();

    // 入力タイプを取得
    var inputType = $(this).parent().find('.input-convert__type').val();

    if($(".alertarea").hasClass("db")) {
      return false;
    }

    // 変換タイプを取得
    var convertType = $('.input-convert__type').val();

    // 性別を判定
    var gender = $('input[name=gender]:checked').val();
    if(gender == undefined) {
      $('#gender-n').prop('checked', true);
    }

    var data = new FormData($('#convert')[0]);
    data.append("kunYomiLengthMax", 0);
    data.append("pnValueMin", -0.5);

    // overlayの表示
    showLoadingOverlay();

    // AjaxでAPIを叩く
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'ajax/getLuckyName',
      type: 'POST',
      data: data,
      contentType: false,
      processData: false,
      dataType: 'json',
      success:function(response) {
        // loading解除
        $('#js-loadingOverlay').hide();
      
        if(response.error) {
          alert('エラー:' + response.error)
          return false;          
        }
        $("#convertResult").val(JSON.stringify(response));
        $("#convertType").val(response.type);
        $('.result-hiragana__value strong').text(response.hiraganaName);
        $('.result-katakana__value strong').text(response.katakanaName);
        $('.result-kanji__value strong').text(response.kanjiName);

        // 入力テキストの表示
        $('.result-input__value').text(inputText);

        // 表示
        $('#js-result').fadeIn();

        var y = $('#js-result').position().top;

        $('html, body').animate({
          scrollTop: y
        }, {
          duration: 1500
        });
        console.log(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) // 接続が失敗
      {
        if(XMLHttpRequest.status == 422) {
          var obj = $.parseJSON(XMLHttpRequest.responseText);
          $(".alert-message").text(obj.inputName);
          $(".alert").removeClass("dn");
          $(".alert").addClass("db");
        } else {
          alert('エラー' + XMLHttpRequest.responseText)
         }
       // loading解除
       $('#js-loadingOverlay').hide();
      }
    });
  });
});
