<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\City;

class SearchController extends Controller
{
    public function index(){
        $cities = City::all();
        return view ("freelancer.search", compact("cities"));
    }
}
