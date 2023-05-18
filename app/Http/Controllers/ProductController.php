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
    //Xu li admin
    public function indexsp(){
        $product = Product::all();
        return view('admin.product.indexsp',['indexsp' => $product]);
    }
    public function addsp1(){
        return view('admin.product.addsp');
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        $product = Product::all();
        return view('admin.product.indexsp',['indexsp' => $product]);
        
    }
    public function editsp($id){
        $product = Product::find($id);
        return view('admin.product.editsp',compact('product'));
    }
    

    public function editsp1($id, Request $request)
    {
        $product = Product::find($id);
        $product->pro_name = $request->input('pro_name');
        $product->type_id = $request->input('type_id');
        $product->price = $request->input('price');
        $product->image = $request->input('image');
        $product->description = $request->input('description');
        $product->sales = $request->input('sales');
       
        // dd($user);
        $product->update();
        $product = Product::all();
        return view('admin.product.indexsp',['indexsp' => $product]);
        return redirect('admin.product.editsp');
    }
    public function addsp2(Request $request)
    {
        $request->validate([
            'pro_name' => 'required',
            'type_id' => 'unrequired',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required',
            'sales' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data, $request);
        $product = Product::all();
        return view('admin.product.indexsp',['indexsp' => $product]);
        return redirect("addsp2");
        
    }

    public function create(array $data, Request $request)
    {

        return Product::create([
            'pro_name' => $data['pro_name'],
            'type_id' => $data['type_id'],
            'price' => $data['price'],
            'image' => $data['image'],
            'description' => $data['description'],
            'sales' => $data['sales'],

        ]);
    }

}
