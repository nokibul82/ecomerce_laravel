<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth()->user()->id;

        $order = new Order;
        $order->user_id = $user_id;
        $order->name = Auth()->user()->name;
        $order->total = $request->totalCost;
        $_SESSION['status'] = "Oder has been completed successfully !";
        $order->save();
        Cart::where('user_id',$user_id)->delete();

        return redirect('/message');

    }

    public function read()
    {
        $data['orders'] = Order::all();
        return view('order',$data);
    }
}
