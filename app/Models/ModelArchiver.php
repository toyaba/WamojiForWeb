<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use ZipArchive;

class ModelArchiver /* extends Model */
{
    private $id;

    public function __construct($id) {
        // parent::__construct();
        $this->id = $id;
    }
    public function createTextImageZip($textImage, $pdfname) {
        $zipname = null;
        if($textImage || $pdfname) {
            $zipname = '/tmp/'.$this->id.'.zip';
            $zip = new ZipArchive();
            $zip->open($zipname, ZipArchive::CREATE);
            if($textImage) {
                $zip->addFromString('Landscape_Hiragana.png', $textImage['Landscape_Hiragana']);
                $zip->addFromString('Portrait_Hiragana.png', $textImage['Portrait_Hiragana']);
                $zip->addFromString('Landscape_Katakana.png', $textImage['Landscape_Katakana']);
                $zip->addFromString('Portrait_Katakana.png', $textImage['Portrait_Katakana']);
                $zip->addFromString('Landscape_Kanji.png', $textImage['Landscape_Kanji']);
                $zip->addFromString('Portrait_Kanji.png', $textImage['Portrait_Kanji']);
                $zip->addFromString('Landscape_Hiragana_Reverse.png', $textImage['Landscape_Hiragana_Reverse']);
                $zip->addFromString('Portrait_Hiragana_Reverse.png', $textImage['Portrait_Hiragana_Reverse']);
                $zip->addFromString('Landscape_Katakana_Reverse.png', $textImage['Landscape_Katakana_Reverse']);
                $zip->addFromString('Portrait_Katakana_Reverse.png', $textImage['Portrait_Katakana_Reverse']);
                $zip->addFromString('Landscape_Kanji_Reverse.png', $textImage['Landscape_Kanji_Reverse']);
                $zip->addFromString('Portrait_Kanji_Reverse.png', $textImage['Portrait_Kanji_Reverse']);
            }
            if($pdfname) {
                $zip->addFile($pdfname, 'kanji_description.pdf');
            }
            $zip->close();
        }
        return $zipname;
    }
}
