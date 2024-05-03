<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;

class ServiceController extends Controller
{
    public function getService($categoryId){
        $services = Service::where('category_id', $categoryId)->get();
        return response()->json($services);
    }
}
