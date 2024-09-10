<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getCustomerBlockedBinary($is_blocked) 
    {
        if ($is_blocked == 'active')
        {
            return 0;
        }
        elseif ($is_blocked == 'blocked')
        {
            return 1;
        }
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
