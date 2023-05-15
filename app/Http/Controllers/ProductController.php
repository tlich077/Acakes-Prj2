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
        $newProduct = Product::orderBy('created_at', 'desc')->take(4)->get();
        $newProduct2 = Product::orderBy('created_at', 'desc')->skip(4)->take(4)->get();
        $productbest = Product::where('sales', '>', 80)->take(4)->get();
        return view('index', compact('products','productsale','newProduct','newProduct2','productbest'));
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
