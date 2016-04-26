<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractHistory extends Model {
  protected $table = "contracts_history";
  protected $fillable = ["contract_id", "release_id"];
	//

  public function contract(){
    return $this->belongsTo('App\Models\Contract');
  }

  public function release(){
    return $this->belongsTo('App\Models\Release');
  }

}