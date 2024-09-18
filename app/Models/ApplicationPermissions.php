<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationPermissions extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admission_id', 'user_id','permission'
    ];
    
}
