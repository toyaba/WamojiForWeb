<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App;
use Session;
use App\Models\ModelMaintenance;

class FacilityController extends Controller
{

    public function facilityList(Request $request, Response $response) {
        try {
            $session = $request->session();
            $url = $request->input('url');
            $mode = $request->input('mode');

            $maintenance = new ModelMaintenance();
            $facilityList = $maintenance->getFacilityList();

            $data = [
                'url' => $url,
                'facilityList' => $facilityList,
            ];

            return view("facilityList", $data);
        } catch(Exception $ex) {
var_dump($ex);
            // return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
var_dump($ex);
            // return view(self::PAGE_ERROR, $data);
        }
    }

    public function facilityDetail(Request $request, Response $response) {
        try {
            $session = $request->session();
            $url = $request->input('url');
            $mode = $request->input('mode');
            $backPanelId = $request->input('backPanelId');
            $facilityId = $request->input('facilityId');
            $facility = null;

            if($mode === "new") {
                $facility = new \StdClass();
                $facility->facility_id = null;
                $facility->password = null;
                $facility->facility_name = null;
                $facility->background_cd_1 = null;
                $facility->background_cd_2 = null;
                $facility->background_cd_3 = null;
                $facility->background_cd_4 = null;
                $facility->pr_cd = null;
                $facility->customer_id = null;
                $facility->license_flg = null;
                $facility->project_id = null;
                $facility->business_type = null;
                $facility->specification_version_number = null;
                $facility->add_time = null;
                $facility->update_time = null;
            } else {
                $maintenance = new ModelMaintenance();
                $facility = $maintenance->getFacility($facilityId);
            }

            $data = [
                'url' => $url,
                'mode' => $mode,
                'facility' => $facility,
            ];

            return view("facilityDetail", $data);
        } catch(Exception $ex) {
            // return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            // return view(self::PAGE_ERROR, $data);
        }
    }

    public function saveDetail(Request $request, Response $response) {
        try {
            $session = $request->session();
            $url = $request->input('url');
            $mode = $request->input('mode');

            $maintenance = new ModelMaintenance();
            $facilityId = $request->input('facilityId');
            $projectId = $request->input('projectId');
            $businessType = $request->input('businessType');
            $specificationVersionNumber = $request->input('specificationVersionNumber');

            $facility = new \StdClass();
            if($mode === "new") {
                $facility->facility_id = $maintenance->createFacilityId($projectId, $businessType, $specificationVersionNumber);
            } else {
                $facility->facility_id = $facilityId;
            }
            $facility->password = $request->input('password');
            $facility->facility_name = $request->input('facilityName');
            $facility->background_cd_1 = $request->input('backgroundCd1');
            $facility->background_cd_2 = $request->input('backgroundCd2');
            $facility->background_cd_3 = $request->input('backgroundCd3');
            $facility->background_cd_4 = $request->input('backgroundCd4');
            $facility->pr_cd = $request->input('prCd');
            $facility->customer_id = $request->input('customerId');
            $facility->license_flg = $request->input('licenseFlg');
            $facility->project_id = $projectId;
            $facility->business_type = $businessType;
            $facility->specification_version_number = $specificationVersionNumber;
            $facility->add_time = null;
            $facility->update_time = null;

            $maintenance = new ModelMaintenance();
            $maintenance->saveFacility($mode, $facility);

            $facilityList = $maintenance->getFacilityList();

            $data = [
                'url' => $url,
                'facilityList' => $facilityList,
            ];

            return view("/facilityList", $data);
        } catch(Exception $ex) {
            // return view(self::PAGE_ERROR, $data);
        } catch(\Throwable $ex) {
            // return view(self::PAGE_ERROR, $data);
        }
    }
}
