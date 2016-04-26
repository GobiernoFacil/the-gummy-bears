<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardProvider extends Model {
  protected $table = "provider_award";
  protected $fillable = ['award_id', 'provider_id'];
	//

}
