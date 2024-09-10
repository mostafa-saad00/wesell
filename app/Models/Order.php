<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_order');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_status_histories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function orderDelays()
    {
        return $this->hasMany(OrderDelay::class);
    }

    public function orderNotrespondings()
    {
        return $this->hasMany(OrderNotresponding::class);
    }
}
