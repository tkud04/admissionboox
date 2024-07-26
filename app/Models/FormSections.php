<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSections extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_id', 'title','description'
    ];
    
}
