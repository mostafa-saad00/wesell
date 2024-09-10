<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeratorTeam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function moderator()
    {
        return $this->belongsTo(Admin::class, 'moderator_id');
    }
}
