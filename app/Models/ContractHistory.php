<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractHistory extends Model {
  protected $table = "contracts_history";
  protected $fillable = ["contract_id", "release_id"];
	//

}