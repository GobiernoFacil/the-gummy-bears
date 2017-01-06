<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Release;
use App\Models\Contract;

class Buyer extends Model
{
  protected $fillable = ["local_id", "uri", "name"];

  public function providers(){
    return $this->hasMany("App\Models\BuyerProvider");
  }

  public function releases(){
    return Release::where(["buyer_id" => $this->id, "is_latest" => 1]);
  }

  public function singlecontracts(){
    return $this->hasManyThrough('App\Models\SingleContract', 'App\Models\Release');
  }

  public function awards(){
    return $this->hasManyThrough('App\Models\Award', 'App\Models\Release');
  }

  public function plannings(){
    return $this->hasManyThrough('App\Models\Planning', 'App\Models\Release');
  }

  public function contracts(){
    return Contract::whereHas("releases", function($q){
      $q->where(["buyer_id" => $this->id, "is_latest" => 1]);
    });
  }

  public function address(){
    return $this->morphOne('App\Models\Address', 'address');
  }

  public function contact(){
    return $this->morphOne('App\Models\ContactPoint', 'contact');
  }
}
