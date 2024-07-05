<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppicationData extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id', 'form_field_id','value'
    ];
    
}
