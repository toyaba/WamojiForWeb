<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App;
use Session;

class MaintenanceController extends Controller
{
    private const PAGE_ERROR = 'error';
    private const PAGE_MENU = 'maintenanceMenu';
    private const PAGE_FACILITY = 'facilityList';

    public function maintenance(Request $request, Response $response) {
        try {
            $panel = self::PAGE_MENU;
            $mode = $request->input('mode');
            $data = [
                'url' => $request->fullUrl() . '/',
                'message' => "",
            ];

            switch($mode) {
                case "customer":
                $d=1/0;
                    $data['message'] = "準備中！！！";
                    break;
                case "contract":
                    $data['message'] = "準備中！！！";
                    break;
                case "payment":
                    $data['message'] = "準備中！！！";
                    break;
                case "history":
                    $data['message'] = "準備中！！！";
                    break;
            }

            return view($panel, $data);
        } catch(Exception $ex) {
            // return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            // return view(self::PAGE_ERROR, $data);
        }
    }
    public function selectMaintenance(Request $request, Response $response) {
        try {
            $panel = self::PAGE_MENU;
            $mode = $request->input('mode');
            $data = [
                'url' => $request->input('url'),
                'message' => "",
            ];

            switch($mode) {
                case "customer":
                $d=1/0;
                    $data['message'] = "準備中！！！";
                    break;
                case "contract":
                    $data['message'] = "準備中！！！";
                    break;
                case "payment":
                    $data['message'] = "準備中！！！";
                    break;
                case "facility":
                    $panel = self::PAGE_FACILITY;
                    break;
                case "history":
                    $data['message'] = "準備中！！！";
                    break;
            }

            return view($panel, $data);
        } catch(Exception $ex) {
            // return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            // return view(self::PAGE_ERROR, $data);
        }
    }
}