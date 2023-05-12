<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Protype;

class ProductController extends Controller
{
    //theo thoi gian moi nhat
    public function getNewProducts()
    {
        
        $products = Product::orderBy('created_at', 'desc')->get();
        $productsale = Product::where('sales', '>', 50)->get();
        return view('index', compact('products','productsale'));
    }

   

    // search
    public function search(Request $request)
    {
        $perPage = 3;
        $keyword = $request->get('keyword');
        $products = Product::where('pro_name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->paginate($perPage);
        return view('search', compact('products', 'keyword'));
    }
    // Show Id Protype
    public function showProductsByType($type_id)
    {
        $perPage = 3;
        $products = Product::where('type_id', $type_id)->paginate($perPage);
        $type_name = Protype::where('type_id', $type_id)->value('type_name');
        return view('typeproduct', compact('products', 'type_name'));
    }

}