var spRec;
$(function() {
	function checkBrowser(){
		var check = false;
		var result = '不明';

		var agent = window.navigator.userAgent.toLowerCase();
		var version = window.navigator.appVersion.toLowerCase();

		if(agent.indexOf("msie") > -1){
			if (version.indexOf("msie 6.") > -1){
				result = 'IE6';
			}else if (version.indexOf("msie 7.") > -1){
				result = 'IE7';
			}else if (version.indexOf("msie 8.") > -1){
				result = 'IE8';
			}else if (version.indexOf("msie 9.") > -1){
				result = 'IE9';
			}else if (version.indexOf("msie 10.") > -1){
				result = 'IE10';
			}else{
				result = 'IE(バージョン不明)';
			}
		}else if(agent.indexOf("trident/7") > -1){
			result = 'IE11';
		}else if(agent.indexOf("edge") > -1){
			result = 'Edge';
		}else if (agent.indexOf("chrome") > -1){
			result = 'Chrome';
			check = true;
		}else if (agent.indexOf("safari") > -1){
			result = 'Safari';
		}else if (agent.indexOf("opera") > -1){
			result = 'Opera';
		}else if (agent.indexOf("firefox") > -1){
			result = 'Firefox';
		}

		// alert("お使いのブラウザは「" + result + "」です。");
		return check;
	}

	var getDevice = (function(){
		var ua = navigator.userAgent;
		if(ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0){
			return 'sp';
		}else if(ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0){
			return 'tab';
		}else{
			return 'other';
		}
	})();

	spRec = (function(){
		const language = "en"
		var rec = new webkitSpeechRecognition();
		var gram = new webkitSpeechGrammarList();
		gram.addFromUri("/asserts/js/voice/grammar.txt", 1);
		rec.grammars = gram; //単語追加(動いてないっぽい？)
		rec.lang = language;
		rec.maxAlternatives = 10;
		rec.onresult = function(e){
			$(".input-convert__text").val(e.results[0][0].transcript);
			$("#inputName").val(e.results[0][0].transcript);
			if($("#select_type_name").hasClass("current")) {
				$("#select-name").removeClass("dn");
				$("#select-name").addClass("db");
				$("#select-kana").removeClass("db");
				$("#select-kana").addClass("dn");
				if(e.results[0].length >= 1) {
					$("#select-name-candidate1").text(e.results[0][0].transcript);
				}
				if(e.results[0].length >= 2) {
					$("#select-name-candidate2").text(e.results[0][1].transcript);
				}
				if(e.results[0].length >= 3) {
					$("#select-name-candidate3").text(e.results[0][2].transcript);
				}
			} else {
				$("#select-name").removeClass("db");
				$("#select-name").addClass("dn");
				$("#select-kana").removeClass("dn");
				$("#select-kana").addClass("db");
				if(e.results[0].length >= 1) {
					$("#select-kana-candidate1").text(e.results[0][0].transcript);
				}
				if(e.results[0].length >= 2) {
					$("#select-kana-candidate2").text(e.results[0][1].transcript);
				}
				if(e.results[0].length >= 3) {
					$("#select-kana-candidate3").text(e.results[0][2].transcript);
				}
			}
			spRec.stop();
		};
		rec.onend = function(e){
			$(".input-convert__mic_off").removeClass("dn");
			$(".input-convert__mic_off").addClass("db");
			$(".input-convert__mic_on").removeClass("db");
			$(".input-convert__mic_on").addClass("dn");
		};
		return rec;
	})();

	$('.input-convert__mic_off').on('click', function(e) {
		$(".input-convert__mic_off").removeClass("db");
		$(".input-convert__mic_off").addClass("dn");
		$(".input-convert__mic_on").removeClass("dn");
		$(".input-convert__mic_on").addClass("db");
		// document.getElementById("inputName").style.display="none";
		// document.getElementById("inputNameCandidate").style.display="block";
		// document.getElementById("micIcon").src = "micOn.png";
		spRec.start();
	});

	$('.input-convert__mic_on').on('click', function(e) {
		$(".input-convert__mic_off").removeClass("dn");
		$(".input-convert__mic_off").addClass("db");
		$(".input-convert__mic_on").removeClass("db");
		$(".input-convert__mic_on").addClass("dn");
		$("#select-name").removeClass("db");
		$("#select-name").addClass("dn");
		$("#select-kana").removeClass("db");
		$("#select-kana").addClass("dn");
		spRec.stop();
	});

	if (checkBrowser()) {
        $("#mic-name").removeClass("dn");
        $("#mic-name").addClass("db");
        $("#mic-kana").removeClass("dn");
        $("#mic-kana").addClass("db");
	} else {
        $("#mic-name").removeClass("db");
        $("#mic-name").addClass("dn");
        $("#mic-kana").removeClass("db");
        $("#mic-kana").addClass("dn");
	}

	$("#select-name-candidate").change(function(e) {
		$(".input-convert__text").val($('option:selected').val());
		$("#inputName").val($('option:selected').val());
		$("#select-name-candidate1").text("");
		$("#select-name-candidate2").text("");
		$("#select-name-candidate3").text("");
		$("#select-name").removeClass("db");
		$("#select-name").addClass("dn");
		$(".input-convert__mic_off").removeClass("dn");
		$(".input-convert__mic_off").addClass("db");
		$(".input-convert__mic_on").removeClass("db");
		$(".input-convert__mic_on").addClass("dn");
		spRec.stop();
});
	$("#select-kana-candidate").change(function(e) {
		$(".input-convert__text").val($('option:selected').val());
		$("#inputName").val($('option:selected').val());
		$("#select-kana-candidate1").text("");
		$("#select-kana-candidate2").text("");
		$("#select-kana-candidate3").text("");
		$("#select-kana").removeClass("db");
		$("#select-kana").addClass("dn");
		$(".input-convert__mic_off").removeClass("dn");
		$(".input-convert__mic_off").addClass("db");
		$(".input-convert__mic_on").removeClass("db");
		$(".input-convert__mic_on").addClass("dn");
		spRec.stop();
	});
});
