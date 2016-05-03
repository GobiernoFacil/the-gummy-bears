<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
  protected $fillable = ["local_id", "contract_id", "ocid", "date", 
  "initiation_type", "planning_id", "buyer_id", "tender_id", "language", "is_latest"];

  public function contract(){
    return $this->belongsTo('App\Models\Contract');
  }

  public function planning(){
    return $this->hasOne('App\Models\Planning');
  }

  public function buyer(){
    return $this->belongsTo('App\Models\Buyer', 'buyer_id', 'id');
  }

  public function tender(){
    return $this->hasOne('App\Models\Tender');
  }

  public function singlecontracts(){
    return $this->hasMany('App\Models\SingleContract');
  }
  
  public function awards(){
    return $this->hasMany('App\Models\Award');
  }

  public function suppliers(){
    return $this->hasManyThrough('App\Models\Supplier', 'App\Models\Award');
  }
}
