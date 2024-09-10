<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class WarehouseOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('is_deleted', 0)->get();

        return view('warehouse.order.index', compact('orders'));
    }
}
