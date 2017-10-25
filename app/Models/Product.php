<?php

namespace App\Models;

use App\Traits\ActivityTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable, SoftDeletes, ActivityTrait;

    protected $fillable = ['product_name', 'product_slug', 'status', 'condition', 'category', 'price', 'listing_duration', 'delivery_charge', 'features', 'description'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'product_slug' => [
                'source' => 'product_name'
            ]
        ];
    }

    public function getTitle()
    {
        return $this->product_name;
    }

    public function images()
    {
    	return $this->hasMany(Image::class);
    }
}
