<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
	  'ss' => "smtp.gmail.com",
       'sp' => "587",
       'sec' => "tls",
       'sa' => "yes",
       'su' => "dunphydavid83@gmail.com",
       'spp' => "kudayisi2$",
       'sn' => "Office Postman",
       'se' => "dunphydavid83@gmail.com"
     */
    protected $fillable = [
        'user_id' , 'country', 'city', 'address'
    ];
    
}
