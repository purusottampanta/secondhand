<?php

namespace App\Models;

use App\Traits\ActivityTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use Sluggable, SoftDeletes, ActivityTrait;

    protected $fillable = ['product_name', 'product_slug', 'status', 'condition', 'category', 'price', 'is_negotiable', 'listing_duration', 'home_delivery', 'delivery_charge', 'views', 'features', 'description', 'is_featured', 'discount'];

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

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }


    public function expiresAt()
    {
        $diff_to_today = Carbon::today()->diffInDays($this->created_at);

        if($diff_to_today > $this->listing_duration){
            return false;
        }else{
            $expiresAt['duration'] = $this->listing_duration - $diff_to_today;
            $expiresAt['date'] = Carbon::today()->addDays($expiresAt['duration']);
            
            return $expiresAt;
        }
    }

    public function imageArray()
    {
        $images = $this->images;
        $image_url = [];
        foreach ($images as $key => $image) {
            $image_url[] = asset($image->image_path);
        }
        return $image_url;
    }
}
