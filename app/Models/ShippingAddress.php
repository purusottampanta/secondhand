<?php

namespace App\Models;

use App\Traits\ActivityTrait;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use ActivityTrait;

    protected $table = 'shipping_address';

    protected $fillable = ['full_name', 'email', 'phone', 'mobile_phone', 'street', 'area_location', 'city', 'country'];

    public function getTitle()
    {
        return $this->email;
    }

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}
