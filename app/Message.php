<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Message extends Authenticatable
{
    use Notifiable;

    public $table = 'message';

   protected $guard = 'table';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id','receiver_id','message','files','buyerread_status','sellerfavourite_status','buyerfavourite_status','sellerimportant_status','buyerimportant_status','draft_status','created_at','  updated_at',
    ];

   
}
