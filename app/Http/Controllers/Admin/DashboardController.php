<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


/**
* admin dashboard
*/
class DashboardController extends Controller
{
	
	function __construct()
	{
		$this->middleware(['web', 'auth']);
	}

	public function index()
	{
		return view('admin.dashboard');
	}
}