<?php

namespace App\Models;

use App\Models\Elements\MstFacility;

class ModelMaintenance /* extends Model */
{
    public function getFacilityList() {
        $facilityList = null;
        $mstFacility = new MstFacility();
        $facilityList = $mstFacility->getFacilityList();
        return $facilityList;
    }
    
    public function getFacility($facility_id) {
        $mstFacility = new MstFacility();
        $facility = $mstFacility->getFacility($facility_id);
        return $facility;
    }

    public function saveFacility($mode, $facility) {
        $mstFacility = new MstFacility();

        if ($mode == "new") {
            $password = $facility->password;
            $facility->password = password_hash($password, PASSWORD_DEFAULT);
            $mstFacility->insertFacility($facility);
        } else {
            date_default_timezone_set('Asia/Tokyo');
            $facility->update_time = date('Y-m-d H:i:s');
            $password = $mstFacility->getPassword($facility->facility_id);
            if($password !== $facility->password) {
                $facility->password = password_hash($facility->password, PASSWORD_DEFAULT);
            }
            $mstFacility->updateFacility($facility);
        }
    }

    public function createFacilityId($projectId, $businessType, $specificationVersionNumber) {
        $facility_id = $projectId . $businessType . $specificationVersionNumber . "-";
        date_default_timezone_set('Asia/Tokyo');
        $facility_id = $facility_id . date('Y');

        $mstFacility = new MstFacility();
        $index = $mstFacility->getFacilityIdIndex($facility_id);
        return $facility_id . sprintf('%04d', $index);
    }
}
