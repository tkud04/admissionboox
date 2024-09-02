<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolApplications extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admission_id', 'user_id', 'date_slot', 'time_slot', 'status'
    ];
    
}
