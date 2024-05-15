<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolFacilities extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'facility_id'
    ];
    
}
