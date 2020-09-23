<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
      'message',
      'email',
      'date',
      'apartment_id',
    ];

    public function apartments(){
      return $this->belongsTo('App\Apartment');
    }
}
