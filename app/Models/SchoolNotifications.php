<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolNotifications extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'notification_type', 'action_id'
    ];
    
}
