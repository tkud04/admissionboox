<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolBanners extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'url','first'
    ];
    
}
