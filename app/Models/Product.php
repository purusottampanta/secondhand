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

    protected $fillable = ['product_name', 'product_slug', 'status', 'condition', 'category', 'category_id', 'price', 'is_negotiable', 'listing_duration', 'home_delivery', 'delivery_charge', 'views', 'features', 'description', 'is_featured', 'discount', 'page_title', 'meta_key', 'meta_description'];

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

    public function categories()
    {
    	return $this->belongsTo(Category::class, 'category_id', 'id')->withTrashed();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function maincategory()
    {
        $value = $this->category_id;
        $catValue1 = Category::find($value);

        if($catValue1 && $catValue1->parent_id)
        {
            $catValue2 = Category::find($catValue1->parent_id);

            if($catValue2->parent_id){

                $catValue3 = Category::find($catValue2->parent_id);
                return $catValue3->id;

            }else{

                return $catValue2->id;

            }
        }else{

            return $catValue1->id;

        }
    }

    public function submaincategory()
    {
        $value = $this->category_id;

        $catValue1 = Category::find($value);

        if($catValue1 && $catValue1->parent_id)
        {
            $catValue2 = Category::find($catValue1->parent_id);

            if($catValue2->parent_id){
                // if($catValue2->parent_id == $catValue1->id){
                    return $catValue2->id;
                // }else{
                //  return null;
                // }
                
                
            }else{
                return $catValue1->id;
            }
        }else{
            return null;
        }
    }

    public function subcategory()
    {
        $value = $this->category_id;

        $catValue1 = Category::find($value);

        if($catValue1 && $catValue1->parent_id)
        {
            $catValue2 = Category::find($catValue1->parent_id);

            if($catValue2->parent_id){
                
                return $catValue1->id;
            }else{
                return null;
            }
        }else{
            return null;
        }
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
