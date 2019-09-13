<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="style.css">
<?php
	set_error_handler("error_handler");
	function error_handler($errno, $errstr, $errfile, $errline){
		var_dump("err: ".$errstr.", line:".$errline);
	}
	set_exception_handler("exception_handler");
	function exception_handler($e){
		var_dump("err: ".$e->getMessage().", line:".$e->getLine());
	}
	require_once "../Convert/convertSystem.php"; 
?>
<script>
function modifyKanjiName(index, kanji){
	if(kanji != "") {
		var kanjiName = document.getElementById("modifiedKanjiName").value;
		if(kanjiName == "") kanjiName = document.getElementById("kanjiName").innerHTML;
		kanjiName = kanjiName.slice(0, index) + kanji + kanjiName.slice(index+1);
		document.getElementById("modifiedKanjiName").value = kanjiName;
	}
}
</script>
<title>Wamoji</title>
</head>
<body>

<form action='index.php' method='post'>
<input type='hidden' name='language' value='en'>
<input type='hidden' name='modifiedKanjiName' id='modifiedKanjiName'>

<table border='1'>
<tr><td>性別</td><td><input type='radio' name='gender' value='m' checked='checked'>男性 / <input type='radio' name='gender' value='f'>女性 / <input type='radio' name='gender' value=''>未選択</td></tr>
<tr><td>入力文字種</td><td><input type='radio' name='inputNameType' value='en' checked='checked'>アルファベット / <input type='radio' name='inputNameType' value='ja'>カナ</td></tr>
<tr><td>入力名</td><td><input type='text' name='inputName' size='15' id='inputName' placeholder='Alice'<?php if(!empty($_POST["inputName"])) print("value='".$_POST["inputName"]."'"); ?>></td></tr>
<tr><td>漢字選択上限数</td><td><input type='text' name='kanjiCandidateMax' size='5' id='kanjiCandidateMax' value='3'></td></tr>
<tr><td>漢字名出力方法</td><td><input type='radio' name='isGogyoMode' value='0' checked='checked'>ユーザ選択 / <input type='radio' name='isGogyoMode' value='1'>ラッキーネーム探索</td></tr>
<tr><td colspan='2'><button class='btn btn-primary btn-lg'>Convert</button></td></tr>
</table>
<hr>

<?php
if(!empty($_POST)){
	$inputArray = array(
		"language" => $_POST["language"],
		"gender" => $_POST["gender"],
		"inputName" => $_POST["inputName"], 
		"inputNameType" => $_POST["inputNameType"], 
		"kanjiCandidateMax" => $_POST["kanjiCandidateMax"],
		"isGogyoMode" => $_POST["isGogyoMode"],
	);
	if(!empty($_POST["modifiedKanjiName"])) $inputArray["modifiedKanjiName"] = $_POST["modifiedKanjiName"];

	$outputJSON = convert(json_encode($inputArray)); 
	$outputArray = json_decode($outputJSON, true);

	print("かな／カナ／漢字:".$outputArray["hiraganaName"]." ／ ".$outputArray["hiraganaName"]." ／ <span id='kanjiName'>".$outputArray["kanjiName"]."</span><hr>\n");
	print("漢字意味:\n");
	foreach($outputArray["kanjiInfo"] as $kanji => $kanjiInfo) print("「".$kanji."」: ".$kanjiInfo."　　"); 
	print("<hr>\n");
	if($outputArray["isGogyoMode"]){
		print("五行情報:\n");
		foreach($outputArray["gogyoInfo"] as $title => $contents) print($title.": ".$contents."<br>\n"); 
		print("<hr>\n");
	}
	else {
		print("漢字変更:\n");
		foreach($outputArray["kanjiCandidate"] as $i => $kanjiCandidateArray){
			print("<select onchange='modifyKanjiName($i, this.value)'>\n<option value='' selected></option>\n");
			foreach($kanjiCandidateArray as $kanjiCandidate) print("<option value='$kanjiCandidate'>$kanjiCandidate</option>\n");
			print("</select>\n");
		}
	}
}
?>

</form>
</body>
</html>
