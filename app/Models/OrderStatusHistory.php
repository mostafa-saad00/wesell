<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'changed_by');
    }
}
