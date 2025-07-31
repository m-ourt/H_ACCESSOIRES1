<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;


class ProductController extends Controller
{
    public function home()
{
    $products = Product::all();

    return Inertia::render('Home', [
        'products' => $products,
        'user' => auth()->user(),
        'isNewUser' => false 
    ]);
}

}
/* $products = Product::all();

    return Inertia::render('Home', [
        'products' => $products
    ]);*/ 