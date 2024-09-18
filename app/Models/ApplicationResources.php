<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationResources extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id', 'name','url'
    ];
    
}
