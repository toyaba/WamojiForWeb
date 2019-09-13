<?php

namespace App\Models\Elements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstFacility extends Model
{
    protected $table = 'MST_FACILITY';
    protected $guarded = array('facility_id');
    public $timestamps = false;

    public function getData()
    {
      $data = DB::table($this->table)->get();
      return $data;
    }

    public function getFacilityList()
    {
      $query = DB::table($this->table);
      $query->orderBy('facility_id');
      $data = $query->get();
      return $data;
    }

    // public function isAuth($facility_id, $password) 
    // {
    //   $query = DB::table($this->table);

    //   if($facility_id && $password) {
    //     $query->where('facility_id', $facility_id);
    //     $data = $query->get();
    //     if($data && count($data) == 1) {
    //       if($data[0]->password === $password) {
    //         return true;
    //       }
    //     }
    //   }
    //   return false;
    // }

    public function isAuth($facility_id, $password) 
    {
      $query = DB::table($this->table);

      if($facility_id && $password) {
        $query->where('facility_id', $facility_id);
        $data = $query->get();
        if($data && count($data) == 1) {
          if(password_verify($password, $data[0]->password)) {
            $this->updatePassword($facility_id, $data[0]->password);
            return true;
          }
        }
      }
      return false;
    }

    private function updatePassword($facility_id, $hash) {
      if(password_needs_rehash($hash, PASSWORD_DEFAULT)) {
        DB::table($this->table)
        ->where('facility_id', $facility_id)
        ->update(
          array(
            'password' => $hash,
            )
        );
      }
    }

    public function getPrCd($facility_id) {
      $pr_cd = null;
      $query = DB::table($this->table);

      if($facility_id) {
        $query->where('facility_id', $facility_id);
        $data = $query->get();
        if($data) {
          $pr_cd = $data[0]->pr_cd;
        }
      }
      return $pr_cd;
    }

    public function getPassword($facility_id) {
      $password = null;
      $query = DB::table($this->table);

      if($facility_id) {
        $query->where('facility_id', $facility_id);
        $data = $query->get();
        if($data) {
          $password = $data[0]->password;
        }
      }
      return $password;
    }

    public function getFacility($facility_id) {
      $facility = null;
      $query = DB::table($this->table);

      if($facility_id) {
        $query->where('facility_id', $facility_id);
        $data = $query->get();
        if($data) {
          $facility = $data[0];
        }
      }
      return $facility;
    }

    // public function convert() {
    //   $data = DB::table($this->table)->get();
    //   if($data) {
    //     foreach($data as $index => $facility) {
    //       if(!$facility->hash) {
    //         $hash = password_hash($facility->password, PASSWORD_DEFAULT);
    //         DB::table($this->table)
    //         ->where('facility_id', $facility->facility_id)
    //         ->update(
    //           array(
    //             'hash' => password_hash($facility->password, PASSWORD_DEFAULT),
    //             )
    //         );
    //       }
    //     }
    //   }
    // }

    public function insertFacility($facility)
    {
        DB::table($this->table)->insert(
            array(
              'facility_id' => $facility->facility_id,
              'password' => $facility->password,
              'facility_name' => $facility->facility_name,
              'background_cd_1' => $facility->background_cd_1,
              'background_cd_2' => $facility->background_cd_2,
              'background_cd_3' => $facility->background_cd_3,
              'background_cd_4' => $facility->background_cd_4,
              'pr_cd' => $facility->pr_cd,
              // 'customer_id' => $facility->customer_id,
              // 'license_flg' => $facility->license_flg,
              // 'project_id' => $facility->project_id,
              // 'business_type' => $facility->business_type,
              // 'specification_version_number' => $facility->specification_version_number,
              )
        );
    }

    public function deleteFacility($facility) {
      DB::table($this->table)
        ->where('facility_id', $facility->facility_id)
        ->delete();
    }

    public function updateFacility($facility) {
      DB::table($this->table)
        ->where('facility_id', $facility->facility_id)
        ->update(
          array(
            'facility_id' => $facility->facility_id,
            'password' => $facility->password,
            'facility_name' => $facility->facility_name,
            'background_cd_1' => $facility->background_cd_1,
            'background_cd_2' => $facility->background_cd_2,
            'background_cd_3' => $facility->background_cd_3,
            'background_cd_4' => $facility->background_cd_4,
            'pr_cd' => $facility->pr_cd,
            'update_time' => $facility->update_time,
            // 'customer_id' => $facility->customer_id,
            // 'license_flg' => $facility->license_flg,
            // 'project_id' => $facility->project_id,
            // 'business_type' => $facility->business_type,
            // 'specification_version_number' => $facility->specification_version_number,
          )
      );

      $this->updatePassword($facility->facility_id, $facility->password);
    }

    public function getFacilityIdIndex($facility_id) {
      $count = DB::table($this->table)
        ->where('facility_id', 'like', $facility_id . '%')
        ->count();

      return $count + 1;
    }
}
