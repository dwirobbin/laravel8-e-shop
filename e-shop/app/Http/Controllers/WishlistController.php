<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function indexWishlist()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('frontend.wishlist', compact('wishlists'));
    }

    public function addWishlist(Request $request)
    {
        $prod_id = $request->input('product_id');

        if (auth()->check()) {
            $product_check = Product::where('id', $prod_id)->first();

            if ($product_check) {

                if (Wishlist::where('product_id', $prod_id)
                    ->where('user_id', auth()->user()->id)->exists()
                ) {
                    return response()->json([
                        'status' => $product_check->name . " Already added to wishlist"
                    ]);
                } else {
                    $wish = new Wishlist();
                    $wish->product_id = $prod_id;
                    $wish->user_id = auth()->user()->id;
                    $wish->save();

                    return response()->json([
                        'status' => $product_check->name . " added to wishlist"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => "Product doesn't exists"
                ]);
            }
        } else {
            return response()->json([
                'status' => 'Login to continue'
            ]);
        }
    }

    public function deleteItem(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');

            if (Wishlist::where('product_id', $product_id)
                ->where('user_id', auth()->user()->id)->exists()
            ) {
                $cartItem = Wishlist::where('product_id', $product_id)
                    ->where('user_id', auth()->user()->id)->first();

                $cartItem->delete();

                return response()->json([
                    'status' => 'Item removed from Wishlist successfully'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'Login to continue'
            ]);
        }
    }

    public function wishlistCount()
    {
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json([
            'count' => $wishlistCount
        ]);
    }
}
