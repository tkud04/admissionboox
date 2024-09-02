<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolAdmissions extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'session','term_id','form_id','end_date','status'
    ];
    
}
