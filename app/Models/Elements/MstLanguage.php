<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstLanguage extends Model
{
    protected $table = 'MST_LANGUAGE';
    protected $guarded = array('language_cd');
    public $timestamps = false;

    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }

    public function getLanguageList()
    {
      $query = DB::table($this->table);
      $query->where('enable_flg', 1);
      $data = $query->get();
      return $data;
    }

    public function getLanguageCd($language_code)
    {
      $language_cd = null;

      $query = DB::table($this->table);
      $query->where('language_code', $language_code);
      $query->where('enable_flg', 1);
      $data = $query->get();
      if($data) {
        $language_cd = $data[0]->language_cd;
      }
      return $language_cd;
    }

}
