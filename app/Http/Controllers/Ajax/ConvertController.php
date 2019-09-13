<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\LuckyNameRequest;
use App\Http\Requests\ConvertKanjiRequest;
use App\Http\Requests\ZipFileRequest;
use App\Http\Controllers\Controller;
use App\Models\ModelConvertSystem;
use App\Models\ModelWamojiya;
use App\Models\ModelLog;

class ConvertController extends Controller
{
    private const GET_LUCKY_NAME = 'Ajax/getLuckyName';
    private const GET_CONVERT_KANJI = 'Ajax/convertKanji';
    private const GET_ZIP_FILE = 'Ajax/getZipFile';
 
    public function getLuckyName(LuckyNameRequest $request) {
        $log = null;

        try {
            $convertSystem = new ModelConvertSystem;

            $facility_id = $request->session()->get('login_facility_id');
            $log = new ModelLog($facility_id, self::GET_LUCKY_NAME);

            $log->trace($log->getTraceInfo('パラメータ', $request));

            $language = $request->input('language');
            $gender = $request->input('gender');
            $inputType = $request->input('inputType');
            $inputName = $request->input('inputName');
            $maxLength = $request->input('max_length');
            $startTime = $request->input('start_time');
    
            $inputParam = array(
                "language" => $language,
                "gender" => $gender,
                "inputName" => $inputName,
                "inputNameType" => $inputType, // en:アルファベット/ja:カタカナ
                "kanjiCandidateMax" => 5, //Config::get('wamoji.kanji_candidate_max'),
                "isGogyoMode" => 1, // ラッキーネーム
                "outputNameLengthMax" => $maxLength,
                "kunYomiLengthMax" => 1,
                "pnValueMin" => -0.5,
    //            "modifiedKanjiName" => 'modifiedKanjiName', // ???
            );
    
            $result = json_decode($convertSystem->convert(json_encode($inputParam)));
            $result->type = 1;
            $result->start_time = $startTime;
            $log->trace('変換結果：'.json_encode($result));
            
            return response()->json($result);
        } catch(Exceptio $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::GET_LUCKY_NAME);
            }
            $log->Error($ex->getMessage());
            http_response_code(400);
            $result = new \stdClass;
            $result->error = $ex->getMessage();
            return response()->json($result);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::GET_LUCKY_NAME);
            }
            $log->Error($ex->getMessage());
            http_response_code(400);
            $result = new \stdClass;
            $result->error = $ex->getMessage();
            return response()->json($result);
        }
    }

    public function convertKanji(ConvertKanjiRequest $request) {
        $log = null;

        try {
            $convertSystem = new ModelConvertSystem;

            $facility_id = $request->session()->get('login_facility_id');
            $log = new ModelLog($facility_id, self::GET_CONVERT_KANJI);

            $log->trace($log->getTraceInfo('パラメータ', $request));

            $language = $request->input('language');
            $gender = $request->input('gender');
            $inputType = $request->input('inputType');
            $inputName = $request->input('inputName');
            $maxLength = $request->input('max_length');
            $startTime = $request->input('start_time');
    
            $inputParam = array(
                "language" => $language,
                "gender" => $gender,
                "inputName" => $inputName,
                "inputNameType" => $inputType, // en:アルファベット/ja:カタカナ
                "kanjiCandidateMax" => Config::get('wamoji.kanji_candidate_max'),
                "isGogyoMode" => 0, // 漢字変換
                "outputNameLengthMax" => $maxLength,
                "kunYomiLengthMax" => 1,
                "pnValueMin" => -0.5,
    //            "modifiedKanjiName" => 'modifiedKanjiName', // ???
            );
    
            $result = json_decode($convertSystem->convert(json_encode($inputParam)));
            $result->type = 2;
            $result->start_time = $startTime;
            $log->trace('変換結果：'.json_encode($result));
            
            return response()->json($result);
        } catch(Exceptio $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::GET_CONVERT_KANJI);
            }
            $log->Error($ex->getMessage());
            http_response_code(400);
            $result = new \stdClass;
            $result->error = $ex->getMessage();
            return response()->json($result);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::GET_CONVERT_KANJI);
            }
            $log->Error($ex->getMessage());
            http_response_code(400);
            $result = new \stdClass;
            $result->error = $ex->getMessage();
            return response()->json($result);
        }
    }

    public function getZipFile(ZipFileRequest $request) {
        $log = null;

        try {
            $wamojiya = new ModelWamojiya($request);

            $facility_id = $request->session()->get('login_facility_id');
            $log = new ModelLog($facility_id, self::GET_ZIP_FILE);

            $log->trace($log->getTraceInfo('パラメータ', $request));

            $received_no = $request->input('received_no');
            $order_number = $request->input('order_number');

            $zip_file = $wamojiya->getPrintImage($facility_id, $order_number, $received_no);
    
            $inputParam = array(
                "zip_file" => base64_encode($zip_file),
            );
    
            $result = $inputParam;
            $log->trace('変換結果：'.json_encode($result));
            
            return response()->json($result);
        } catch(Exceptio $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::GET_ZIP_FILE);
            }
            $log->Error($ex->getMessage());
            http_response_code(400);
            $result = new \stdClass;
            $result->error = $ex->getMessage();
            return response()->json($result);
        } catch(\Throwable $ex) {
            if(is_null($log)) {
                $log = new ModelLog('', self::GET_ZIP_FILE);
            }
            $log->Error($ex->getMessage());
            http_response_code(400);
            $result = new \stdClass;
            $result->error = $ex->getMessage();
            return response()->json($result);
        }
    }
}
