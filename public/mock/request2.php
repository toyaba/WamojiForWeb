<?php
  $convert_data = array(
    'hiragana' => 'わもじたろう',
    'katakana' => 'ワモジタロウ',
    'kanji' => '和文字太路雨'
  );

  $kanji_data = array(
    array(
      '和' => 'sum',
      '話' => 'story',
      '輪' => 'ring',
    ),
    array(
      '文' => 'sentence',
      '藻' => 'algae',
      '母' => 'mother',
      '喪' => 'mourning',
    ),
    array(
      '字' => 'character',
      '次' => 'next',
      '時' => 'time',
      '二' => 'two',
      '寺' => 'temple',
    ),
    array(
      '太' => 'thick',
      '他' => 'other',
      '田' => 'rice field',
      '多' => 'many',
      '足' => 'leg',
      '長' => 'length',
      '食' => 'meal',
    ),
    array(
      '路' => 'road',
      '炉' => 'furnace',
      '露' => 'dew'
    ),
    array(
      '雨' => 'rain',
      '卯' => 'rabbit',
      '鵜' => 'cormorant',
      '雨' => 'rain',
      '卯' => 'rabbit',
      '鵜' => 'cormorant',
      '雨' => 'rain',
      '卯' => 'rabbit',
      '鵜' => 'cormorant',
      '雨' => 'rain',
      '卯' => 'rabbit',
      '鵜' => 'cormorant',
      '雨' => 'rain',
      '卯' => 'rabbit',
      '鵜' => 'cormorant',
      '雨' => 'rain',
      '卯' => 'rabbit',
      '鵜' => 'cormorant',
    ),
  );

  $data = array(
    'convert_data' => $convert_data,
    'kanji_data' => $kanji_data
  );

  echo json_encode($data);