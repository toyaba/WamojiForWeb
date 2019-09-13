<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
// use Illuminate\Database\Eloquent\Model;
use App\Models\Elements\ProcessLog;

class ModelLog /* extends Model */
{
    private $processLog;
    private $facility_id;
    private $terminal_id;
    private $screen_no;
    private $log_level;
    function __construct($facility_id, $screen_no) {
        $this->log_level = Config::get('wamoji.log_level');
        $this->processLog = new ProcessLog();
        $this->facility_id = $facility_id ? $facility_id : 'Not Loginned';
        $this->terminal_id = $_SERVER["REMOTE_ADDR"];
        $this->screen_no = $screen_no;
    }

    public function Error($information) {
        $this->processLog->Error($this->facility_id, $this->terminal_id, $this->screen_no, $information);
    }

    public function Warn($information) {
        $this->processLog->Warn($this->facility_id, $this->terminal_id, $this->screen_no, $information);
    }

    public function Info($information) {
        if($this->log_level >= ProcessLog::LOG_LEVEL_INFO) {
            $this->processLog->Info($this->facility_id, $this->terminal_id, $this->screen_no, $information);
        }
    }

    public function Trace($information) {
        if($this->log_level >= ProcessLog::LOG_LEVEL_TRACE) {
            $this->processLog->Trace($this->facility_id, $this->terminal_id, $this->screen_no, $information);
        }
    }

    public function getTraceInfo($message, $request) {
        $info = '';
        if($message) {
            $info = $message . ':';
        }
        $info = $info . " session = " . json_encode($request->session());
        $info = $info . " input param = " . json_encode($request->input());
        return $info;
    }
}