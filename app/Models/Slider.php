<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
   
   protected $fillable = ['description', 'image_name', 'image_path', 'position', 'mime_type', 'type', 'image_size', 'page'];

   	public function smallThumbnail()
    {
        $value = $this->image_path;
        return asset($value ? getSmallThumbnail($value) : 'img/avatar1.jpg');
    }

    public function thumbnail()
    {
        $value = $this->image_path;
        return asset($value ? getThumbnail($value) : 'img/avatar1.jpg');
    }
}
