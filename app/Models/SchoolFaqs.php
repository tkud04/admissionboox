<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolFaqs extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'faq_question', 'faq_answer'
    ];
    
}
