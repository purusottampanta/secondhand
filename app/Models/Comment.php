<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ActivityTrait;

class Comment extends Model
{
  	use SoftDeletes;
	use ActivityTrait;

	protected $fillable = ['comment'];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function user()
	{ 
		return $this->belongsTo('App\Models\User');
	}
}
