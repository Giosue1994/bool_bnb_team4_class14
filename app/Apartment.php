<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
      'title',
      'rooms',
      'baths',
      'beds',
      'mqs',
      'description',
      'guests',
      'user_id',
      'latitude',
      'longitude',
      'address',
      'city',
      'zip',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function images(){
      return $this->hasMany('App\Image');
    }

    // public function sponsors(){
    //   return $this->belongsToMany('App\Sponsor');
    // }

    // public function statistics() {
    //   return $this->hasMany('App\Statistic');
    // }

    public function services(){
      return $this->belongsToMany('App\Service');
    }
}
