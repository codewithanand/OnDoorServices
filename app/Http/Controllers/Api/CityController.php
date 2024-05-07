<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCityByName(Request $request){
        $cityName = $request->cityName;
        $cities = City::where('city_name', 'like', '%'.$cityName.'%')->get();
        if(count($cities) < 1){
            $cities = City::all();
        }
        return response()->json($cities);
    }
}
