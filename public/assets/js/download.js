$(function() {
    var base64ToArrayBuffer = function(base64) {
        var binary_string =  window.atob(base64);
        var len = binary_string.length;
        var bytes = new Uint8Array( len );
    
        for (var i = 0; i < len; i++) {
            bytes[i] = binary_string.charCodeAt(i);
        }
    
        return bytes.buffer;
    }

    var data = new FormData();
    data.append("received_no", $uetsukeNo);
    data.append("order_number", $orderNumber);

    // overlayの表示
    showLoadingOverlay();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: ($uri.slice(-1) == '/'  ? $uri : $uri + '/') + 'ajax/getZipFile',
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
            var data = JSON.parse(JSON.stringify(response));
            var zip_file = base64ToArrayBuffer(data.zip_file);
            var blob = new Blob([zip_file], { type: 'application/zip'});

            //ファイルをダウンロード
            if (window.navigator.msSaveBlob) {
                window.navigator.msSaveBlob(blob, $zipfilename);
 
                // // msSaveOrOpenBlobの場合はファイルを保存せずに開ける
                // window.navigator.msSaveOrOpenBlob(blob, $zipfilename);
            } else {
                const ua = navigator.userAgent;
                if(/iP(hone|(o|a)d)/.test(ua)) {
                    //iOS
                    var reader = new FileReader();
                    reader.onload = function(e) {
                    	var $a = document.createElement('a');
                    	$a.download = $zipfilename;
                    	$a.href = reader.result;
                    	$a.click();
                        //window.open(reader.result);
                    };
                    reader.readAsDataURL(blob);
                } else {
                    // document.getElementById("download").href = window.URL.createObjectURL(blob);
                    var $a = document.createElement('a');
                    $a.download = $zipfilename;
                    $a.href = window.URL.createObjectURL(blob);
                    //$a.target = '_blank';
                    $a.click();
                }
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) // 接続が失敗
        {
            // loading解除
            $('#js-loadingOverlay').hide();

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
