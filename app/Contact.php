<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\ContactEvent;

class Contact extends Model
{
    protected $dispatchesEvents = [
        'created' => ContactEvent::class,
    ];  
}
