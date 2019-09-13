<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstSymbolType extends Model
{
    protected $table = 'MST_SYMBOL_TYPE';
    protected $guarded = array('category_cd', 'picture_type_cd', 'symbol_type_cd', 'language_cd');
    public $timestamps = false;

    public const DESIGN_SELECT = 1;
    public const DESIGN_USE    = 2;
    public const LUCKY_NAME    = 4;
    public const KANJI_SELECT  = 5;
    public const PICTURE_TYPE_NONE = 999;
    public const LANGUAGE_CD_NONE = 9999;

    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }

    public function getSymbolType($category_cd, $picture_type_cd, $symbol_type_cd, $language_cd, $enable_flg = true) 
    {
      $query = DB::table($this->table);
  
      if($category_cd) {
        $query->where('category_cd', $category_cd);
      }
      if($picture_type_cd) {
        $query->where('picture_type_cd', $picture_type_cd);
      }
      if($symbol_type_cd) {
        $query->where('symbol_type_cd', $symbol_type_cd);
      }
      if($language_cd) {
        $query->where('language_cd', $language_cd);
      }
      $query->where('enable_flg', $enable_flg);
      $data = $query->get();

      return $data;
    }
}
