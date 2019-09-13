<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use App\Models\ModelSelectDesign;
use App\Http\Requests\DesignRequest;
use App\Models\ModelWamojiya;
use App\Models\ModelImage;
use App\Models\ModelArchiver;
use App\Models\ModelLog;
use App;

class ConvertController extends Controller
{
    private const PAGE_ERROR = 'error';
    private const PAGE_INDEX = 'index';
    private const PAGE_CONVERT = 'convert';
    private const PAGE_LUCKY_NAME = 'luckyName';
    private const PAGE_KANJI_SELECT = 'kanjiSelect';
    private const PAGE_SELECT_DESIGN = 'selectDesign';
    private const PAGE_PURCHASE = 'purchase';
    private const PAGE_CREATE_DATA = 'createData';
    private const PAGE_COMPLETE = 'complete';
    private const PAGE_DOWNLOAD = 'download';

    private const B2C_TEST_FLG = true;
    
    // function error_handler($errno, $errstr, $errfile, $errline) {

    // }

    // set_error_handler(array($this, 'error_handler'));
    // // set_exception_handler(function ($errno, $errstr, $errfile, $errline) {
        
    // // });

    public function index(Request $request, Response $response) {
        $log = null;
        try {
            $session = $request->session();
            $auth = $request->session()->get('logined');
            $facility_id = $request->session()->get('login_facility_id');
            $language_code = $request->session()->get('language_code');
            App::setLocale($language_code);
            $data = [
                'url' => $request->input('url'),
                'uri' => $request->input('uri'),
                'auth' => $auth,
                'language_code' => $language_code,
            ];
            $log = new ModelLog($facility_id, self::PAGE_INDEX);   
            $log->trace($log->getTraceInfo('パラメータ', $request));
            if($auth) {
                $log->trace('[' . self::PAGE_CONVERT . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_CONVERT, $data);
            } else {
                $log->trace('[' . self::PAGE_INDEX + ']表示 data = ' . json_encode($data));
                return view(self::PAGE_INDEX, $data);
            }
        } catch(Exception $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_INDEX);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_INDEX);
            }
            $log->Error($ex->getMessage());
            // return view(self::PAGE_ERROR, $data);
        }
    }

    public function luckyName(Request $request, Response $response) {
        $log = null;
        try {
            $session = $request->session();
            $auth = $request->session()->get('logined');
            $facility_id = $request->session()->get('login_facility_id');
            $language_code = $request->session()->get('language_code');
            App::setLocale($language_code);
            date_default_timezone_set('Asia/Tokyo');
            $data = [
                'url' => $request->input('url'),
                'uri' => $request->input('uri'),
                'auth' => $auth,
                'language_code' => $language_code,
                'max_length' => Config::get('wamoji.lucky_name_length'),
                'start_time' => date("Y/m/d H:i:s"),
                'errorMessageName' => __('luckyName.error_message_name'),
                'errorMessageKana' => __('luckyName.error_message_kana'),
            ];
            $log = new ModelLog($facility_id, self::PAGE_LUCKY_NAME);            
            $log->trace($log->getTraceInfo('パラメータ', $request));
            if($auth) {
                $log->trace('[' . self::PAGE_LUCKY_NAME . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_LUCKY_NAME, $data);
            } else {
                $log->trace('[' . self::PAGE_INDEX . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_INDEX, $data);
            }
        } catch(Exception $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_LUCKY_NAME);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_LUCKY_NAME);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        }
    }

    public function kanjiSelect(Request $request, Response $response) {
        $log = null;
        try {
            $session = $request->session();
            $auth = $request->session()->get('logined');
            $facility_id = $request->session()->get('login_facility_id');
            $language_code = $request->session()->get('language_code');
            App::setLocale($language_code);
            date_default_timezone_set('Asia/Tokyo');
            $data = [
                'url' => $request->input('url'),
                'uri' => $request->input('uri'),
                'auth' => $auth,
                'language_code' => $language_code,
                'max_length' => Config::get('wamoji.kanji_select_length'),
                'start_time' => date("Y/m/d H:i:s"),
                'errorMessageName' => __('kanjiSelect.error_message_name'),
                'errorMessageKana' => __('kanjiSelect.error_message_kana'),
            ];
            $log = new ModelLog($facility_id, self::PAGE_KANJI_SELECT);            
            $log->trace($log->getTraceInfo('パラメータ', $request));
            if($auth) {
                $log->trace('[' . self::PAGE_KANJI_SELECT . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_KANJI_SELECT, $data);
            } else {
                $log->trace('[' . self::PAGE_INDEX . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_INDEX, $data);
            }
        } catch(Exception $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_KANJI_SELECT);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_KANJI_SELECT);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        }
    }

    public function selectDesign(Request $request, Response $response) {
        $log = null;
        try {
            $session = $request->session();
            $facility_id = $request->session()->get('login_facility_id');
            $auth = $request->session()->get('logined');
            $language_code = $request->session()->get('language_code');
            App::setLocale($language_code);
            $data = [
                'url' => $request->input('url'),
                'uri' => $request->input('uri'),
                'auth' => $auth,
                'language_code' => $language_code,
            ];
            $log = new ModelLog($facility_id, self::PAGE_SELECT_DESIGN);            
            $log->trace($log->getTraceInfo('パラメータ', $request));
            if($auth) {
                $inputType = $request->input('inputType');
                $inputName = $request->input('inputName');
                $convertResult = json_decode($request->input('convertResult'));
                $inputData = array('inputType' => $inputType, 'inputName' => $inputName, 'convertResult' => $convertResult);
                if($request->input('inputData') !== null) {
                    $inputData = json_decode($request->input('inputData'));
                }
                $convertType = $request->input('convertType');
                $selectDesign = new ModelSelectDesign($request);
                $designList = $selectDesign->getDesignList();
                $data['designList'] = $designList;
                $data['inputData'] = json_encode($inputData);
                $data['convertType'] = $convertType;
                $log->trace('[' . self::PAGE_SELECT_DESIGN . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_SELECT_DESIGN, $data);
            } else {
                $log->trace('[' . self::PAGE_INDEX . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_INDEX, $data);
            }
        } catch(Exception $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_SELECT_DESIGN);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_SELECT_DESIGN);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        }
    }

    public function purchase(Request $request, Response $response) {
        $log = null;
        try {
            $session = $request->session();
            $inputData = json_decode($request->input('inputData'));
            $auth = $request->session()->get('logined');
            $facility_id = $request->session()->get('login_facility_id');
            $language_code = $request->session()->get('language_code');
            $b2c = $request->session()->get('b2c');
            App::setLocale($language_code);
            $data = [
                'url' => $request->input('url'),
                'uri' => $request->input('uri'),
                'auth' => $auth,
                'language_code' => $language_code,
                'inputData' => json_encode($inputData),
            ];
            $log = new ModelLog($facility_id, self::PAGE_PURCHASE);            
            $log->trace($log->getTraceInfo('パラメータ', $request));
            if($auth) {
                $modelImage = new ModelImage;
                $design = $request->input('design');
                $data['design'] = $design;
                $symbol_type_cd = $request->input('symbol_type_cd');
                $data['symbol_type_cd'] = $symbol_type_cd;
                $convertType = $request->input('convertType');
                $convertResult = $inputData->convertResult;
                $hiragana = $convertResult->hiraganaName;
                $data['hiragana'] = $hiragana;
                $data['image_hiragana'] = $modelImage->getPurchaseImage($design, $symbol_type_cd, $hiragana);
                $katakana = $convertResult->katakanaName;
                $data['katakana'] = $katakana;
                $data['image_katakana'] = $modelImage->getPurchaseImage($design, $symbol_type_cd, $katakana);
                $kanji = $convertResult->kanjiName;
                $data['kanji'] = $kanji;
                $data['image_kanji'] = $modelImage->getPurchaseImage($design, $symbol_type_cd, $kanji);
                $data['convertType'] = $convertType;
                $data['b2c_test'] = $b2c & self::B2C_TEST_FLG;
                $log->trace('[' . self::PAGE_PURCHASE . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_PURCHASE, $data);
            } else {
                $log->trace('[' . self::PAGE_INDEX . ']表示 data = ' . json_encode($data));
                return view(self::PAGE_INDEX, $data);
            }
        } catch(Exception $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_PURCHASE);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_PURCHASE);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        }
    }

    public function createData(Request $request, Response $response) {
        $log = null;
        try {
            $session = $request->session();
            $inputData = json_decode($request->input('inputData'));
            $auth = $request->session()->get('logined');
            $facility_id = $request->session()->get('login_facility_id');
            $language_code = $request->session()->get('language_code');
            App::setLocale($language_code);
            $design = $request->input('design');
            $symbol_type_cd = $request->input('symbol_type_cd');
            $data = [
                'url' => $request->input('url'),
                'uri' => $request->input('uri'),
                'auth' => $auth,
                'language_code' => $language_code,
                'inputData' => json_encode($inputData),
                'redirect_time' => Config::get('wamoji.redirect_time'),
            ];
            $log = new ModelLog($facility_id, self::PAGE_CREATE_DATA);            
            $log->trace($log->getTraceInfo('パラメータ', $request));
            if($auth) {
                date_default_timezone_set('Asia/Tokyo');
                $end_time = date("Y/m/d H:i:s");

                $modelImage = new ModelImage;
                $convertResult = $inputData->convertResult;
                $convertResult->design = $design;
                $convertResult->symbol_type_cd = $symbol_type_cd;
                $convertResult->session_id = $session->getId();
                $convertResult->facility_id = $facility_id;
                $convertResult->language_code = $language_code;
                $hiragana = $convertResult->hiraganaName;
                $katakana = $convertResult->katakanaName;
                $kanji = $convertResult->kanjiName;
                $textImage = null;
                $zipname = null;
                $b2c = $request->session()->get('b2c');

                // テキストイメージ作成
                $textImage = $modelImage->createTextImage($hiragana, $katakana, $kanji);

                // シールPDF作成
                $pdfname = $modelImage->createSealPdf($convertResult);

                // ファイルの圧縮
                $modelArchiver = new ModelArchiver($session->getId());
                $zipname = $modelArchiver->createTextImageZip($textImage, $pdfname);

                // 漢字使用数登録
                $modelWamojiya = new ModelWamojiya($request);
                $modelWamojiya->saveKanjiData($kanji);

                // サービスデータ登録
                $order_number = $modelWamojiya->saveServiceData($facility_id, $convertResult, $end_time);

                // 印刷イメージ登録
                $uetsukeNo = $modelWamojiya->savePrintImage($facility_id, $order_number, $convertResult, $zipname, $pdfname);

                $data['uetsukeNo'] = $uetsukeNo;
                $data['orderNumber'] = $order_number;
                if(!$b2c) {
                    $log->trace('[' . self::PAGE_COMPLETE . ']表示 data = ' . json_encode($data));
                    return view(self::PAGE_COMPLETE, $data);
                } else {
                    $data['zipfilename'] = $zipname;
                    $log->trace('[' . self::PAGE_DOWNLOAD . ']表示 data = ' . json_encode($data));
                    return view(self::PAGE_DOWNLOAD, $data);
                }
            } else {
                $log->trace('[' . self::PAGE_INDEX . ']表示 data = ' . json_encode($data) );
                return view(self::PAGE_INDEX, $data);
            }
        } catch(Exception $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_CREATE_DATA);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::PAGE_CREATE_DATA);
            }
            $log->Error($ex->getMessage());
            return view(self::PAGE_ERROR, $data);
        }
    }
}
