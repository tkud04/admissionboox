<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClubs extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'club_id'
    ];
    
}
