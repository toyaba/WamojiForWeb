<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Elements\MstSymbolType;
use App\Models\Elements\MstSymbolImage;
use App\Models\Elements\MstGogyoShisou;
use App\Models\Elements\MstFacility;
use App\Models\Elements\MstPr;
use TCPDF;

class ModelImage /* extends Model */
{
    private const ANGLE = 0;
    
    private const DESIGN_IMAGE_INFO = array(
        array('size' => 48, 'angle' => self::ANGLE, 'width' => 140, 'height' => 70),  // 1
        array('size' => 48, 'angle' => self::ANGLE, 'width' => 110, 'height' => 70),  // 2
        array('size' => 48, 'angle' => self::ANGLE, 'width' =>  85, 'height' => 70),  // 3
        array('size' => 48, 'angle' => self::ANGLE, 'width' =>  50, 'height' => 70),  // 4
        array('size' => 48, 'angle' => self::ANGLE, 'width' =>  15, 'height' => 70),  // 5
        array('size' => 42, 'angle' => self::ANGLE, 'width' =>   7, 'height' => 68),  // 6
        array('size' => 36, 'angle' => self::ANGLE, 'width' =>   7, 'height' => 68),  // 7
        array('size' => 32, 'angle' => self::ANGLE, 'width' =>   5, 'height' => 68),  // 8
        array('size' => 28, 'angle' => self::ANGLE, 'width' =>   5, 'height' => 65),  // 9
        array('size' => 25, 'angle' => self::ANGLE, 'width' =>  10, 'height' => 65),  // 10
        array('size' => 23, 'angle' => self::ANGLE, 'width' =>   7, 'height' => 61),  // 11
        array('size' => 20, 'angle' => self::ANGLE, 'width' =>  15, 'height' => 60),  // 12
    );

    // 3600 x 1130
    private const LANDSCAPE_IMAGE_INFO = array(
        array('size' => 850, 'angle' => self::ANGLE, 'width' => 1200, 'height' => 1000),  // 1
        array('size' => 850, 'angle' => self::ANGLE, 'width' =>  600, 'height' => 1000),  // 2
        array('size' => 850, 'angle' => self::ANGLE, 'width' =>    0, 'height' => 1000),  // 3
        array('size' => 650, 'angle' => self::ANGLE, 'width' =>    0, 'height' =>  900),  // 4
        array('size' => 510, 'angle' => self::ANGLE, 'width' =>  100, 'height' =>  800),  // 5
        array('size' => 410, 'angle' => self::ANGLE, 'width' =>  140, 'height' =>  730),  // 6
        array('size' => 360, 'angle' => self::ANGLE, 'width' =>  120, 'height' =>  720),  // 7
        array('size' => 320, 'angle' => self::ANGLE, 'width' =>  100, 'height' =>  680),  // 8
        array('size' => 280, 'angle' => self::ANGLE, 'width' =>  100, 'height' =>  650),  // 9
        array('size' => 250, 'angle' => self::ANGLE, 'width' =>  120, 'height' =>  620),  // 10
        array('size' => 230, 'angle' => self::ANGLE, 'width' =>  100, 'height' =>  610),  // 11
        array('size' => 210, 'angle' => self::ANGLE, 'width' =>  100, 'height' =>  600),  // 12
    );

    // 1130 x 3600
    private const PORTRAIT_IMAGE_INFO = array(
        array('size' => 850, 'angle' => self::ANGLE, 'width' =>  10, 'height' => 2200),  // 1
        array('size' => 850, 'angle' => self::ANGLE, 'width' =>  10, 'height' => 1600),  // 2
        array('size' => 850, 'angle' => self::ANGLE, 'width' =>  10, 'height' => 1000),  // 3
        array('size' => 650, 'angle' => self::ANGLE, 'width' => 120, 'height' =>  750),  // 4
        array('size' => 510, 'angle' => self::ANGLE, 'width' => 200, 'height' =>  600),  // 5
        array('size' => 410, 'angle' => self::ANGLE, 'width' => 250, 'height' =>  550),  // 6
        array('size' => 360, 'angle' => self::ANGLE, 'width' => 300, 'height' =>  450),  // 7
        array('size' => 320, 'angle' => self::ANGLE, 'width' => 310, 'height' =>  400),  // 8
        array('size' => 280, 'angle' => self::ANGLE, 'width' => 380, 'height' =>  360),  // 9
        array('size' => 250, 'angle' => self::ANGLE, 'width' => 410, 'height' =>  350),  // 10
        array('size' => 230, 'angle' => self::ANGLE, 'width' => 430, 'height' =>  320),  // 11
        array('size' => 210, 'angle' => self::ANGLE, 'width' => 450, 'height' =>  280),  // 12
    );

