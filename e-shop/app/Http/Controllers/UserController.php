<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();

        return view('frontend.orders', compact('orders'));
    }

    public function viewOrder($id)
    {
        $orders = Order::where('id', $id)->where('user_id', auth()->user()->id)->first();

        return view('frontend.detail-orders', compact('orders'));
    }

    public function viewAllUsers()
    {
        $users = User::latest()->paginate(5);
        return view('backend.users.index', compact('users'));
    }

    public function viewDetailUsers($name)
    {
        $user = User::where('name', $name)->first();
        return view('backend.users.show', compact('user'));
    }
}
