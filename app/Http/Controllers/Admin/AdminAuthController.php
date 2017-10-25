<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
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