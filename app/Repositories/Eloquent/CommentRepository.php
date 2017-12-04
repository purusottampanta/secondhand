<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentRepository extends Repository {

	public function model()
	{
		return 'App\Models\Comment';
	}

	public function brands()
	{
		return $this->model;
	}

}