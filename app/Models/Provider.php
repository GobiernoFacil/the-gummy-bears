<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
  protected $fillable = ["name", "rfc"];

  public function tenders(){
    return $this->belongsToMany('App\Models\Tender', 'provider_tender');
  }

  public function awards(){
    return $this->belongsToMany('App\Models\Award', 'provider_award');
  }

  public function buyers(){
    return $this->hasMany("App\Models\BuyerProvider");
  }
}
