<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstGogyoShisou extends Model
{
    protected $table = 'MST_GOGYO_SHISOU';
    protected $guarded = array('gogyo_cd');
    public $timestamps = false;

    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }
    public function getImage($gogyo_cd) 
    {
      $image = null;
      $query = DB::table($this->table);
  
      if($gogyo_cd) {
        $query->where('gogyo_cd', $gogyo_cd);
        $data = $query->get();
        if($data) {
          $image = $data[0]->gogyo_picture;
        }
      }
      return $image;
    }
}
