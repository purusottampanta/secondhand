<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository extends Repository {

	public function model()
	{
		return 'App\Models\Category';
	}

	public function fetchRootCategory()
	{
		return $this->model->with('childCategories')->get();
	}

	public function parentCategories()
	{
		return $this->model->with('childCategories')->whereNull('parent_id');
	}

	public function getCategoryList($categoryId)
	{

		return $this->model->where('parent_id', $categoryId)->get();

	}

	public function groupedCategories()
	{
		$categories = $this->fetchRootCategory()->where('is_active', true)->groupBy('parent_id');

	   	if(count($categories)>0)
	   	{
	   	$categories['root'] = $categories[''];
	      unset($categories['']);
	   	}

	   	return $categories;
	}

	public function getIdsOfChildAndGrandChild($selected_category)
	{
		$category_ids = [0];

		if(!empty($selected_category->childCategories)){
		  foreach ($selected_category->childCategories as $key => $child)
		  {
		    array_push($category_ids, $child->id);
		    $category_ids = array_merge($category_ids, $child->childCategories->pluck('id')->toArray());
		  }
		}

		array_push($category_ids, $selected_category->id);

		return $category_ids;
	}
}