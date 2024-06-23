<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolAddresses extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'school_state','school_address','school_coords'
    ];
    
}
