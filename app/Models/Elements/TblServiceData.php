<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TblServiceData extends Model
{
    protected $table = 'tbl_service_data';
    protected $guarded = array('order_number');
    public $timestamps = false;
    const ORDER_NUMBER_BASE = 100000;

    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }

    public function getOrderNumber() {
      date_default_timezone_set('Asia/Tokyo');
      $year = intval(date("Y"));
      $base = $year * self::ORDER_NUMBER_BASE;
      
      $query = DB::table($this->table);
      $order_number = $query->max('order_number');
      if($order_number == 0) {
        $order_number = $base + 1;
      } else {
        $order_year = intdiv($order_number, self::ORDER_NUMBER_BASE);
        if($order_year == $year) {
          $order_number = $order_number + 1;
        } else {
          $order_number = $base + 1;
        }
      }

      return $order_number;
    }

    public function insertServiceData($insert_data) {
      DB::table($this->table)->insert($insert_data);
    }
}
