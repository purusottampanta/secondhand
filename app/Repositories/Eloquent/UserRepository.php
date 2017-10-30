<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends Repository
{
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
		// $user->country 				= $inputs['country'];
		$user->street  				= $inputs['street'];
		$user->area_location 	= $inputs['area_location'];
		$user->city 					= $inputs['city'];
		$user->password 			= bcrypt($inputs['password']);
		$user->api_token 			= str_random(60);

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
		// $user = $this->requiredById($id);
		// request zip and phone also
		$data = $request->except('first_name', 'last_name', 'profile_picture', 'zip', 'phone');
		$data['full_name'] = $request->first_name . ' ' . $request->last_name;
		if($request->file('profile_picture')){
			$data['profilePicture'] = $this->uploadPhoto($request->file('profile_picture'), "uploads/users/$user->id", $user->profile_picture);

			$data['profile_picture'] = $data['profilePicture']['photo_path'];
		}

		$user->update($data);

		if($request->has('role')){
			$user->assignMultipleRole($request->role);
		}

		return $data;
	}

}