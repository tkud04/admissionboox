<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolInfo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'boarding_type', 'hbu',
        'hbuOther','school_name','school_type',
        'school_curriculum', 'school_fees','wcu'
    ];
    
}
