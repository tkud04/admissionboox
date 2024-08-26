<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotifications extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_type', 'action_id'
    ];
    
}
