<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user_id = Auth()->user()->id;
        $product_id = $request->product_id;
        $cartitem = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();

        if ($cartitem) {
            $cartitem->quantity = $cartitem->quantity + 1;
            $cartitem->save();
            return redirect('/home');
        }

        if (!$cartitem) {

            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $request->product_id;
            $cart->quantity = 1;
            $cart->save();
            return redirect('/home');
        }

        // $cart = session()->get('cart');

        // if (!$cart) {
        //     $cart = [
        //         $product->id => [
        //             'title'     => $product->title,
        //             'price'     => $product->price,
        //             'quantity'  => 1,
        //             'imageUrl'  => $product->imageUrl,
        //         ]
        //     ];
        //     session()->put('cart',$cart);
        //     return redirect('/home');
        // }

        // if(isset($cart[$product->id])){
        //     $cart[$product->id]['quantity']++;
        //     session()->put('cart',$cart);
        //     return redirect('/home');
        // }

        // $cart = [
        //     $product->id => [
        //         'title'     => $product->title,
        //         'price'     => $product->price,
        //         'quantity'  => 1,
        //         'imageUrl'  => $product->imageUrl,
        //     ]
        // ];

        // session()->put('cart',$cart);
        // return redirect('/home');

    }

    static public function cartItemCount()
    {
        $user_id = Auth()->user()->id;
        $count = Cart::where("user_id", $user_id)->count();
        return $count;
    }

    public function index()
    {
        $user_id = Auth()->user()->id;
        $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $user_id)
            ->select('products.*', 'cart.quantity as quantity', 'cart.id as cart_id')
            ->get();

        $total = 0;
        $cartItems = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $user_id)
            ->select('products.price as price', 'cart.quantity as quantity')
            ->get();

        foreach ($cartItems as $cartitem) {
            $total = $total + $cartitem->price * $cartitem->quantity;
        }
        return view('cart', ['products' => $products, 'total' => $total]);
    }

    public function addItem(Request $request)
    {
        $user_id = Auth()->user()->id;
        $cart_id = $request->cart_id;
        $cartitem = Cart::where('user_id', $user_id)->where('id', $cart_id)->first();
        $cartitem->quantity = $cartitem->quantity + 1;
        $cartitem->save();
        return redirect('/cart');
    }

    public function substractItem(Request $request)
    {
        $user_id = Auth()->user()->id;
        $cart_id = $request->cart_id;
        $cartitem = Cart::where('user_id', $user_id)->where('id', $cart_id)->first();
        if ($cartitem->quantity <= 0) {
            $cartitem->quantity = 0;
            $cartitem->save();
        } else {
            $cartitem->quantity = $cartitem->quantity - 1;
            $cartitem->save();
        }

        return redirect('/cart');
    }

    // public function totalCost()
    // {
    //     $user_id = Auth()->user()->id;
    //     $total = 0;
    //     $cartItems = DB::table('cart')
    //         ->join('products', 'cart.product_id', '=', 'products.id')
    //         ->where('cart.user_id', $user_id)
    //         ->select('products.price as price', 'cart.quantity as quantity')
    //         ->get();

    //     foreach ($cartItems as $cartitem) {
    //         $total = $total + $cartitem->price * $cartitem->quantity;
    //     }

    //     return view('cart', ['total' => $total]);
    // }
}
