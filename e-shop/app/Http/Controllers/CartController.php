<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (Auth::check()) {
            $product_check = Product::where('id', $product_id)->first();

            if ($product_check) {
                if (Cart::where('product_id', $product_id)
                    ->where('user_id', auth()->user()->id)->exists()
                ) {
                    return response()->json([
                        'status' => $product_check->name . " Already added to chart"
                    ]);
                } else {
                    Cart::create([
                        'product_id' => $product_id,
                        'product_qty' => $product_qty,
                        'user_id' => auth()->user()->id
                    ]);

                    return response()->json([
                        'status' => $product_check->name . " added to chart"
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => 'Login to continue'
            ]);
        }
    }

    public function indexCart()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();

        return view('frontend.show-cart', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_quantity = $request->input('product_quantity');

        if (Auth::check()) {
            if (Cart::where('product_id', $product_id)
                ->where('user_id', auth()->user()->id)->exists()
            ) {
                $cart = Cart::where('product_id', $product_id)
                    ->where('user_id', auth()->user()->id)->first();

                $cart->product_qty = $product_quantity;
                $cart->update();

                return response()->json([
                    'status' => 'Quantity updated'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'Login to continue'
            ]);
        }
    }

    public function deleteProduct(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');

            if (Cart::where('product_id', $product_id)
                ->where('user_id', auth()->user()->id)->exists()
            ) {
                $cartItem = Cart::where('product_id', $product_id)
                    ->where('user_id', auth()->user()->id)->first();

                $cartItem->delete();

                return response()->json([
                    'status' => 'Product delete successfully'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'Login to continue'
            ]);
        }
    }

    public function cartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return response()->json([
            'count' => $cartCount
        ]);
    }
}
