<?php

///// 定数&グローバル変数&初期設定 /////
define("ENCODE_TYPE", "UTF-8");
require_once("nameData.php"); //$nameEnArray、$nameFrArrayを取得
require_once("phoneticsData.php"); //$english2romajiArray1&2、$romaji2kanaArray1&2を取得
require_once("kanaData.php"); //$kanaArray(カナ => [カナ,漢字候補1, 漢字候補2, 漢字候補3])を取得
require_once("kanjiData.php"); //$kanjiArray(漢字 => [画数, 日本語意味, 英語意味, 仏語意味, 韓国語意味])を取得
require_once("gogyoData.php"); //$kotodamaArray、$maleLuckNumberArray、$femaleLuckyNumberArray、$synastryArray、$gogyoTranslationArrayを取得
ini_set("max_execution_time", 0); //タイムアウト回避

///// convert: 元言語→漢字(e.g.アリス→明理好+漢字意味+代替漢字+五行情報)  /////
function convert($inputJSON){
	$inputArray = json_decode($inputJSON, true);

	//入力→かな&カナ
	if($inputArray["inputNameType"]=="en"){
		$inputName = trim(preg_replace("/[^A-Za-z]+/u", " ", $inputArray["inputName"])); //アルファベット以外の文字を空白に置換
		list($hiraganaName, $katakanaName) = english2kana($inputName);
	}
	else if($inputArray["inputNameType"]=="ja"){
		$hiraganaName = mb_convert_kana(trim($inputArray["inputName"]), "c", ENCODE_TYPE);
		$katakanaName = mb_convert_kana(trim($inputArray["inputName"]), "C", ENCODE_TYPE);
	 }
	 //かな&カナ文字数制約
	 $hiraganaName = mb_substr($hiraganaName, 0, intval($inputArray["outputNameLengthMax"]), ENCODE_TYPE);
	 $katakanaName = mb_substr($katakanaName, 0, intval($inputArray["outputNameLengthMax"]), ENCODE_TYPE);

	//カナ→漢字
	$kanjiCandidateArray2D = kana2kanjiCandidate($katakanaName, intval($inputArray["kanjiCandidateMax"])); //漢字候補を出力
	if(!empty($inputArray["modifiedKanjiName"])){
		//ユーザによる漢字指定のデータ(kanjiName)がPOSTされている場合は上書き
		$kanjiName = trim($inputArray["modifiedKanjiName"]);
	}
	else if($inputArray["isGogyoMode"]){
		//五行占いをする場合は名前探索
		$kanjiName = getBestKanjiName($kanjiCandidateArray2D, $katakanaName, $inputArray["gender"], $inputArray["language"]);
	}
	else {
		//デフォルト漢字名を生成
		$kanjiName = "";
		foreach($kanjiCandidateArray2D as $kanjiCandidateArray){
			$kanjiName .= $kanjiCandidateArray[0];
		}
	}

	//関連情報取得
	$kanjiInfo = getKanjiInfo($kanjiCandidateArray2D, $inputArray["language"]);
	$gogyoInfo = getGogyoInfo($katakanaName, $kanjiName, $inputArray["gender"], $inputArray["language"]);

	$outputArray = $inputArray; //出力データには全ての入力データを含める
	$outputArray += array(
		"hiraganaName" => $hiraganaName, 
		"katakanaName" => $katakanaName, 
		"kanjiName" => $kanjiName, 
		"kanjiInfo" => $kanjiInfo,
		"gogyoInfo" => $gogyoInfo,
		"kanjiCandidate" => $kanjiCandidateArray2D,
	);
	return json_encode($outputArray);
}

///// english2kana: 英語→かな&カナ(e.g. Alice→ありす&アリス) /////
function english2kana($englishName){
	global $nameEnArray, $english2romajiArray1, $english2romajiArray2, $romaji2kanaArray1, $romaji2kanaArray2;
	$englishArray = explode(" ", $englishName); //スペースがあれば区切って一つずつ変換
	$kanaName = "";
	foreach($englishArray as $englishName){
		$englishName = mb_strToLower(trim($englishName), ENCODE_TYPE);
		if(array_key_exists($englishName, $nameEnArray)){
			$kanaName .= $nameEnArray[$englishName]." "; //リスト変換
		} else{
			$romaji = preg_replace($english2romajiArray1, $english2romajiArray2, $englishName); //英語→ローマ字変換
			$romaji = mb_strToUpper(trim($romaji), ENCODE_TYPE);
			$kanaName .= preg_replace($romaji2kanaArray1, $romaji2kanaArray2, $romaji)." "; //ローマ字→カナ変換
		}
	}
	return array(mb_convert_kana(trim($kanaName), "c", ENCODE_TYPE), mb_convert_kana(trim($kanaName), "C", ENCODE_TYPE)); 
}

