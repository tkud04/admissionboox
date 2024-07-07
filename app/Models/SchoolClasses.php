<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClasses extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'class_name','class_value'
    ];
    
}
