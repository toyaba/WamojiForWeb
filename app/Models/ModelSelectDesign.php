<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Elements\MstSymbolType;
use App\Models\Elements\MstSymbolImage;

use App\Models\Elements\MstFacility;

class ModelSelectDesign /* extends Model */
{
    private $request;

    function __construct($request) {
        $this->request = $request;
    }

    public function getDesignList() {
        $mstSymboleType = new MstSymbolType();
        $category_cd = MstSymbolType::DESIGN_SELECT;
        $picture_type_cd = MstSymbolType::PICTURE_TYPE_NONE;
        $symbol_type_cd = null;
        $language_cd = MstSymbolType::LANGUAGE_CD_NONE;

        $data = $mstSymboleType->getSymbolType($category_cd, $picture_type_cd, $symbol_type_cd, $language_cd);

        $design_list = array();
        if($data) {
            $mstSymbolImage = new MstSymbolImage();
            foreach($data as $idx => $design) {
                $size_cd = MstSymbolImage::SIZE_NONE;
                $font_cd = MstSymbolImage::FONT_NONE;
                $item_cd = $design->symbol_type_cd;
                $symbol_type_cd = $design->symbol_type_cd;
                $image = $mstSymbolImage->getImage($category_cd, $picture_type_cd, $item_cd, $size_cd, $font_cd, $symbol_type_cd);
                array_push($design_list, array('symbol_type_cd' => $design->symbol_type_cd, 'picture_type_name' => $design->picture_type_name, 'image' => base64_encode($image)));
            }
        }

        return $design_list;
    }

    public function login(&$auth) {
        $login_facility_id = $this->request->input('login_facility_id');
        $login_password = $this->request->input('login_password');
        $remember_me = $this->request->input('remember_me');
        if($login_facility_id && $login_facility_id) {
            $mstFacility = new MstFacility();
            $auth = $mstFacility->isAuth($login_facility_id, $login_password);
            if($auth) {
                $this->request->session()->put('login_facility_id',$login_facility_id);
                $this->request->session()->put('remember_me',$remember_me);
                $this->request->session()->put('lonin_time',$auth);
                $this->request->session()->put('logined',$auth);
                // Session::save();                
            }
        }
        if(!$auth) {
            if(isset($request)) {
                $request->flashOnly(['login_facility_id', 'remember_me']);
            }
        }
    }
}
