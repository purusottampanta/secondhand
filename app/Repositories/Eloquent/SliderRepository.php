<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SliderRepository extends Repository
{

	public function model()
	{
		return 'App\Models\Slider';
	}

	public function store($request)
	{
		$slider = $this->getNew();

		$slider->description = $request->description;
		$slider->page = $request->page ? $request->page : 'home';
		$slider->position = $request->position;

		if($request->has('url')){
			$slider->image_path = $request->url;
			$slider->type = 'url';
		}

		if($request->hasFile('image')){

			$data = $this->uploadPhoto($request->image, "uploads/sliders", null, 189, 283, 190);

				// $slider->images()->create(['image_name' => $data['originalFileName'], 'image_path' => $data['photo_path'], 'mime_type' => $data['mime_type'], 'image_size' => $data['file_size']]);
			$slider->image_name = $data['originalFileName'];
			$slider->image_path = $data['photo_path'];
			$slider->mime_type = $data['mime_type'];
			$slider->image_size = $data['file_size'];
			$slider->type = 'image';
		}

		$slider->save();

		return $slider;
	}

	public function renew($slider, $request)
	{

		$input = $request->all();

		if($request->has('url')){
			$input['image_path'] = $request->url;
			$input['type'] = 'url';
		}


    	if($request->hasFile('image')){

			$data = $this->uploadPhoto($request->image, "uploads/sliders", $slider->image_path, 189, 283, 190);

				// $slider->images()->create(['image_name' => $data['originalFileName'], 'image_path' => $data['photo_path'], 'mime_type' => $data['mime_type'], 'image_size' => $data['file_size']]);
			$input['image_name'] = $data['originalFileName'];
			$input['image_path'] = $data['photo_path'];
			$input['mime_type'] = $data['mime_type'];
			$input['image_size'] = $data['file_size'];
			$input['type'] = 'image';
		}

		
    	$slider->update($input);
	
		return $slider;	
	}


	public function sliderModel()
	{
		return $this->model;
	}

}