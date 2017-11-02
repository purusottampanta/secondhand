<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends Repository
{
	protected $sortBy = ['full_name-asc', 'full_name-desc', 'created_at-asc', 'created_at-desc'];

	public function model()
	{
		return 'App\Models\User';
	}

	/**
	 * this creates a user
	 * @param   $inputs            
	 * @param   $confirmation_code 
	 * @return mixed                    
	 */
	public function registerUser($inputs, $confirmation_code)
	{
		$user 								= $this->getNew();
		// $user->full_name 			= $inputs['first_name'] . ' ' . $inputs['last_name'];
		$user->full_name 			= $inputs['full_name'];
		$user->email 					=	$inputs['email'];
		$user->street  				= $inputs['street'];
		$user->area_location 	= $inputs['area_location'];
		$user->city 					= $inputs['city'];
		$user->password 			= bcrypt($inputs['password']);
		$user->api_token 			= str_random(60);
		$user->phone 				= $inputs['phone'] ? $inputs['phone'] : NULL;
		$user->mobile_phone         = $inputs['mobile_phone'] ? $inputs['mobile_phone'] : NULL;
		// $user->country 				= $inputs['country'] ? $inputs['country'] : NULL;
		// $user->gender 				= $inputs['gender'] ? $inputs['gender'] : NULL;

		if($confirmation_code){
			$user->confirmation_code = $confirmation_code;
		}else{
			$user->confirmed 	= true;
		}

		$user->save($inputs);

		return $user;
	}

	/**
	 * this mehtod confirms the user
	 * @param  string $confirmation_code 
	 * @return mixed                    
	 */
	public function confirm($confirmation_code)
	{
		$user 										= $this->getNew();
		$user 										= $user->whereConfirmationCode($confirmation_code)->firstOrFail();
		$user->confirmed 					= true;
		$user->confirmation_code 	= null;
		$user->save();
		return $user;
	}

	/**
	 * this method updates the user's profile
	 * @param  int $id      
	 * @param  mixed $request 
	 * @return mixed          
	 */
	public function updateUser($user ,$request)
	{
		$data = $request->all();

		if($request->file('profile_picture')){
			$data['profilePicture'] = $this->uploadPhoto($request->file('profile_picture'), "uploads/users/$user->id", $user->profile_picture);

			$data['profile_picture'] = $data['profilePicture']['photo_path'];
		}

		$user->update($data);

		return $data;
	}

	public function fetchAll()
	{
		return $this->searchAndFilter();
	}

	protected function searchAndFilter()
	{
		$search = $this->search();

		$admin = $this->filterByAdmin($search);

		$confirmed = $this->filterByConfirmed($admin);

		return $this->sort($confirmed);
	}

	protected function search()
	{
		$q = trim(request()->q);

		return $this->users();
	}

	public function users()
	{
		if(authUser()->is_admin){
			return $this->model;
		}

		return null;
	}

	protected function filterByAdmin($search)
	{
		$is_admin = request()->admin;

		if($is_admin){
			if($is_admin == 'admin'){
				return $search->where('is_admin', 1);
			}

			return $search->where('is_admin', 0);
		}

		return $search;
	}

	protected function filterByConfirmed($admin)
	{
		$is_confirmed = request()->confirmed;

		if($is_confirmed){
			if($is_confirmed == 'confirmed'){
				return $admin->where('confirmed', 1);
			}

			return $admin->where('confirmed', 0);
		}

		return $admin;
	}

	protected function sort($confirmed)
	{
		$sortBy = request()->sort;

		if($sortBy){
			if(in_array($sortBy, $this->sortBy)){
				list($name, $order) = explode('-', $sortBy);

				return $confirmed->where($name, $order);
			}

			abort(404);
		}

		return $confirmed->orderBy('created_at', 'DESC');
	}

}