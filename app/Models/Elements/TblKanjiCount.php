<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TblKanjiCount extends Model
{
  protected $table = 'TBL_KANJI_COUNT';
  protected $guarded = array('kanji');
  public $timestamps = false;

  public function getData()
  {
    $data = DB::table($this->table)->get();
    return $data;
  }

  public function setKanji($kanji) {
    $query = DB::table($this->table);
    $query->where('kanji', $kanji);
    $data = $query->get();

    date_default_timezone_set('Asia/Tokyo');
    if($data && count($data) > 0) {
      DB::table($this->table)
        ->where('kanji', $kanji)
        ->update(
          array(
            'kanji_count' => $data[0]->kanji_count + 1,
            'update_time' => date("Y/m/d H:i:s"),
            )
        );
    } else {
      DB::table($this->table)->insert(
        array(
            'kanji' => $kanji, 
            'kanji_count' => 1,
            )
      );
    }
  }
}
