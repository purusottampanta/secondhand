<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ActivityTrait;

class Category extends Model
{
  use SoftDeletes;
  use ActivityTrait;
	
  protected $fillable = ['category', 'slug', 'parent_id', 'is_active', 'category_icon', 'display_position', 'category_image'];

  public function getTitle()
  {
  	return $this->category;
  }

  public function products()
  {
  	return $this->hasMany(Product::class);
  }

  public function childs()
  {
    return $this->where('parent_id', $this->id)->count();
  }

  public function childCategories()
  {
    return $this->hasMany(Category::class, 'parent_id', 'id');
  }

  public function grandChildCategories()
  {
    return $this->hasMany(Category::class, 'parent_id', 'id')->whereIn('id', $this->childCategories->pluck('id'));
  }

  public function parentCategory()
  {
    return $this->belongsTo(Category::class, 'parent_id', 'id')->where('id', $this->parent_id);
  }

  public function grandParentCategory()
  {
    return $this->belongsTo(Category::class, 'parent_id', 'id');
  }
}
