<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ModeratorOrderController extends Controller
{
    public function index()
    {
        $moderator = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        return $moderator->orders;
        
        $orders = Order::where('is_deleted', 0)->get();

        return view('moderator.order.index', compact('orders'));
    }

    public function order_edits(Order $order)
    {
        return $order;
    }
}
