<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;

class HomeController extends Controller
{
    public function index()
    {
        $data['products'] = Product::all();
        return view('home', $data);
    }



    public function about()
    {
        return view('about');
    }
}
