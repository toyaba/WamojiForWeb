<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Session;

class StaticController extends Controller
{
    public function sample() {
        $language_code = Session::get('language_code');
        $data = [
            'language_code' => $language_code,
        ];
        App::setLocale($language_code);
        return view('sample', $data);
    }

    public function howto() {
        $language_code = Session::get('language_code');
        $data = [
            'language_code' => $language_code,
        ];
        App::setLocale($language_code);
        return view('howto', $data);
    }

    public function error() {
        $language_code = Session::get('language_code');
        $data = [
            'language_code' => $language_code,
        ];
        App::setLocale($language_code);
        return view('error', $data);
    }
}
