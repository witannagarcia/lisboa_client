<?php

namespace App\Http\Controllers\Kitchen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('restaurant_id', env('RESTAURANT_ID'))->whereNotIn("status", ['cancelado', 'entregado'])->paginate(8);
        return view('kitchen.orders.index');
    }
}
