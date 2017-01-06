<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $fillable = ["rfc", "award_id"];

  public function address(){
    return $this->morphOne('App\Models\Address', 'address');
  }

  public function contact(){
    return $this->morphOne('App\Models\ContactPoint', 'contact');
  }
}
