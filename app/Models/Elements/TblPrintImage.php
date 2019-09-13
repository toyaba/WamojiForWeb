<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TblPrintImage extends Model
{
    protected $table = 'TBL_PRINT_IMAGE';
    protected $guarded = array('facility_id, order_number');
    public $timestamps = false;

    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }

    public function getReceivedNo($add_date) {
      $query = DB::table($this->table);
      $received_no = $query->where('add_date', $add_date)->max('received_no');
      
      if($received_no == 0) {
        $received_no = 1;
      } else {
        $received_no = $received_no + 1;
      }
      return $received_no;
    }

    public function insertPrintImage($insert_data) {
      DB::table($this->table)->insert($insert_data);
    }

    public function getPrintImage($facility_id, $order_number, $received_no) 
    {
      $zip = null;
      $query = DB::table($this->table);
  
      $query->where('facility_id', $facility_id);
      $query->where('order_number', $order_number);
      $query->where('received_no', $received_no);
      $data = $query->get();

      if($data) {
        $zip = $data[0]->data_picture;
      }

      return $zip;
    }
}
