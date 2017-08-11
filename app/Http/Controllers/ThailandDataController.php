<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province, App\District, App\SubDistrict, App\Zipcode;

class ThailandDataController extends Controller
{
	public function updateProvinceByGeography($geography_id) {
		return Province::whereGeographyId($geography_id)->orderBy('code', 'ASC')->get();
	}

    public function updateDistrictByProvince($province_id) {
    	return  District::whereProvinceId($province_id)->get();
    }

    public function updateSubDistrictByDistrict($district_id) {
    	return SubDistrict::whereDistrictId($district_id)->get();
    }

    public function updateZipcodeBySubDistrict($sub_district_id) {
    	return Zipcode::whereSubDistrictId($sub_district_id)->first();
    }
}

