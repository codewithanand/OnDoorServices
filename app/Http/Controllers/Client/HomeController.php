<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view ("welcome", compact("categories"));
    }
}
