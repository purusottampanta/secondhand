<?php

namespace App\Repositories\Eloquent;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Intervention\Image\ImageManager as Image;

/**
* 								
*/
abstract class Repository
{

	protected $authUser;
	protected $model;
	protected $image;
	protected $per_page = 10;
	protected $current_page = 1;
	private $app;


	public function __construct(App $app, Image $image)
	{
		$this->app = $app;
		$this->image = $image;
		$this->makeModel();
		$this->authUser = auth()->user();
	}

	/**
	 * make model for repositories
	 * @return  mixed
	 */
	public function makeModel()
	{
		$model = $this->app->make($this->model());

		return $this->model = $model;
	}


	/**
	 * this method allows the user to select models for repository
	 * @return  mixed
	 */
	abstract public function model();

	/**
	 * This method fetch all the values from database table for colums
	 * @param  array  $columns columns of database table
	 * @return mixed          [description]
	 */
	public function all($columns = ['*'])
	{
		return $this->model->get($columns);
	}

	/**
	 * this method finds model by id
	 * @param   $id      [description]
	 * @param  array  $columns columns of table to find
	 * @return mixed          [description]
	 */
	public function findById($id, $columns = ['*'])
	{
		return $this->model->find($id, $columns);
	}

	/**
	 * find the models by id and throw model not found excetion if 
	 * 	given id does not exists
	 * @param  integer $id      
	 * @param  array  $columns 
	 * @return mixed          
	 */
	public function requiredById($id, $columns = ['*'])
	{
		$model = $this->model->find($id, $columns);

		if(!$model) {
			throw new ModelNotFoundException("Model not found exception ", 404);
		}

		return $model;
	}

	/**
	 * find the model by slug
	 * @param  string $slug    
	 * @param  array  $columns 
	 * @return mixed          
	 */
	public function findBySlug($slug, $columns = ['*'])
	{
		return $this->model->where('slug', '=', $slug)->first($columns);
	}	

	/**
	 * find a model by slug and throw exception if the slug is not valid
	 * @param  string $slug    
	 * @param  array  $columns 
	 * @return mixed          
	 */
	public function requiredBySlug($slug, $columns = ['*'])
	{
		$model = $this->model->where('slug', '=', $slug)->first($columns);

		if(!$model){
			throw new ModelNotFoundException("Model not found exception ", 404);
		}

		return $model;
	}

	/**
	 * update model by id
	 * @param  array  $data 
	 * @param  integer $id   
	 * @return mixed       
	 */
	public function update(array $data, $id)
	{
		$model = $this->requiredById($id);

		$model->update($data);

		return $model;
	}

	/**
	 * delete a model by its id
	 * @param  integer $id 
	 * @return mixed     
	 */
	public function delete($id)
	{
		$model = $this->requiredById($id);

		return $model->delete($id);
	}


	/**
	 * creates a new instance of model
	 * @param  array  $attributes [description]
	 * @return mixed             [description]
	 */
	public function getNew(array $attributes = [])
	{
		return $this->model->newInstance($attributes);
	}

	/**
	 * this method creates a model 
	 * @param  array  $data array of input data
	 * @return mixed       [description]
	 */
	public function create(array $data)
	{
		return $this->model->create($data);
	}

	/**
	 * this method finds model by id and columns
	 * @param  integer $id      
	 * @param  array  $columns 
	 * @return mixed          
	 */
	public function find($id, $columns = ['*'])
	{
		return $this->model->find($id, $columns);
	}

	/**
	 * this method finds model by given attributes and its value
	 * @param   $attribute 
	 * @param   $value     
	 * @param  array  $columns   
	 * @return mixed            
	 */
	public function findBy($attribute, $value, $columns = ['*'])
	{
		require $this->model->where($attribute, '=', $value)->first($columns);
	}


	/**
	 * this method updates the model by slug
	 * @param  string $slug 
	 * @param  array  $data 
	 * @return mixed       [description]
	 */
	public function updateBySlug($slug, array $data)
	{
		return $this->findBy('slug', $slug)->update($data);
	}

	/**
	 * this method uploads the photo and saves on the uploads/users/{$user->id}/ directory
	 * @param  mixed  $file     uploaded file
	 * @param  string  $path     
	 * @param    $oldFile  
	 * @param  integer $fit      size of image to be made
	 * @param  integer $smallFit 
	 * @return mixed            
	 */
	public function uploadPhoto($file, $path, $oldFile = null, $fit = 140, $fitWidth = 140, $smallFit = 64)
	{
		$data = [];
		$data['file_type'] = null;
		$uploadPath = public_path($path);
		$extension = $file->getClientOriginalExtension();
		$data['file_size'] = filesize($file);
		$filename = time().str_random(20). "." .$extension;
		$data['mime_type'] = $extension;
		$data['originalFileName'] = $file->getClientOriginalName();
	
		if(false == is_dir($uploadPath))
		{
			mkdir($uploadPath, 0777, true);
		}

		// resize photo into different ratio : don't need this code if we don't have to resize; and have to resize before moving
		// 
		
		if(getimagesize($file)){
			$data['file_type'] = 'image';
			$thumbnail = $fit;
			$profile= $smallFit;
			$this->image->make($file->getRealPath())->fit($fitWidth, $thumbnail)->save("{$uploadPath}/thumbnail-{$filename}");
			$this->image->make($file->getRealPath())->fit($profile)->save("{$uploadPath}/thumbnail-small-{$filename}");
		}

		$file->move($uploadPath, $filename);
		$data['photo_path'] = "{$path}/{$filename}";

		if(file_exists($oldFile) && $oldFile){
			unlink(getThumbnail($oldFile));
			unlink(getSmallThumbnail($oldFile));
			unlink($oldFile);
		}

		return $data;
	}

}