<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionClasses extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admission_id', 'class_id'
    ];
    
}
