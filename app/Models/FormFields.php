<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormFields extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id', 'title','type','description','bs_length','options'
    ];
    
}