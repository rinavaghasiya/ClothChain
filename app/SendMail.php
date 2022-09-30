<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendMail extends Model
{
    public function sendmail($to,$subject,$message)
    {
    	mail($to,$subject,$message);
    }
}
