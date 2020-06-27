<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository extends Repository
{

	protected $conditions = ['like_new', 'excellent', 'good', 'fair'];
	protected $categories = ['home_furniture', 'office_furniture', 'electronics', 'others'];
	protected $status = ['sell_request', 'bought', 'listed_for_sell', 'booked', 'sold'];
	protected $sort = ['product_name-asc', 'product_name-desc', 'created_at-asc', 'created_at-desc', 'price-asc', 'price-desc', 'views-asc', 'views-desc'];

	public function model()
	{
		return 'App\Models\Product';
	}

	/**
	 * find a model by slug and throw exception if the slug is not valid
	 * @param  string $slug    
	 * @param  array  $columns 
	 * @return mixed          
	 */
	public function requiredBySlug($slug, $columns = ['*'])
	{
		$model = $this->model->where('product_slug', '=', $slug)->first($columns);

		if(!$model){
			throw new ModelNotFoundException("Model not found exception ", 404);
		}

		return $model;
	}

	public function store($request)
	{

		$input = $request->except(['main_category', 'category']);

		if(authUser()->is_admin){
			$input['status'] = 'listed_for_sell';
		}else{
			$input['status'] = 'sell_request';
		}

		if($request->sub_category){
			$input['category_id'] = $request->sub_category;
		}else{
			if($request->category){
				$input['category_id'] = $request->category;
			}else{
				$input['category_id'] = $request->main_category;
			}
		}

    	$product = authUser()->products()->create($input);


		if($request->hasFile('image')){
			foreach ($request->image as $key => $image) {

				$data = $this->uploadPhoto($image, "uploads/products/{$product->id}", null, 380, 284, 190);

				$product->images()->create(['image_name' => $data['originalFileName'], 'image_path' => $data['photo_path'], 'mime_type' => $data['mime_type'], 'image_size' => $data['file_size']]);
			}
		}
		return $product;
	}

	public function renew($product, $request)
	{

		$input = $request->except(['main_category', 'category']);

		if(authUser()->is_admin){
			$input['status'] = 'listed_for_sell';
		}else{
			$input['status'] = 'sell_request';
		}

		if($request->sub_category){
			$input['category_id'] = $request->sub_category;
		}else{
			if($request->category){
				$input['category_id'] = $request->category;
			}else{
				$input['category_id'] = $request->main_category;
			}
		}

		if($request->is_featured == 'on'){
			$input['is_featured'] = 1;
		}else{
			$input['is_featured'] = 0;
		}

		if($request->is_negotiable == 'on'){
			$input['is_negotiable'] = 1;
		}else{
			$input['is_negotiable'] = 0;
		}

		if($request->home_delivery == 'on'){
			$input['home_delivery'] = 1;
		}else{
			$input['home_delivery'] = 0;
		}
		$input['category'] = null;

    	$product->update($input);


		//update images if they already exists
		
		$old_array = [];
		$new_array = [];
		if($request->hasFile('image')){
			foreach ($request->image as $key => $image) {

				if ($image) {
					foreach ($product->images as $k => $old_img) {
						$old_array[] = $k;
						if($k == $key){
							$data = $this->uploadPhoto($image, "uploads/products/{$product->id}", $old_img->image_path, 380, 284, 190);

							$old_img->update(['image_name' => $data['originalFileName'], 'image_path' => $data['photo_path'], 'mime_type' => $data['mime_type'], 'image_size' => $data['file_size']]);
						}
					}
					$new_array[] = $key;
				}
			}
		}

		//create new images if they are not exists
		//to find if the image already eexiss or not find difference between value of new image array and old image array keys

		$diff = array_diff($new_array, $old_array);

		if($diff){
			foreach ($diff as $key => $d) {
				$data = $this->uploadPhoto($request->image[$d], "uploads/products/{$product->id}", null, 380, 284, 190);

				$product->images()->create(['image_name' => $data['originalFileName'], 'image_path' => $data['photo_path'], 'mime_type' => $data['mime_type'], 'image_size' => $data['file_size']]);
			}
		}
	
		return $product;	
	}

	public function productModel()
	{
		return $this->model;
	}

	public function fetchAll()
	{
		return $this->searchAndFilter();
	}

	protected function searchAndFilter()
	{
		$search = $this->search();

		$condition = $this->filterByCondition($search);

		$category = $this->filterByCategory($condition);

		$status = $this->filterByStatus($category);

		$price = $this->filterByPrice($status);

		$negotiable = $this->filterByNegotiable($price);

		$discount = $this->filterByDiscount($negotiable);

		$home_delivery = $this->filterByHomeDelivery($discount);

		$featured = $this->filterByFeatured($home_delivery);


		return $this->sort($featured);
	}

	protected function search()
	{
		$q = trim(request()->q);

		return $this->products();
	}

	public function products()
	{
		if(authUser()->is_admin){
			return $this->model->with('images', 'categories');
		}

		return authUser()->products()->with('images', 'categories');
	}

	protected function filterByCondition($search)
	{
		$condition = request()->condition;

		if($condition){
			if(in_array($condition, $this->conditions)){
				return $search->where('condition', $condition);
			}

			abort(404);
		}

		return $search;
	}

	protected function filterByCategory($condition)
	{
		$category = request()->category;

		if($category){
			if(in_array($category, $this->categories)){
				return $condition->where('category', $category);
			}

			abort(404);
		}

		return $condition;
	}

	protected function filterByStatus($category)
	{
		$status = request()->status;

		if($status){
			if(in_array($status, $this->status)){
				return $category->where('status', $status);
			}

			abort(404);
		}

		return $category;
	}

	protected function filterByPrice($status)
	{
		return $status;
	}

	protected function filterByNegotiable($price)
	{
		return $price;
	}


	protected function filterByDiscount($negotiable)
	{
		return $negotiable;
	}

	protected function filterByHomeDelivery($discount)
	{
		return $discount;
	}

	protected function filterByFeatured($home_delivery)
	{
		return $home_delivery;
	}

	protected function sort($featured)
	{
		$sort = request()->sort;

		if($sort){
			if(in_array($sort, $this->sort)){
				list($name, $order) = explode('-', $sort);

				return $featured->orderBy($name, $order);
			}

			abort(404);
		}

		return $featured->orderBy('created_at', 'desc');
	}

}