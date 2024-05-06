<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class CallRequestController extends Controller
{
    public function getCallRequestByCityCode($cityCode){
        $callRequests = Appointment::where('city_code', $cityCode)->get();
        return response()->json($callRequests);
    }

    public function getCallRequestById($id){
        $callRequests = Appointment::find($id);
        return response()->json($callRequests);
    }
}
