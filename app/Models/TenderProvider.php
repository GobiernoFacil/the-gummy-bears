<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenderProvider extends Model {
  protected $table = "provider_tender";
  protected $fillable = ['tender_id', 'provider_id'];
	//

}
