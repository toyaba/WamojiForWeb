<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstSymbolImage extends Model
{
    protected $table = 'MST_SYMBOL_IMAGE';
    protected $guarded = array('category_cd', 'picture_type_cd', 'item_cd', 'size_cd', 'font_cd', 'symbol_type_cd');
    public $timestamps = false;

    public const SIZE_NONE = 99;
    public const FONT_NONE = 99;

    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }

    public function getSymbolImage($category_cd, $picture_type_cd, $item_cd, $size_cd, $font_cd, $symbol_type_cd, $enable_flg = true) 
    {
      $query = DB::table($this->table);
  
      if($category_cd) {
        $query->where('category_cd', $category_cd);
      }
      if($picture_type_cd) {
        $query->where('picture_type_cd', $picture_type_cd);
      }
      if($item_cd) {
        $query->where('item_cd', $item_cd);
      }
      if($size_cd) {
        $query->where('size_cd', $itemsize_cd_cd);
      }
      if($font_cd) {
        $query->where('font_cd', $font_cd);
      }
      if($symbol_type_cd) {
        $query->where('symbol_type_cd', $symbol_type_cd);
      }
      $query->where('enable_flg', $enable_flg);
      $data = $query->get();

      return $data;
    }

    public function getImage($category_cd, $picture_type_cd, $item_cd, $size_cd, $font_cd, $symbol_type_cd, $enable_flg = true) 
    {
      $image = null;
      $query = DB::table($this->table);
  
      if($category_cd && $picture_type_cd && $item_cd && $size_cd && $font_cd && $symbol_type_cd) {
        $query->where('category_cd', $category_cd);
        $query->where('picture_type_cd', $picture_type_cd);
        $query->where('item_cd', $item_cd);
        $query->where('size_cd', $size_cd);
        $query->where('font_cd', $font_cd);
        $query->where('symbol_type_cd', $symbol_type_cd);
        $query->where('enable_flg', $enable_flg);
        $data = $query->get();
        if($data) {
          $image = $data[0]->picture;
        }
      }
      return $image;
    }
}
