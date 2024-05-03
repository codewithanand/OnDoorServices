<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Village;


class AddressController extends Controller
{
    public function getDistrict($stateCode){
        $districts = District::where('state_code', $stateCode)->get();
        return response()->json($districts);
    }

    public function getCity($districtCode){
        $cities = City::where('district_code', $districtCode)->get();
        return response()->json($cities);
    }

    public function getVillage($cityCode){
        $villages = Village::where('city_code', $cityCode)->get();
        return response()->json($villages);
    }
}
