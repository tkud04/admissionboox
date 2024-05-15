<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolOwners extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'name', 'email', 'phone'
    ];
    
}
