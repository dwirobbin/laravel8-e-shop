<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartItems = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($old_cartItems as $item) {
            if (!Product::where('id', $item->product_id)
                ->where('quantity', ">=", $item->product_qty)->exists()) {
                $removeItem = Cart::where('user_id', auth()->user()->id)->where('product_id', $item->product_id)->first();
                $removeItem->delete();
            }

            $cartItems = Cart::where('user_id', auth()->user()->id)->get();

            return view('frontend.checkout', compact('cartItems'));
        }
    }

    public function placeOrder(Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'table_no' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'pin_code' => 'required',
        ];

        $messages = [
            'first_name.required' => "Field first name can't be empty",
            'last_name.required' => "Field last name can't be empty",
            'email.required' => "Field email can't be empty",
            'phone.required' => "Field phone can't be empty",
            'table_no.required' => "Field table_no can't be empty",
            'address.required' => "Field address can't be empty",
            'city.required' => "Field city can't be empty",
            'province.required' => "Field province can't be empty",
            'country.required' => "Field country can't be empty",
            'pin_code.required' => "Field pin_code can't be empty"
        ];

        $this->validate($request, $rules, $messages);

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->first_name = $request->input('first_name');
            $order->last_name = $request->input('last_name');
            $order->email = $request->input('email');
            $order->phone = $request->input('phone');
            $order->table_no = $request->input('table_no');
            $order->address = $request->input('address');
            $order->city = $request->input('city');
            $order->province = $request->input('province');
            $order->country = $request->input('country');
            $order->pin_code = $request->input('pin_code');
            $order->user_id = auth()->user()->id;

            $total = 0;
            $cartItemstotal = Cart::where('user_id', auth()->user()->id)->get();
            foreach ($cartItemstotal as $cartItem) {
                $total += $cartItem->products->selling_price;
            }

            $order->total_price = $total;
            $order->tracking_no = 'DRP-' . rand(1111, 9999);
            $order->save();

            if ($order) {
                $cartItems = Cart::where('user_id', auth()->user()->id)->get();
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->product_qty,
                        'price' => $item->products->selling_price
                    ]);

                    $product = Product::where('id', $item->product_id)->first();
                    $product->quantity = $product->quantity - $item->product_qty;
                    $product->update();
                }

                if (auth()->user()->address == null) {
                    User::where('id', auth()->user()->id)->first()->update([
                        'name' => Str::title($request->first_name),
                        'last_name' => Str::title($request->last_name),
                        'phone' => $request->phone,
                        'table_no' => $request->table_no,
                        'address' => Str::title($request->address),
                        'city' => Str::title($request->city),
                        'province' => Str::title($request->province),
                        'country' => Str::title($request->country),
                        'pin_code' => $request->pin_code,
                    ]);
                }

                Cart::where('user_id', auth()->user()->id)->delete();
                return redirect('/')->with('success', 'Order placed Successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect('/')->with('failed', 'Failed to order place');
        } finally {
            DB::commit();
        }
    }
}
