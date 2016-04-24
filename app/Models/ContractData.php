<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractData extends Model {
  protected $table = "contracts_data";
  protected $fillable = ["contract_id"];
	//

  public function contract(){
    return $this->belongsTo('App\Models\Contract');
  }

  public function release(){
    return $this->belongsTo('App\Models\Release');
  }

}
