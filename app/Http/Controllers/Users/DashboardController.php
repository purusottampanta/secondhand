<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;


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
		// $users = $this->userRepo->all();
		$products = $this->productRepo->products();

		return view('users.dashboard', compact('users', 'products'));
	}

	/**
	 * logout the user
	 * @param  Request $request 
	 * @return mixed           
	 */
	public function logout(Request $request)
	{
	    \Auth::guard()->logout();

	    $request->session()->flush();

	    $request->session()->regenerate();

	    return redirect()->route('login');
	}
}