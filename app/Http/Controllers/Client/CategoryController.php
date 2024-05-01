<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Service;

class CategoryController extends Controller
{
    public function index($id){
        $category = Category::find($id);
        $services = Service::where('category_id', $id)->simplePaginate(8);
        return view ("user.category.index", compact("category", "services"));
    }
}
