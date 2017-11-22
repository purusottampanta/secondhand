<?php

namespace App\Models;

use App\Traits\ActivityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes, ActivityTrait;

    protected $fillable = ['user_id', 'product_id', 'is_guest', 'new_address', 'status'];

    public function getTitle()
    {
        return $this->id;
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function shippingAddress()
    {
    	return $this->hasOne(ShippingAddress::class);
    }
}
