<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsAPIController extends Controller
{
    public function index(){
        return Product::all();
    }
}
