<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */

     use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function view(User $user, Order $order)
    {
        return $order->user_id === $user->id;
    }
}
