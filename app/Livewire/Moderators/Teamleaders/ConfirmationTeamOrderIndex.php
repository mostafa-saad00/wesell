<?php

namespace App\Livewire\Moderators\Teamleaders;

use App\Models\Admin;
use App\Models\ModeratorTeam;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

#[Layout('layouts.app')]

class ConfirmationTeamOrderIndex extends Component
{
    public $searchTerm;

    public $status;

    public $date_range;

    public $team_member;

    public function filterOrders()
    {
        // do no thing then re render the component...
    }


    public function render()
    {
        $current_team_leader = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        $confirmation_team = ModeratorTeam::where('team_leader_id', $current_team_leader->id)->where('task_name', 'confirmation')->get();

        $order_statuses = DB::table('order_statuses')->get();


        $orders = Order::join('admin_order', 'orders.id', '=', 'admin_order.order_id')
                        ->join('moderator_teams', 'admin_order.admin_id', '=', 'moderator_teams.moderator_id')
                        ->where('moderator_teams.team_leader_id', $current_team_leader->id)
                        ->select('orders.*')
                        ->when($this->searchTerm !== '' && $this->searchTerm !== null, function ($query) {
                            return $query->where('orders.shipping_name', 'LIKE', '%' . $this->searchTerm . '%')
                                        ->orWhere('orders.shipping_phone', 'LIKE', '%' . $this->searchTerm . '%');
                                    
                        })
                        ->when($this->status !== '' && $this->status !== null, function ($query) {
                            return $query->where('orders.order_status_name', $this->status);
                        })
                        ->when($this->team_member !== '' && $this->team_member !== null, function ($query) {
                            return $query->where('moderator_teams.moderator_id', $this->team_member);
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
                        ->where('moderator_teams.task_name', 'confirmation')
                        ->orderBy('created_at')
                        ->paginate(15);


        return view('livewire.moderators.teamleaders.confirmation-team-order-index', ['orders' => $orders, 'order_statuses' => $order_statuses, 'confirmation_team' => $confirmation_team]);
    }
}
