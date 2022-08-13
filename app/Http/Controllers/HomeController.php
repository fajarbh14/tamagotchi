<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Pelanggan;
use Auth;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $total_menu = Menu::count();
        $total_pesanan = Order::count();
        $total_meja = Pelanggan::count();
        return view("home", compact('total_menu', 'total_pesanan', 'total_meja'));
    }
}
