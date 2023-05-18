<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Protype;
use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Support\Facades\DB;
class WishController extends Controller
{
    public function addWish(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        $wishItem = $user->wishItems()->where('product_id', $validatedData['product_id'])->first();
        
        if ($wishItem) {
            $wishItem->touch();
        } else {
            $wishItem = new WishList([
                'user_id' => $user->id,
                'product_id' => $validatedData['product_id'],
            ]);
            $wishItem->save();
        }
        return redirect()->back()->with('success', 'Product added to cart successfully!');

        $wishItems = $user->wishItems()->with('product')->get();
        session()->put('wishItems', $wishItems);
}



    public function showWish()
    {
        $wishItems = auth()->user()->wishItems;
        return view('cart.showWish', compact('wishItems'));
    }

}