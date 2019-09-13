<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcessLog extends Model
{
    protected $table = 'process_log';
    public $timestamps = false;

    public const LOG_LEVEL_ERROR = 0;
    public const LOG_LEVEL_WARN  = 1;
    public const LOG_LEVEL_INFO  = 2;
    public const LOG_LEVEL_TRACE = 3;
    
    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }

    public function Error($facility_id, $terminal_id, $screen_no, $information)
    {
        $this->insertLog($facility_id, $terminal_id, $screen_no, self::LOG_LEVEL_ERROR, $information);
    }

    public function Warn($facility_id, $terminal_id, $screen_no, $information)
    {
        $this->insertLog($facility_id, $terminal_id, $screen_no, self::LOG_LEVEL_WARN, $information);
    }

    public function Info($facility_id, $terminal_id, $screen_no, $information)
    {
        $this->insertLog($facility_id, $terminal_id, $screen_no, self::LOG_LEVEL_INFO, $information);
    }

    public function Trace($facility_id, $terminal_id, $screen_no, $information)
    {
        $this->insertLog($facility_id, $terminal_id, $screen_no, self::LOG_LEVEL_TRACE, $information);
    }

    private function insertLog($facility_id, $terminal_id, $screen_no, $log_level, $information)
    {
        DB::table($this->table)->insert(
            array(
                'facility_id' => $facility_id, 
                'terminal_id' => $terminal_id,
                'screen_no' => $screen_no,
                'log_level' => $log_level,
                'information' => $information,
                )
        );
    }
}
