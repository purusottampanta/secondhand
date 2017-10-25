<?php

namespace App\Models;

use App\Traits\ActivityTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use SoftDeletes, ActivityTrait;

    protected $fillable = ['image_name', 'image_path', 'mime_type', 'image_size'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    // public function sluggable()
    // {
    //     return [
    //         'product_slug' => [
    //             'source' => 'product_name'
    //         ]
    //     ];
    // }

    public function getTitle()
    {
        return $this->image_name;
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}