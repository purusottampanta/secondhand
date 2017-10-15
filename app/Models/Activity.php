<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $table = 'activity_log';

  protected $fillable = ['user_id', 'object', 'ip_address', 'activity', 'field', 'before', 'after'];

 	public function loggable()
  {
      return $this->morphTo();
  }

  public function user()
  {
      return $this->belongsTo('App\Models\User', 'user_id');
  }

  /**
   * this method gives logged nodel name
   * @return mixed 
   */
  public function getModelName()
  {
    return class_basename($this->loggable_type);
  }
}