///// kana2kanjiCandidate: カナを分解した上で全漢字部品を取得(e.g.アリス→[当,明,愛][利,里,理][好,主,素]) /////
function kana2kanjiCandidate($kanaName, $kanjiCandidateMax){
	global $kanaArray;
	if(empty($kanaName)){
		return array();
	}
	//カナを検索→$kanaArrayにあれば漢字候補を全て返し、無ければ後ろ1文字を切り取って再検索
	for($i=mb_strlen($kanaName, ENCODE_TYPE); $i>0; $i--){
		$kanaNameSub1 = mb_substr($kanaName, 0, $i, ENCODE_TYPE); //カナの前方部分
		$kanaNameSub2 = mb_substr($kanaName, $i, null, ENCODE_TYPE); //カナの後方部分
		if(array_key_exists($kanaNameSub1, $kanaArray)){
			//前方をDB検索、後方は再帰
			return array_merge(array(array_slice($kanaArray[$kanaNameSub1], 0, $kanjiCandidateMax)), kana2kanjiCandidate($kanaNameSub2, $kanjiCandidateMax));
		}
	}
	//最初の1文字がそもそも$kanaArrayに無ければ、修正して再検索
	$kanaName = replaceKana(mb_substr($kanaName, 0, 1, ENCODE_TYPE)).mb_substr($kanaName, 1, null, ENCODE_TYPE); 
	return kana2kanjiCandidate($kanaName, $kanjiCandidateMax);
}

///// replaceKana: カナの分解に失敗した場合の修正 /////
function replaceKana($kanaLetter){
	if($kanaLetter==="ヂ"){
		return "ジ";
	}
	if($kanaLetter==="ヅ"){
		return "ズ";
	} 
	if($kanaLetter==="ー"){
		return null;
	}
	if($kanaLetter==="ッ"){
		return null;
	}
	if($kanaLetter==="ャ"){
		return "ヤ";
	}
	if($kanaLetter==="ュ"){
		return "ユ";
	}
	if($kanaLetter==="ョ"){
		return "ヨ";
	}
	if($kanaLetter==="ン"){
		return "ム";
	}
	if($kanaLetter==="ァ"){
		return "ア";
	}
	if($kanaLetter==="ィ"){
		return "イ";
	}
	if($kanaLetter==="ゥ"){
		return "ウ";
	}
	if($kanaLetter==="ェ"){
		return "エ";
	}
	if($kanaLetter==="ォ"){
		return "オ";
	}
	
	return null; //該当しない場合は削る
}

///// getBestKanjiName: 五行思想に基づいて最適な漢字名を返す /////
function getBestKanjiName($kanjiCandidateArray2D, $katakanaName, $gender, $language){
	$kanjiNameArray = getAllKanjiName($kanjiCandidateArray2D);

	$extraSymbol = ""; //画数調整記号列
	while(empty($bestKanjiName)){
		foreach($kanjiNameArray as $kanjiName){
			$kanjiName .= $extraSymbol; //画数調整
			$gogyoInfo = getGogyoInfo($katakanaName, $kanjiName, $gender, $language);
			if($gogyoInfo["luckeyLevel"] >= 3){
				$bestKanjiName = $kanjiName;
			}
			if($gogyoInfo["luckeyLevel"] >= 4){
				break;
			}
		}
		$extraSymbol.="。"; //画数調整記号列を更新
	}
	return $bestKanjiName;
}

///// getAllKanjiName: kanjiCandidateArray2Dに対する全ての組合せを返す(e.g. [当][利,里][好,主]→[当利好,当利主,当里好,当里主]) /////
function getAllKanjiName($kanjiCandidateArray2D){
	if(count($kanjiCandidateArray2D) == 1){
		return $kanjiCandidateArray2D[0];
	}
	
	//最初の要素を除外した上で再帰→戻ってきた組合せと除外した要素の全組合せを返す
	$kanjiCandidateArray1 = array_shift($kanjiCandidateArray2D);
	$kanjiCandidateArray2 = getAllKanjiName($kanjiCandidateArray2D);
	$kanjiNameArray = array();
	foreach($kanjiCandidateArray1 as $kanjiCandidate1){
		foreach($kanjiCandidateArray2 as $kanjiCandidate2){
			$kanjiNameArray[] = $kanjiCandidate1.$kanjiCandidate2;
		}
	}
	return $kanjiNameArray;
}

