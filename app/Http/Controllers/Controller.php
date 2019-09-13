<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Elements\MstFacility;
use App\Models\ModelWamojiya;
use App;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private const DEFAULT_LANGUAGE_CODE = 'en';

    public function index(Request $request, Response $response) {
        try {
            $session = $request->session();
            // $session->flush();
            // $mstFacility = new MstFacility();
            // $mstFacility->convert();

//            $uri = ($request->path() === "/" ? '/' : '/' . $request->path()  . '/');
            $uri = ($request->path() === "/" ? '/' : '/' . $request->path());
            $b2c = $request->session()->get('b2c');
            if($uri === "/shop") {
                $request->session()->put('login_facility_id', "WPW1-20190001");
                $request->session()->put('remember_me', "1");
                $request->session()->put('lonin_time', true);
                $request->session()->put('logined', true);
                $b2c = true;
            } else {
                if(!isset($b2c) || $b2c) {
                    $b2c = false;
                    $request->session()->put('login_facility_id', null);
                    $request->session()->put('remember_me', "");
                    $request->session()->put('logined', false);
                }
            }
            $request->session()->put('b2c', $b2c);

            $auth = $request->session()->get('logined');
            $language_code_post = $request->input('language_code');
            $language_code = $request->session()->get('language_code');
            if(isset($language_code_post) && isset($language_code)) {
                if($language_code_post != $language_code) {
                    $language_code = $language_code_post;
                    $request->session()->put('language_code', $language_code_post);
                }
            } else if(!isset($language_code_post) && isset($language_code)) {
                ;
            } else if(isset($language_code_post) && !isset($language_code)) {
                $language_code = $language_code_post;
                $request->session()->put('language_code', $language_code_post);
            } else {
                $language_code = self::DEFAULT_LANGUAGE_CODE;
                $request->session()->put('language_code', $language_code);
            }
            App::setLocale($language_code);
            $modelWamojiya = new ModelWamojiya($request);
            if($request->isMethod('post')) {
                $wamojiya = new ModelWamojiya($request);
                $wamojiya->login($auth);
            }

            $data = [
               // 'url' => $request->fullUrl() . '/',
                'url' => $request->fullUrl(),
                'uri' => $uri,
                'auth' => $auth,
                'language_code' => $language_code,
                'language' => true,
                'languageList' => $modelWamojiya->getLanguageList(),
                'b2c' => $b2c,
            ];
    
            return view('index', $data);
        } catch(ErrorException $ex) {
            return view('error', $data);
        }
    }
}
