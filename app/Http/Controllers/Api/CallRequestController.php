<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class CallRequestController extends Controller
{
    public function getCallRequestByCityCode(Request $request){
        $cityCode = $request->cityCode;
        $callRequests = Appointment::where('city_code', $cityCode)->where('booked', 0)->with('service')->get();
        return response()->json($callRequests);
    }

    public function getCallRequestById(Request $request){
        $appointmentId = $request->id;
        $callRequests = Appointment::where('id', $appointmentId)->with('service')->first();
        return response()->json($callRequests);
    }
}
