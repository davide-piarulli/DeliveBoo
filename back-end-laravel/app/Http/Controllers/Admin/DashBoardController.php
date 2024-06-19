<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index(){
      $n_products = Product::count();
      return view('admin.home', compact('n_products'));
    }
}

