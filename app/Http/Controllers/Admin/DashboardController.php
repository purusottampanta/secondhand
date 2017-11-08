<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\UserRepository;


/**
* admin dashboard
*/
class DashboardController extends Controller
{
	protected $productRepo;
	protected $userRepo;
	
	function __construct(ProductRepository $productRepo, UserRepository $userRepo)
	{
		$this->middleware(['web', 'auth']);
		$this->productRepo = $productRepo;
		$this->userRepo = $userRepo;
	}

	public function index()
	{
		$users = $this->userRepo->all();
		$products = $this->productRepo->all();

		return view('admin.dashboard', compact('users', 'products'));
	}
}