<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenderTenderer extends Model {
  protected $table = "tender_tenderer";
  protected $fillable = ['tender_id', 'tenderer_id'];
	//

}