    private const KANJI_LARGE_INFO_11 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 403, 'height' => 185),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 373, 'height' => 185),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 344, 'height' => 185),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 315, 'height' => 185),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 286, 'height' => 185),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 257, 'height' => 185),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 228, 'height' => 185),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 198, 'height' => 185),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 169, 'height' => 185),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 140, 'height' => 185),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 112, 'height' => 185),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  82, 'height' => 185),  // 12
    );
    private const KANJI_LARGE_INFO_12 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1212, 'height' => 185),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1182, 'height' => 185),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1153, 'height' => 185),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1124, 'height' => 185),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1095, 'height' => 185),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1066, 'height' => 185),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1037, 'height' => 185),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1007, 'height' => 185),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  978, 'height' => 185),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  949, 'height' => 185),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  921, 'height' => 185),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  891, 'height' => 185),  // 12
    );
    private const KANJI_LARGE_INFO_13 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 2021, 'height' => 185),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1991, 'height' => 185),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1962, 'height' => 185),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1933, 'height' => 185),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1904, 'height' => 185),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1875, 'height' => 185),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1846, 'height' => 185),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1816, 'height' => 185),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1787, 'height' => 185),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1758, 'height' => 185),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1730, 'height' => 185),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1700, 'height' => 185),  // 12
    );
    private const KANJI_LARGE_INFO_21 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 403, 'height' => 445),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 373, 'height' => 445),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 344, 'height' => 445),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 315, 'height' => 445),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 286, 'height' => 445),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 257, 'height' => 445),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 228, 'height' => 445),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 198, 'height' => 445),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 169, 'height' => 445),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 140, 'height' => 445),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 112, 'height' => 445),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  82, 'height' => 445),  // 12
    );
    private const KANJI_LARGE_INFO_22 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1212, 'height' => 445),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1182, 'height' => 445),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1153, 'height' => 445),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1124, 'height' => 445),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1095, 'height' => 445),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1066, 'height' => 445),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1037, 'height' => 445),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1007, 'height' => 445),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  978, 'height' => 445),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  949, 'height' => 445),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  921, 'height' => 445),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  891, 'height' => 445),  // 12
    );
    private const KANJI_LARGE_INFO_23 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 2021, 'height' => 445),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1991, 'height' => 445),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1962, 'height' => 445),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1933, 'height' => 445),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1904, 'height' => 445),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1875, 'height' => 445),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1846, 'height' => 445),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1816, 'height' => 445),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1787, 'height' => 445),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1758, 'height' => 445),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1730, 'height' => 445),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1700, 'height' => 445),  // 12
    );
    private const KATAKANA_LARGE_INFO_11 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 403, 'height' => 705),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 373, 'height' => 705),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 344, 'height' => 705),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 315, 'height' => 705),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 286, 'height' => 705),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 257, 'height' => 705),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 228, 'height' => 705),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 198, 'height' => 705),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 169, 'height' => 705),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 140, 'height' => 705),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 112, 'height' => 705),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  82, 'height' => 705),  // 12
    );
    private const KATAKANA_LARGE_INFO_12 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1212, 'height' => 705),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1182, 'height' => 705),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1153, 'height' => 705),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1124, 'height' => 705),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1095, 'height' => 705),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1066, 'height' => 705),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1037, 'height' => 705),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1007, 'height' => 705),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  978, 'height' => 705),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  949, 'height' => 705),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  921, 'height' => 705),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  891, 'height' => 705),  // 12
    );
    private const KATAKANA_LARGE_INFO_13 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 2021, 'height' => 705),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1991, 'height' => 705),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1962, 'height' => 705),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1933, 'height' => 705),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1904, 'height' => 705),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1875, 'height' => 705),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1846, 'height' => 705),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1816, 'height' => 705),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1787, 'height' => 705),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1758, 'height' => 705),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1730, 'height' => 705),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1700, 'height' => 705),  // 12
    );
    private const HIRAGANA_LARGE_INFO_11 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 403, 'height' => 965),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 373, 'height' => 965),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 344, 'height' => 965),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 315, 'height' => 965),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 286, 'height' => 965),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 257, 'height' => 965),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 228, 'height' => 965),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 198, 'height' => 965),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 169, 'height' => 965),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 140, 'height' => 965),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 112, 'height' => 965),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  82, 'height' => 965),  // 12
    );
    private const HIRAGANA_LARGE_INFO_12 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1212, 'height' => 965),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1182, 'height' => 965),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1153, 'height' => 965),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1124, 'height' => 965),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1095, 'height' => 965),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1066, 'height' => 965),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1037, 'height' => 965),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1007, 'height' => 965),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  978, 'height' => 965),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  949, 'height' => 965),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  921, 'height' => 965),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' =>  891, 'height' => 965),  // 12
    );
    private const HIRAGANA_LARGE_INFO_13 = array(
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 2021, 'height' => 965),  // 1
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1991, 'height' => 965),  // 2
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1962, 'height' => 965),  // 3
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1933, 'height' => 965),  // 4
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1904, 'height' => 965),  // 5
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1875, 'height' => 965),  // 6
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1846, 'height' => 965),  // 7
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1816, 'height' => 965),  // 8
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1787, 'height' => 965),  // 9
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1758, 'height' => 965),  // 10
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1730, 'height' => 965),  // 11
        array('size' => 58.33, 'angle' => self::ANGLE, 'width' => 1700, 'height' => 965),  // 12
    );
    private const KANJI_LARGE_ROW_INFO_1 = array(
        self::KANJI_LARGE_INFO_11,
        self::KANJI_LARGE_INFO_12,
        self::KANJI_LARGE_INFO_13,
    );
    private const KANJI_LARGE_ROW_INFO_2 = array(
        self::KANJI_LARGE_INFO_21,
        self::KANJI_LARGE_INFO_22,
        self::KANJI_LARGE_INFO_23,
    );
    private const KATAKANA_LARGE_ROW_INFO_1 = array(
        self::KATAKANA_LARGE_INFO_11,
        self::KATAKANA_LARGE_INFO_12,
        self::KATAKANA_LARGE_INFO_13,
    );
    private const HIRAGANA_LARGE_ROW_INFO_1 = array(
        self::HIRAGANA_LARGE_INFO_11,
        self::HIRAGANA_LARGE_INFO_12,
        self::HIRAGANA_LARGE_INFO_13,
    );
    private const KANJI_LARGE_IMAGE_INFO = array(
        self::KANJI_LARGE_ROW_INFO_1,
        self::KANJI_LARGE_ROW_INFO_2,
    );
    private const KATAKANA_LARGE_IMAGE_INFO = array(
        self::KATAKANA_LARGE_ROW_INFO_1,
    );
    private const HIRAGANA_LARGE_IMAGE_INFO = array(
        self::HIRAGANA_LARGE_ROW_INFO_1,
    );

    private const KANJI_SMALL_INFO_11 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 311, 'height' => 1225),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 288, 'height' => 1225),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 265, 'height' => 1225),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 242, 'height' => 1225),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 216, 'height' => 1225),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 196, 'height' => 1225),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 173, 'height' => 1225),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 150, 'height' => 1225),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 127, 'height' => 1225),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 105, 'height' => 1225),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' =>  82, 'height' => 1225),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' =>  59, 'height' => 1225),  // 12
    );
    private const KANJI_SMALL_INFO_12 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 917, 'height' => 1225),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 894, 'height' => 1225),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 871, 'height' => 1225),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 848, 'height' => 1225),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 822, 'height' => 1225),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 802, 'height' => 1225),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 779, 'height' => 1225),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 756, 'height' => 1225),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 733, 'height' => 1225),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 711, 'height' => 1225),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 688, 'height' => 1225),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 665, 'height' => 1225),  // 12
    );
    private const KANJI_SMALL_INFO_13 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1523, 'height' => 1225),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1500, 'height' => 1225),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1477, 'height' => 1225),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1454, 'height' => 1225),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1428, 'height' => 1225),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1408, 'height' => 1225),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1385, 'height' => 1225),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1362, 'height' => 1225),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1339, 'height' => 1225),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1317, 'height' => 1225),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1294, 'height' => 1225),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1271, 'height' => 1225),  // 12
    );
    private const KANJI_SMALL_INFO_14 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2129, 'height' => 1225),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2106, 'height' => 1225),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2083, 'height' => 1225),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2060, 'height' => 1225),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2034, 'height' => 1225),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2014, 'height' => 1225),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1991, 'height' => 1225),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1968, 'height' => 1225),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1945, 'height' => 1225),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1923, 'height' => 1225),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1900, 'height' => 1225),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1877, 'height' => 1225),  // 12
    );
    private const KANJI_SMALL_INFO_21 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 311, 'height' => 1485),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 288, 'height' => 1485),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 265, 'height' => 1485),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 242, 'height' => 1485),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 216, 'height' => 1485),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 196, 'height' => 1485),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 173, 'height' => 1485),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 150, 'height' => 1485),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 127, 'height' => 1485),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 105, 'height' => 1485),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' =>  82, 'height' => 1485),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' =>  59, 'height' => 1485),  // 12
    );
    private const KANJI_SMALL_INFO_22 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 917, 'height' => 1485),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 894, 'height' => 1485),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 871, 'height' => 1485),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 848, 'height' => 1485),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 822, 'height' => 1485),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 802, 'height' => 1485),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 779, 'height' => 1485),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 756, 'height' => 1485),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 733, 'height' => 1485),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 711, 'height' => 1485),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 688, 'height' => 1485),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 665, 'height' => 1485),  // 12
    );
    private const KANJI_SMALL_INFO_23 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1523, 'height' => 1485),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1500, 'height' => 1485),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1477, 'height' => 1485),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1454, 'height' => 1485),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1428, 'height' => 1485),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1408, 'height' => 1485),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1385, 'height' => 1485),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1362, 'height' => 1485),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1339, 'height' => 1485),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1317, 'height' => 1485),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1294, 'height' => 1485),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1271, 'height' => 1485),  // 12
    );
    private const KANJI_SMALL_INFO_24 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2129, 'height' => 1485),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2106, 'height' => 1485),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2083, 'height' => 1485),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2060, 'height' => 1485),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2034, 'height' => 1485),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2014, 'height' => 1485),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1991, 'height' => 1485),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1968, 'height' => 1485),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1945, 'height' => 1485),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1923, 'height' => 1485),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1900, 'height' => 1485),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1877, 'height' => 1485),  // 12
    );
    private const KATAKANA_SMALL_INFO_11 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 311, 'height' => 1745),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 288, 'height' => 1745),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 265, 'height' => 1745),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 242, 'height' => 1745),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 216, 'height' => 1745),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 196, 'height' => 1745),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 173, 'height' => 1745),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 150, 'height' => 1745),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 127, 'height' => 1745),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 105, 'height' => 1745),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' =>  82, 'height' => 1745),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' =>  59, 'height' => 1745),  // 12
    );
    private const KATAKANA_SMALL_INFO_12 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 917, 'height' => 1745),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 894, 'height' => 1745),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 871, 'height' => 1745),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 848, 'height' => 1745),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 822, 'height' => 1745),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 802, 'height' => 1745),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 779, 'height' => 1745),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 756, 'height' => 1745),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 733, 'height' => 1745),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 711, 'height' => 1745),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 688, 'height' => 1745),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 665, 'height' => 1745),  // 12
    );
    private const KATAKANA_SMALL_INFO_13 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1523, 'height' => 1745),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1500, 'height' => 1745),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1477, 'height' => 1745),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1454, 'height' => 1745),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1428, 'height' => 1745),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1408, 'height' => 1745),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1385, 'height' => 1745),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1362, 'height' => 1745),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1339, 'height' => 1745),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1317, 'height' => 1745),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1294, 'height' => 1745),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1271, 'height' => 1745),  // 12
    );
    private const KATAKANA_SMALL_INFO_14 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2129, 'height' => 1745),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2106, 'height' => 1745),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2083, 'height' => 1745),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2060, 'height' => 1745),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2034, 'height' => 1745),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2014, 'height' => 1745),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1991, 'height' => 1745),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1968, 'height' => 1745),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1945, 'height' => 1745),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1923, 'height' => 1745),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1900, 'height' => 1745),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1877, 'height' => 1745),  // 12
    );
    private const HIRAGANA_SMALL_INFO_11 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 311, 'height' => 2005),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 288, 'height' => 2005),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 265, 'height' => 2005),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 242, 'height' => 2005),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 216, 'height' => 2005),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 196, 'height' => 2005),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 173, 'height' => 2005),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 150, 'height' => 2005),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 127, 'height' => 2005),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 105, 'height' => 2005),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' =>  82, 'height' => 2005),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' =>  59, 'height' => 2005),  // 12
    );
    private const HIRAGANA_SMALL_INFO_12 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 917, 'height' => 2005),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 894, 'height' => 2005),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 871, 'height' => 2005),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 848, 'height' => 2005),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 822, 'height' => 2005),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 802, 'height' => 2005),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 779, 'height' => 2005),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 756, 'height' => 2005),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 733, 'height' => 2005),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 711, 'height' => 2005),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 688, 'height' => 2005),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 665, 'height' => 2005),  // 12
    );
    private const HIRAGANA_SMALL_INFO_13 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1523, 'height' => 2005),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1500, 'height' => 2005),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1477, 'height' => 2005),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1454, 'height' => 2005),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1428, 'height' => 2005),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1408, 'height' => 2005),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1385, 'height' => 2005),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1362, 'height' => 2005),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1339, 'height' => 2005),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1317, 'height' => 2005),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1294, 'height' => 2005),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1271, 'height' => 2005),  // 12
    );
    private const HIRAGANA_SMALL_INFO_14 = array(
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2129, 'height' => 2005),  // 1
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2106, 'height' => 2005),  // 2
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2083, 'height' => 2005),  // 3
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2060, 'height' => 2005),  // 4
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2034, 'height' => 2005),  // 5
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 2014, 'height' => 2005),  // 6
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1991, 'height' => 2005),  // 7
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1968, 'height' => 2005),  // 8
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1945, 'height' => 2005),  // 9
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1923, 'height' => 2005),  // 10
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1900, 'height' => 2005),  // 11
        array('size' => 45.83, 'angle' => self::ANGLE, 'width' => 1877, 'height' => 2005),  // 12
    );
    private const KANJI_SMALL_ROW_INFO_1 = array(
        self::KANJI_SMALL_INFO_11,
        self::KANJI_SMALL_INFO_12,
        self::KANJI_SMALL_INFO_13,
        self::KANJI_SMALL_INFO_14,
    );
    private const KANJI_SMALL_ROW_INFO_2 = array(
        self::KANJI_SMALL_INFO_21,
        self::KANJI_SMALL_INFO_22,
        self::KANJI_SMALL_INFO_23,
        self::KANJI_SMALL_INFO_24,
    );
    private const KATAKANA_SMALL_ROW_INFO_1 = array(
        self::KATAKANA_SMALL_INFO_11,
        self::KATAKANA_SMALL_INFO_12,
        self::KATAKANA_SMALL_INFO_13,
        self::KATAKANA_SMALL_INFO_14,
    );
    private const HIRAGANA_SMALL_ROW_INFO_1 = array(
        self::HIRAGANA_SMALL_INFO_11,
        self::HIRAGANA_SMALL_INFO_12,
        self::HIRAGANA_SMALL_INFO_13,
        self::HIRAGANA_SMALL_INFO_14,
    );
    private const KANJI_SMALL_IMAGE_INFO = array(
        self::KANJI_SMALL_ROW_INFO_1,
        self::KANJI_SMALL_ROW_INFO_2,
    );
    private const KATAKANA_SMALL_IMAGE_INFO = array(
        self::KATAKANA_SMALL_ROW_INFO_1,
    );
    private const HIRAGANA_SMALL_IMAGE_INFO = array(
        self::HIRAGANA_SMALL_ROW_INFO_1,
    );

    private const LUCKY_INPUT_NAME_IMAGE_INFO = array(
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' => 1215, 'height' => 2318),  // 1
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' => 1181, 'height' => 2318),  // 2
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' => 1148, 'height' => 2318),  // 3
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' => 1115, 'height' => 2318),  // 4
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' => 1081, 'height' => 2318),  // 5
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' => 1048, 'height' => 2318),  // 6
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' => 1015, 'height' => 2318),  // 7
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  985, 'height' => 2318),  // 8
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  952, 'height' => 2318),  // 9
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  915, 'height' => 2318),  // 10
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  886, 'height' => 2318),  // 11
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  852, 'height' => 2318),  // 12
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  819, 'height' => 2318),  // 13
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  785, 'height' => 2318),  // 14
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  749, 'height' => 2318),  // 15
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  715, 'height' => 2318),  // 16
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  682, 'height' => 2318),  // 17
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  652, 'height' => 2318),  // 18
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  621, 'height' => 2318),  // 19
        array('size' => 66.67, 'angle' => self::ANGLE, 'width' =>  581, 'height' => 2318),  // 20
    );

    private const LUCKY_KANJI_IMAGE_INFO = array(
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' =>  805, 'height' => 2508),  // 1
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1192, 'height' => 2508),  // 2
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1582, 'height' => 2508),  // 3
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1969, 'height' => 2508),  // 4
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' =>  805, 'height' => 2598),  // 5
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1192, 'height' => 2598),  // 6
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1582, 'height' => 2598),  // 7
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1969, 'height' => 2598),  // 8
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' =>  805, 'height' => 2688),  // 9
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1192, 'height' => 2688),  // 10
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1582, 'height' => 2688),  // 11
        array('size' => 57.33, 'angle' => self::ANGLE, 'width' => 1969, 'height' => 2688),  // 12
    );

    private const LUCKY_KANJI_INFO_IMAGE_INFO = array(
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' =>  870, 'height' => 2493),  // 1
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 1256, 'height' => 2493),  // 2
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 1644, 'height' => 2493),  // 3
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 2033, 'height' => 2493),  // 4
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' =>  870, 'height' => 2583),  // 5
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 1256, 'height' => 2583),  // 6
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 1644, 'height' => 2583),  // 7
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 2033, 'height' => 2583),  // 8
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' =>  870, 'height' => 2674),  // 9
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 1256, 'height' => 2674),  // 10
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 1644, 'height' => 2674),  // 11
        array('size' => 32.22, 'angle' => self::ANGLE, 'width' => 2033, 'height' => 2674),  // 12
    );

    private const INPUT_NAME_IMAGE_INFO = array(
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' => 1200, 'height' => 2372),  // 1
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' => 1148, 'height' => 2372),  // 2
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' => 1094, 'height' => 2372),  // 3
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' => 1044, 'height' => 2372),  // 4
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  992, 'height' => 2372),  // 5
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  940, 'height' => 2372),  // 6
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  889, 'height' => 2372),  // 7
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  842, 'height' => 2372),  // 8
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  791, 'height' => 2372),  // 9
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  732, 'height' => 2372),  // 10
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  686, 'height' => 2372),  // 11
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  634, 'height' => 2372),  // 12
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  583, 'height' => 2372),  // 13
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  528, 'height' => 2372),  // 14
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  473, 'height' => 2372),  // 15
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  419, 'height' => 2372),  // 16
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  369, 'height' => 2372),  // 17
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  323, 'height' => 2372),  // 18
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  272, 'height' => 2372),  // 19
        array('size' => 104.17, 'angle' => self::ANGLE, 'width' =>  211, 'height' => 2372),  // 20
    );

    private const KANJI_IMAGE_INFO = array(
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' =>  167, 'height' => 2647),  // 1
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' =>  720, 'height' => 2647),  // 2
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' => 1237, 'height' => 2647),  // 3
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' => 1826, 'height' => 2647),  // 4
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' =>  167, 'height' => 2843),  // 5
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' =>  720, 'height' => 2843),  // 6
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' => 1237, 'height' => 2843),  // 7
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' => 1826, 'height' => 2843),  // 8
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' =>  167, 'height' => 3040),  // 9
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' =>  720, 'height' => 3040),  // 10
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' => 1237, 'height' => 3040),  // 11
        array('size' => 91.67, 'angle' => self::ANGLE, 'width' => 1826, 'height' => 3040),  // 12
    );

    private const KANJI_INFO_IMAGE_INFO = array(
        array('size' => 50, 'angle' => self::ANGLE, 'width' =>  286, 'height' => 2626),  // 1
        array('size' => 50, 'angle' => self::ANGLE, 'width' =>  839, 'height' => 2626),  // 2
        array('size' => 50, 'angle' => self::ANGLE, 'width' => 1392, 'height' => 2626),  // 3
        array('size' => 50, 'angle' => self::ANGLE, 'width' => 1945, 'height' => 2626),  // 4
        array('size' => 50, 'angle' => self::ANGLE, 'width' =>  286, 'height' => 2823),  // 5
        array('size' => 50, 'angle' => self::ANGLE, 'width' =>  839, 'height' => 2823),  // 6
        array('size' => 50, 'angle' => self::ANGLE, 'width' => 1392, 'height' => 2823),  // 7
        array('size' => 50, 'angle' => self::ANGLE, 'width' => 1945, 'height' => 2823),  // 8
        array('size' => 50, 'angle' => self::ANGLE, 'width' =>  286, 'height' => 3020),  // 9
        array('size' => 50, 'angle' => self::ANGLE, 'width' =>  839, 'height' => 3020),  // 10
        array('size' => 50, 'angle' => self::ANGLE, 'width' => 1392, 'height' => 3020),  // 11
        array('size' => 50, 'angle' => self::ANGLE, 'width' => 1945, 'height' => 3020),  // 12
    );

    private function convertFontSize(float $size) {
        $dpi_base = 72;
        $dpi = 96;
        return $dpi_base / $dpi * $size;
    }

    public function getPurchaseImage($design, $symbol_type_cd, $text) {
        $mstSymbolImage = new MstSymbolImage();

        $mstSymboleType = new MstSymbolType();
        $category_cd = MstSymbolType::DESIGN_SELECT;
        $picture_type_cd = MstSymbolType::PICTURE_TYPE_NONE;
        $symbol_type_cd = intval($symbol_type_cd);
        $language_cd = MstSymbolType::LANGUAGE_CD_NONE;
        $size_cd = MstSymbolImage::SIZE_NONE;
        $font_cd = MstSymbolImage::FONT_NONE;
        $item_cd = intval($design);
        $symbol_image = $mstSymbolImage->getImage($category_cd, $picture_type_cd, $item_cd, $size_cd, $font_cd, $symbol_type_cd);

        $image = imagecreatefromstring($symbol_image);
        $textcolor = imagecolorallocate($image, 0, 0, 0);
        putenv('GDFONTPATH=' . realpath('.'));
        // $font = "fonts/SawarabiMincho-Regular";
        // $font = "fonts/sawarabi-mincho-medium";
        $font = "fonts/ipaexm";
        $info = self::DESIGN_IMAGE_INFO[mb_strlen($text) - 1];
        imagettftext($image, $info['size'], $info['angle'], $info['width'], $info['height'], $textcolor, $font, $text);

        ob_start();
        imagepng($image);
        $design_image = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);

        return base64_encode($design_image);
    }

    public function createTextImage($hiragana, $katakana, $kanji) {
        // hiragana
        $hiragana_landscape_resource = $this->createLandscapeImage($hiragana);
        $hiragana_landscape_reverse_resource = $this->createReverseImage($hiragana_landscape_resource, 3600, 1130);
        $hiragana_landscape = $this->captureImage($hiragana_landscape_resource);
        $hiragana_landscape_reverse = $this->captureImage($hiragana_landscape_reverse_resource);

        $hiragana_portrait_resource = $this->createPortraitImage($hiragana);
        $hiragana_portrait_reverse_resource = $this->createReverseImage($hiragana_portrait_resource, 1130, 3600);
        $hiragana_portrait = $this->captureImage($hiragana_portrait_resource);
        $hiragana_portrait_reverse = $this->captureImage($hiragana_portrait_reverse_resource);

        // katakana
        $katakana_landscape_resource = $this->createLandscapeImage($katakana);
        $katakana_landscape_reverse_resource = $this->createReverseImage($katakana_landscape_resource, 3600, 1130);
        $katakana_landscape = $this->captureImage($katakana_landscape_resource);
        $katakana_landscape_reverse = $this->captureImage($katakana_landscape_reverse_resource);

        $katakana_portrait_resource = $this->createPortraitImage($katakana);
        $katakana_portrait_reverse_resource = $this->createReverseImage($katakana_portrait_resource, 1130, 3600);
        $katakana_portrait = $this->captureImage($katakana_portrait_resource);
        $katakana_portrait_reverse = $this->captureImage($katakana_portrait_reverse_resource);

        // kanji
        $kanji_landscape_resource = $this->createLandscapeImage($kanji);
        $kanji_landscape_reverse_resource = $this->createReverseImage($kanji_landscape_resource, 3600, 1130);
        $kanji_landscape = $this->captureImage($kanji_landscape_resource);
        $kanji_landscape_reverse = $this->captureImage($kanji_landscape_reverse_resource);

        $kanji_portrait_resource = $this->createPortraitImage($kanji);
        $kanji_portrait_reverse_resource = $this->createReverseImage($kanji_portrait_resource, 1130, 3600);
        $kanji_portrait = $this->captureImage($kanji_portrait_resource);
        $kanji_portrait_reverse = $this->captureImage($kanji_portrait_reverse_resource);

        $images = array(
            'Landscape_Hiragana' => $hiragana_landscape,
            'Portrait_Hiragana' => $hiragana_portrait,
            'Landscape_Katakana' => $katakana_landscape,
            'Portrait_Katakana' => $katakana_portrait,
            'Landscape_Kanji' => $kanji_landscape,
            'Portrait_Kanji' => $kanji_portrait,
            'Landscape_Hiragana_Reverse' => $hiragana_landscape_reverse,
            'Portrait_Hiragana_Reverse' => $hiragana_portrait_reverse,
            'Landscape_Katakana_Reverse' => $katakana_landscape_reverse,
            'Portrait_Katakana_Reverse' => $katakana_portrait_reverse,
            'Landscape_Kanji_Reverse' => $kanji_landscape_reverse,
            'Portrait_Kanji_Reverse' => $kanji_portrait_reverse,
        );
        return $images;
    }

    private function getBackGroundColor($image) {
        return imagecolorallocate($image, 255, 255, 255);
    }

    private function captureImage($image) {
        $bg_color = $this->getBackGroundColor($image);
        imagecolortransparent($image, $bg_color);
        ob_start();
        imagepng($image);
        $result_image = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);

        return ($result_image);
    }

    private function createReverseImage($src, $width, $height) {
        $reverse = imagecreatetruecolor($width, $height);
        imagecopy($reverse, $src, 0, 0, 0, 0, $width, $height);
        imageflip($reverse, IMG_FLIP_HORIZONTAL);
        return $reverse;
    }

    private function createLandscapeImage($text) {
        $image = imagecreatetruecolor(3600, 1130);
        $bg_color = $this->getBackGroundColor($image);
        imagefilledrectangle($image, 0, 0, 3599, 1129, $bg_color);
        $textcolor = imagecolorallocate($image, 0, 0, 0);
        putenv('GDFONTPATH=' . realpath('.'));
        $font = "fonts/ipaexm";
        $info = self::LANDSCAPE_IMAGE_INFO[mb_strlen($text) - 1];
        imagettftext($image, $info['size'], $info['angle'], $info['width'], $info['height'], $textcolor, $font, $text);
        return $image;
    }

    private function createPortraitImage($text) {
        $image = imagecreatetruecolor(1130, 3600);
        $bg_color = $this->getBackGroundColor($image);
        imagefilledrectangle($image, 0, 0, 1129, 3599, $bg_color);
        $textcolor = imagecolorallocate($image, 0, 0, 0);
        putenv('GDFONTPATH=' . realpath('.'));
        $font = "fonts/ipaexm";
        $l = mb_strlen($text, 'UTF-8');
        $chunked = array();
        for ($i=0; $i<$l; $i++) {
            $chunked[] = mb_substr($text, $i, 1, 'UTF-8');
        }
        $verticalString = join("\n",$chunked);
        $info = self::PORTRAIT_IMAGE_INFO[mb_strlen($text) - 1];
        imagettftext($image, $info['size'], $info['angle'], $info['width'], $info['height'], $textcolor, $font, $verticalString);
        return $image;        
    }

    public function createSealPdf($convertResult) {
        $hiragana = $convertResult->hiraganaName;
        $katakana = $convertResult->katakanaName;
        $kanji = $convertResult->kanjiName;
        $type = $convertResult->type;
        $symbol_type_cd = $convertResult->symbol_type_cd;
        $design = $convertResult->design;

        $mstSymbolImage = new MstSymbolImage();
        $mstSymboleType = new MstSymbolType();
        $picture_type_cd = MstSymbolType::PICTURE_TYPE_NONE;
        $symbol_type_cd = intval($symbol_type_cd);
        $language_cd = MstSymbolType::LANGUAGE_CD_NONE;
        $size_cd = MstSymbolImage::SIZE_NONE;
        $font_cd = MstSymbolImage::FONT_NONE;
        $item_cd = intval($design);
        $category_cd = 0;

        if($type == 1) {
            // luckyname
            $category_cd = MstSymbolType::LUCKY_NAME;
        } 
        if($type == 2) {
            // kanjiselect
            $category_cd = MstSymbolType::KANJI_SELECT;
        } 
        $data_image = $mstSymbolImage->getImage($category_cd, $picture_type_cd, $item_cd, $size_cd, $font_cd, $symbol_type_cd);
        $image = imagecreatefromstring($data_image);

        $textcolor = imagecolorallocate($image, 0, 0, 0);
        putenv('GDFONTPATH=' . realpath('.'));
        $font = "fonts/ipaexm";

        $kanji_len = mb_strlen($kanji);
        $katakana_len = mb_strlen($katakana);
        $hiragana_len = mb_strlen($hiragana);
        // 漢字大
        $this->setSealText($image, $kanji, $kanji_len, $textcolor, $font, 2, 3, self::KANJI_LARGE_IMAGE_INFO);
        // カタカナ大
        $this->setSealText($image, $katakana, $katakana_len, $textcolor, $font, 1, 3, self::KATAKANA_LARGE_IMAGE_INFO);
        // ひらがな大
        $this->setSealText($image, $hiragana, $hiragana_len, $textcolor, $font, 1, 3, self::HIRAGANA_LARGE_IMAGE_INFO);
        // 漢字小
        $this->setSealText($image, $kanji, $kanji_len, $textcolor, $font, 2, 4, self::KANJI_SMALL_IMAGE_INFO);
        // カタカナ小
        $this->setSealText($image, $katakana, $katakana_len, $textcolor, $font, 1, 4, self::KATAKANA_SMALL_IMAGE_INFO);
        // ひらがな小
        $this->setSealText($image, $hiragana, $hiragana_len, $textcolor, $font, 1, 4, self::HIRAGANA_SMALL_IMAGE_INFO);

        if($type == 1) {
            // luckyname
            $inputName = $convertResult->inputName;
            $this->setInputName($image, $inputName, $textcolor, $font, self::LUCKY_INPUT_NAME_IMAGE_INFO);

            $kanjiInfo = $convertResult->kanjiInfo;
            $this->setKanjiDescription($image, $kanjiInfo, $kanji, $kanji_len, $textcolor, $font, self::LUCKY_KANJI_IMAGE_INFO, self::LUCKY_KANJI_INFO_IMAGE_INFO);

            $gogyoInfo = $convertResult->gogyoInfo;
            $soukaku = $gogyoInfo->soukaku . " (https://wamojiya.com/fortune/strokes" . $gogyoInfo->soukaku . "/)";
            $kotodama = $gogyoInfo->kotodama . " (". $gogyoInfo->kotodamaMessage . ")";
            $kazutama = $gogyoInfo->kazutama . " (". $gogyoInfo->kazutamaMessage . ")";
            
            // imagettftext($image, $this->convertFontSize(50), self::ANGLE, 1267, 2844, $textcolor, $font, $soukaku);
            // imagettftext($image, $this->convertFontSize(50), self::ANGLE, 1267, 2919, $textcolor, $font, $kotodama);
            // imagettftext($image, $this->convertFontSize(50), self::ANGLE, 1267, 2995, $textcolor, $font, $kazutama);
            imagettftext($image, $this->convertFontSize(23), self::ANGLE, 1267, 2838, $textcolor, $font, $soukaku);
            imagettftext($image, $this->convertFontSize(23), self::ANGLE, 1267, 2913, $textcolor, $font, $kotodama);
            imagettftext($image, $this->convertFontSize(23), self::ANGLE, 1267, 2989, $textcolor, $font, $kazutama);

            $mstGogyoShisou = new MstGogyoShisou();
            $gogyo = $mstGogyoShisou->getImage($gogyoInfo->id);
            if($gogyo) {
                $gogyo_image = imagecreatefromstring($gogyo);
                imagecopy($image, $gogyo_image, 134, 2357, 0, 0, imagesx($gogyo_image), imagesy($gogyo_image));
                imagedestroy($gogyo_image);
            }
        } 
        if($type == 2) {
            // kanjiselect
            $inputName = $convertResult->inputName;
            $this->setInputName($image, $inputName, $textcolor, $font, self::INPUT_NAME_IMAGE_INFO);

            $kanjiInfo = $convertResult->kanjiInfo;
            $this->setKanjiDescription($image, $kanjiInfo, $kanji, $kanji_len, $textcolor, $font, self::KANJI_IMAGE_INFO, self::KANJI_INFO_IMAGE_INFO);
        } 

        // PR
        $mstFacility = new MstFacility();
        $pr_cd = $mstFacility->getPrCd($convertResult->facility_id);
        $mstPr = new MstPr();
        $pr = $mstPr->getPrImage($pr_cd);
        if($pr) {
            $pr_image = imagecreatefromstring($pr);
            imagecopy($image, $pr_image, 1425, 3177, 0, 0, imagesx($pr_image), imagesy($pr_image));
            imagedestroy($pr_image);
        }
        
        ob_start();
        imagepng($image);
        $pdf_image = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);

        $pdfname = '/tmp/'.$convertResult->session_id.'.pdf';

        $fpdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        // $fpdf = new TCPDF('P', 'pt', array(2480.0, 3508.0), true, 'UTF-8', false);
        // $fpdf = new TCPDF('P', 'pt', array(2390.0, 3490.0), true, 'UTF-8', false);
        $fpdf->setPrintHeader(false);
        $fpdf->setPrintFooter(false);
        // $fpdf->SetMargins(-30.0, -30.0, 0.0);
        $fpdf->addPage();
        $fpdf->Image("@".$pdf_image);//, 0.0, 0.0, 2480.0, 3508.0, 'PNG');
        $fpdf->Output($pdfname, 'F');

        return $pdfname;
    }

    private function setSealText(&$image, $text, $length, $textcolor, $font, $row_max, $col_max, $image_info) {
        for($row = 0; $row < $row_max; $row++) {
            for($col = 0; $col < $col_max; $col++) {
                $info = $image_info[$row][$col][$length - 1];
                imagettftext($image, $this->convertFontSize($info['size']), $info['angle'], $info['width'], $info['height'], $textcolor, $font, $text);
            }
        }
    }

    private function setInputName(&$image, $text, $textcolor, $font, $image_info) {
        $input_name = mb_convert_kana(mb_strtoupper($text, 'UTF-8'), 'KVRN', 'UTF-8');
        $info = $image_info[mb_strlen($input_name) - 1];
        imagettftext($image, $this->convertFontSize($info['size']), $info['angle'], $info['width'], $info['height'], $textcolor, $font, $input_name);
    }

    private function setKanjiDescription(&$image, $kanjiInfo, $kanji, $kanji_len, $textcolor, $font, $image_info, $image_kanji_info) {
        $chunked = array();
        for ($i=0; $i<$kanji_len; $i++) {
            $chunked[] = mb_substr($kanji, $i, 1, 'UTF-8');
        }
        for ($i=0; $i<$kanji_len; $i++) {
            foreach($kanjiInfo as $key => $kanji_info) {
                if($key == $chunked[$i]) {
                    $info = $image_info[$i];
                    imagettftext($image, $this->convertFontSize($info['size']), $info['angle'], $info['width'], $info['height'], $textcolor, $font, $chunked[$i]);
                    $info = $image_kanji_info[$i];
                    imagettftext($image, $this->convertFontSize($info['size']), $info['angle'], $info['width'], $info['height'], $textcolor, $font, $kanji_info);
                }
            }
        }
    }
}