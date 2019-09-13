<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstPr extends Model
{
    protected $table = 'MST_PR';
    protected $guarded = array('pr_cd');
    public $timestamps = false;

    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }

    public function getPrImage($pr_cd) {
      $image = null;
      $query = DB::table($this->table);

      if($pr_cd) {
        $query->where('pr_cd', $pr_cd);
        $data = $query->get();
        if($data) {
          $image = $data[0]->pr_picture;
        }
      }
      return $image;
    }
}
