<?php

namespace App\Livewire\Users;

use App\Models\MerchantWalletTransaction;
use App\Models\Order;
use App\Models\UserWalletTransaction;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.app')]

class Dashboard extends Component
{
    public $user;

    public $date;

    public $startDate;

    public $endDate;

    public $latest_orders;

    public $orders_count;

    public $delivered_orders_count;

    public $topProducts;

    public $total_user_balance;

    public $total_user_earnings;


    public function mount() 
    {
        $date = new DateTime();
        $year = $date->format('Y');
        $month = $date->format('m');
        $dayOne = '01';
        $currentDay = '12';

        $startDate = "$year-$month-$dayOne";
        $endDate = Carbon::createFromFormat('Y-m-d', "$year-$month-$currentDay")->endOfDay();

        $this->startDate = $startDate;
        $this->endDate = $endDate;

        $user = Auth::user();

        $this->user = $user;

     
    }

    public function updatedDate()
    {
        $dates = explode(' to ', $this->date);

        if (count($dates) == 2)
        {
            $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();

            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }

        if (count($dates) == 1)
        {
            try {
                $startDate = Carbon::createFromFormat('Y-m-d', trim($this->date))->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', trim($this->date))->endOfDay();

                $this->startDate = $startDate;
                $this->endDate = $endDate;

            } catch(InvalidArgumentException $e) {
                $this->reset('date');
            }
            

        }
    }


    public function render()
    {
        $latest_orders = Order::where('user_id', $this->user->id)->whereBetween('created_at', [$this->startDate, $this->endDate])->take(7)->orderBy('created_at', 'desc')->get();
        
        $orders_count = Order::where('user_id', $this->user->id)->whereBetween('created_at', [$this->startDate, $this->endDate])->count();

        $delivered_orders_count = Order::where('user_id', $this->user->id)->whereBetween('created_at', [$this->startDate, $this->endDate])->where('order_status_name', 'delivered')->count();   
        
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.title', 'order_items.product_id', 'products.lowest_selling_price', 
                'products.current_stock', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->where('order_items.user_id', $this->user->id)
            ->groupBy('order_items.product_id', 'products.title', 'products.lowest_selling_price', 'products.current_stock')
            ->whereBetween('order_items.created_at', [$this->startDate, $this->endDate])
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();


        $merchant_earnings = MerchantWalletTransaction::where('user_id', $this->user->id)->where('total_earnings', '>', 0)->sum('total_earnings');
        $affiliate_earnings = UserWalletTransaction::where('user_id', $this->user->id)->where('amount', '>', 0)->sum('amount');

        $merchant_balance = MerchantWalletTransaction::where('user_id', $this->user->id)->sum('total_earnings');
        $affiliate_balance = UserWalletTransaction::where('user_id', $this->user->id)->sum('amount');

        $this->total_user_earnings = $merchant_earnings + $affiliate_earnings;
        $this->total_user_balance = $merchant_balance + $affiliate_balance;




        $this->latest_orders = $latest_orders;

        $this->topProducts = $topProducts;

        $this->orders_count = $orders_count;

        $this->delivered_orders_count = $delivered_orders_count;


        return view('livewire.users.dashboard');
    }
}
