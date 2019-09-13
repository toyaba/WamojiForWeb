$(function() {
    var checkLatin = function(value) {
        var result = true;
        if(value != '' && value.match(/[^a-zA-Z\s]/)) {
            result = false;
        }
        return result;
    };
    var checkKatakana = function(value) {
        var result = true;
        if(value != '' && value.match(/[^\u3041-\u30FF\s\u3000]/)) {
            result = false;
        }
        return result;
    };

    var checkLatinMain = function(value) {
        var result = checkLatin(value);
        var alert = $('.alertarea');
        var message = alert.find('.alert-message');
        if(result) {
            message.text('');
            alert.removeClass('db');
            alert.addClass('dn');
        } else {
            message.text(errorMessageName);
            alert.removeClass('dn');
            alert.addClass('db');
        }
    };

    var checkKatakanaMain = function(value) {
        var result = checkKatakana(value);
        var alert = $('.alertarea');
        var message = alert.find('.alert-message');
        if(result) {
            message.text('');
            alert.removeClass('db');
            alert.addClass('dn');
        } else {
            message.text(errorMessageKana);
            alert.removeClass('dn');
            alert.addClass('db');
        }
    };

    $('#type-name').find('input[name="c_name"]').on('input', function(event) {
        checkLatinMain($(this).val());
        return false;
    });

    $('#type-kana').find('input[name="c_name"]').on('input', function(event) {
        checkKatakanaMain($(this).val());
        return false;
    });

    $('#select_type_name').on('click', function(event) {
        checkLatinMain($('#type-name').find('input[name="c_name"]').val());
    });

    $('#select_type_kana').on('click', function(event) {
        checkKatakanaMain($('#type-kana').find('input[name="c_name"]').val());
    });

});
