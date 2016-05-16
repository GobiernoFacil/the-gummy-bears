<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerProvider extends Model {
  protected $fillable = ["provider_id", "buyer_id"];
	//
  public function buyer(){
    return $this->belongsTo('App\Models\Buyer');
  }

  public function provider(){
    return $this->belongsTo('App\Models\Provider');
  }

}
