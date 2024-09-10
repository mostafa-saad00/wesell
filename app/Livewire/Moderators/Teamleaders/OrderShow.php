<?php

namespace App\Livewire\Moderators\Teamleaders;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.app')]

class OrderShow extends Component
{
    public $order;

    public $order_have_edits = false;


    public function mount(Order $order)
    {
        $this->order = $order;

        $order_history_exists = OrderHistory::where('order_id', $order->id)->exists();
        $order_items_edits_exists = OrderItem::where('order_id', $order->id)->where('version', '>', 1)->exists();


        if($order_history_exists || $order_items_edits_exists)
        {
            $this->order_have_edits = true;
        }
    }


    public function render(Order $order)
    {
        return view('livewire.moderators.teamleaders.order-show');
    }
}
