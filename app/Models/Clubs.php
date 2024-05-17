<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'club_name', 'club_value','img_url'
    ];
    
}