///// getKanjiInfo: 各漢字の意味を返す /////
function getKanjiInfo($kanjiCandidateArray2D, $language){
	global $kanjiArray;
	if(empty($language)){
		//デフォルトを英語に設定
		$language = "en";
	}
	
	$kanjiInfoArray = array();
	foreach($kanjiCandidateArray2D as $kanjiCandidateArray){
		foreach($kanjiCandidateArray as $kanjiLetter){
			if(array_key_exists($kanjiLetter, $kanjiArray)){
				$kanjiInfoArray[$kanjiLetter] = $kanjiArray[$kanjiLetter][$language];
			}
			else{
				$kanjiInfoArray[$kanjiLetter] = "No Data...";
			}
		}
	}
	return $kanjiInfoArray;
}

///// getGogyoInfo: 漢字組合せの五行判定。頭文字(initial)、漢字総画(soukaku)、言魂(kotodama)、数魂(kazutama)、言魂説明(kotodamaMessage)、数魂説明(kazutamaMessage)、総画運勢(soukakuLuck)、相性運勢(synastryLuck)、判定ID(id)を返す /////
function getGogyoInfo($katakanaName, $kanjiName, $gender, $language){
	global $kanjiArray, $kotodamaArray, $soukakuLuckArray, $synastryLuckArray, $gogyoTranslationArray;
	if(empty($gender)){
		//デフォルトを男性に設定
		$gender = "m";
	}
	
	//カナの頭文字から五行(言魂)判定
	$gogyoInfo["initial"] = mb_substr($katakanaName, 0, 1, ENCODE_TYPE);
	$gogyoInfo["kotodama"] = $kotodamaArray[$gogyoInfo["initial"]];
	
	//総画数から五行(数魂)判定
	$gogyoInfo["soukaku"] = 0;
	for($i=0; $i<mb_strlen($kanjiName, ENCODE_TYPE); $i++){
		$kanjiLetter = mb_substr($kanjiName, $i, 1, ENCODE_TYPE);
		if(array_key_exists($kanjiLetter, $kanjiArray)){
			$gogyoInfo["soukaku"] += $kanjiArray[$kanjiLetter]["kaku"];
		}
	}
	if($gogyoInfo["soukaku"] % 10 == 0){
		$gogyoInfo["kazutama"] = "水";
	}
	else if($gogyoInfo["soukaku"] % 10 <= 2){
		$gogyoInfo["kazutama"] = "木";
	}
	else if($gogyoInfo["soukaku"] % 10 <= 4){
		$gogyoInfo["kazutama"] = "火";
	}
	else if($gogyoInfo["soukaku"] % 10 <= 6){
		$gogyoInfo["kazutama"] = "土";
	}
	else if($gogyoInfo["soukaku"] % 10 <= 8){
		$gogyoInfo["kazutama"] = "金";
	}
	else{
		$gogyoInfo["kazutama"] = "水";
	}
	
	//総画判定&相性判定
	if($gogyoInfo["soukaku"]<=84){
		$gogyoInfo["soukakuLuck"] = $soukakuLuckArray[$gender][$gogyoInfo["soukaku"]];
	}
	else{
		//85画以上は「凶」
		$gogyoInfo["soukakuLuck"] = "凶";
	}
	$gogyoInfo["synastryLuck"] = $synastryLuckArray[$gogyoInfo["kazutama"]][$gogyoInfo["kotodama"]]; //数魂ベース(数魂→言魂の順)
	$gogyoInfo["luckeyLevel"] = 0; //ラッキーレベル(0～4))
	if($gogyoInfo["soukakuLuck"]=="吉"){
		$gogyoInfo["luckeyLevel"] +=2;
	}
	if($gogyoInfo["synastryLuck"]=="吉"){
		$gogyoInfo["luckeyLevel"] +=1;
	}
	if($gogyoInfo["synastryLuck"]=="大吉"){
		$gogyoInfo["luckeyLevel"] +=2;
	}
	
	//言語変換
	$gogyoInfo["id"] = $gogyoTranslationArray[$gogyoInfo["kazutama"]]["id"]*10 + $gogyoTranslationArray[$gogyoInfo["kotodama"]]["id"];
	$gogyoInfo["kotodamaMessage"] = $gogyoTranslationArray[$gogyoInfo["kotodama"]][$language."Comment"];
	$gogyoInfo["kazutamaMessage"] = $gogyoTranslationArray[$gogyoInfo["kazutama"]][$language."Comment"];
	$gogyoInfo["kotodama"] = $gogyoTranslationArray[$gogyoInfo["kotodama"]][$language];
	$gogyoInfo["kazutama"] = $gogyoTranslationArray[$gogyoInfo["kazutama"]][$language];
	$gogyoInfo["soukakuLuck"] = $gogyoTranslationArray[$gogyoInfo["soukakuLuck"]]["ja"];
	$gogyoInfo["synastryLuck"] = $gogyoTranslationArray[$gogyoInfo["synastryLuck"]]["ja"];
	
	return $gogyoInfo;
}

?>
