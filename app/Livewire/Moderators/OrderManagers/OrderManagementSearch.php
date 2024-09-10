<?php

namespace App\Livewire\Moderators\OrderManagers;

use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]

class OrderManagementSearch extends Component
{
    public function render()
    {
        return view('livewire.moderators.order-managers.order-management-search');
    }
}
