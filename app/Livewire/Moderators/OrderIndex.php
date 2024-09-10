<?php

namespace App\Livewire\Moderators;

use App\Models\Admin;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout('layouts.app')]

class OrderIndex extends Component
{

    use WithPagination;

    public $searchTerm;
    public $status;

    public $date_range;


    public function filterOrders()
    {
        // do nothing then render the component
        
    }

    
    public function render()
    {
        $current_moderator = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        $order_statuses = DB::table('order_statuses')->get();

        $searchTerm = $this->searchTerm;

        $orders = $current_moderator->orders()
                ->when($this->searchTerm !== '' && $this->searchTerm !== null, function ($query) {
                    return $query->where('orders.shipping_name', 'LIKE', '%' . $this->searchTerm . '%')
                                ->orWhere('orders.shipping_phone', 'LIKE', '%' . $this->searchTerm . '%');
                            
                })
                ->when($this->status !== '' && $this->status !== null, function ($query) {
                    return $query->where('orders.order_status_name', $this->status);
                })
               ->when($this->date_range !== '' && $this->date_range !== null, function ($query) {       

                    $dates = explode(' to ', $this->date_range);

                    
                    if (count($dates) == 2)
                    {
                        $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
                        $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();

                        return $query->whereBetween('orders.created_at', [$startDate, $endDate]);
                    }
                    elseif (count($dates) == 1)
                    {
                        try {
                            $startDate = Carbon::createFromFormat('Y-m-d', trim($this->date_range))->startOfDay();
                            $endDate = Carbon::createFromFormat('Y-m-d', trim($this->date_range))->endOfDay();

                            return $query->whereBetween('orders.created_at', [$startDate, $endDate]);
                            
                        } catch(InvalidArgumentException $e) {
                            $this->reset('date_range');
                        }

                    }

                
                })
               ->orderBy('created_at', 'desc')
               ->paginate(15);

               
        return view('livewire.moderators.order-index', ['orders' => $orders, 'order_statuses' => $order_statuses]);
    }


}
