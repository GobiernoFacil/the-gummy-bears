<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
  protected $fillable = ['local_id', 'tender_id'];
  protected $geofields = ['location'];

  public function myitem(){
    return $this->morphTo();
  }

  public function setLocationAttribute($value){
  	$this->attributes['location'] = DB::raw("POINT($value)");
  }

  public function getLocationAttribute($value){
  	$loc =  substr($value, 6);
    $loc = preg_replace('/[ ,]+/', ',', $loc, 1);
 
    return substr($loc,0,-1);
  }
 
  public function newQuery($excludeDeleted = true){
  	$raw='';
    foreach($this->geofields as $column){
      $raw .= ' astext('.$column.') as '.$column.' ';
    }
 
    return parent::newQuery($excludeDeleted)->addSelect('*',DB::raw($raw));
  }


}
