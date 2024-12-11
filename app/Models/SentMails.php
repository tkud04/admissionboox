<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentMails extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'title' , 'content', 'num_applicants', 'sent_by'
    ];
    
}
