<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashBoardController extends Controller
{
    public function index(){
      $n_products = Product::where('restaurant_id', Auth::user()->id)->count();
      return view('admin.home', compact('n_products'));
    }
}

