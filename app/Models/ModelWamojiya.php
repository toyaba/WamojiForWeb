<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Elements\MstFacility;
use App\Models\Elements\TblKanjiCount;
use App\Models\Elements\TblServiceData;
use App\Models\Elements\TblPrintImage;
use App\Models\Elements\MstLanguage;

class ModelWamojiya /* extends Model */
{
    private $request;

    function __construct($request) {
        $this->request = $request;
    }

    public function login(&$auth) {
        $login_facility_id = $this->request->input('login_facility_id');
        $login_password = $this->request->input('login_password');
        $remember_me = $this->request->input('remember_me');
        if($login_facility_id && $login_facility_id) {
            $mstFacility = new MstFacility();
            $auth = $mstFacility->isAuth($login_facility_id, $login_password);
            if($auth) {
                $this->request->session()->put('login_facility_id',$login_facility_id);
                $this->request->session()->put('remember_me',$remember_me);
                $this->request->session()->put('lonin_time',$auth);
                $this->request->session()->put('logined',$auth);
                // Session::save();                
            }
        }
        if(!$auth) {
            if(isset($request)) {
                $request->flashOnly(['login_facility_id', 'remember_me']);
            }
        }
    }

    public function saveKanjiData($kanji) {
        $matches = array(); // arrayの初期化を同一条件にするため
        $matches = preg_split("//u", $kanji, -1, PREG_SPLIT_NO_EMPTY);

        $tblKanjiCount = new TblKanjiCount;

        foreach($matches as $idx => $moji) {
            $tblKanjiCount->setKanji($moji);
        }
    }

    public function saveServiceData($facility_id, $convertResult, $end_time) {
        $inputName = $convertResult->inputName;
        $hiragana = $convertResult->hiraganaName;
        $katakana = $convertResult->katakanaName;
        $kanji = $convertResult->kanjiName;
        $type = $convertResult->type;
        $gender = $convertResult->gender;
        $symbol_type_cd = $convertResult->symbol_type_cd;
        $start_time = $convertResult->start_time;
        $language_code = $convertResult->language_code;
        $conversion_id = 0;
        if($type == 1) {
            // luckyname
            $conversion_id = 1;
        } 
        if($type == 2) {
            // kanjiselect
            $conversion_id = 0;
        } 
        if($gender) {
            if($gender == 'm') {
                $gender = 1;
            }
            if($gender == 'f') {
                $gender = 2;
            }
        } else {
            $gender = 0;
        }

        $tblServiceData = new TblServiceData;
        $mstLanguage = new MstLanguage();

        $language_cd = $mstLanguage->getLanguageCd($language_code);

        $order_number = $tblServiceData->getOrderNumber();

        $insert_data = array(
            'order_number' => $order_number,
            'facility_id' => $facility_id,
            'terminal_id' => $_SERVER["REMOTE_ADDR"],
            'language_cd' => $language_cd,
            'input_data' => $inputName,
            'wamoji_hiragana' => $hiragana,
            'wamoji_katakana' => $katakana,
            'wamoji' => $kanji,
            'symbol_type_cd' => $symbol_type_cd,
            'gender' => $gender,
            'conversion_id' => $conversion_id,
        );
        $tblServiceData->insertServiceData($insert_data);

        return $order_number;
    }

    public function savePrintImage($facility_id, $order_number, $convertResult, $zipname, $pdfname) {
        $inputName = $convertResult->inputName;
        $hiragana = $convertResult->hiraganaName;
        $katakana = $convertResult->katakanaName;
        $kanji = $convertResult->kanjiName;

        $zip = null;
        $pdf = null;
        if($zipname) {
            $zip = file_get_contents($zipname);
        }
        if($pdfname) {
            $pdf = file_get_contents($pdfname);
        }

        date_default_timezone_set('Asia/Tokyo');
        $add_date = date("Y/m/d");

        $tblPrintImage = new TblPrintImage;
        $received_no = $tblPrintImage->getReceivedNo($add_date);

        $insert_data = array(
            'facility_id' => $facility_id,
            'order_number' => $order_number,
            'received_no' => $received_no,
            'input_data' => $inputName,
            'wamoji_hiragana' => $hiragana,
            'wamoji_katakana' => $katakana,
            'wamoji' => $kanji,
            'sticker_picture' => $pdf,
            'data_picture' => $zip,
            'add_date' => $add_date,
        );

        $tblPrintImage->insertPrintImage($insert_data);

        if($zipname) {
            unlink($zipname);
        }
        if($pdfname) {
            unlink($pdfname);
        }

        return $received_no;
    }

    public function getPrintImage($facility_id, $order_number, $received_no) 
    {
        $tblPrintImage = new TblPrintImage;
        $zip_file = $tblPrintImage->getPrintImage($facility_id, $order_number, $received_no);

        return $zip_file;
    }

    public function getLanguageList() {
        $languageList = array();
        $mstLanguage = new MstLanguage();
        $data = $mstLanguage->getLanguageList();
        if($data) {
            foreach($data as $idx => $language) {
                $dt = array();
                $dt['language_code'] = $language->language_code;
                $dt['language_name'] = $language->language_name;
                array_push($languageList, $dt);
            }
        }
        return $languageList;
    }
}
