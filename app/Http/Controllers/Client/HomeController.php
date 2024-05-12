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

    public function about(){
        return view ("home.about");
    }

    public function contact(){
        return view ("home.contact");
    }

    public function faq(){
        return view ("home.faq");
    }

    public function help(){
        return view ("home.help");
    }

    public function privacy(){
        return view ("home.privacy");
    }

    public function terms(){
        return view ("home.terms");
    }
}
