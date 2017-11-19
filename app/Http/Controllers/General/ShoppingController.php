<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;


/**
* 
*/
class ShoppingController extends Controller
{
	protected $productRepo;
	
	function __construct(ProductRepository $productRepo)
	{
		$this->middleware('auth');
		$this->productRepo = $productRepo;
	}

	public function addToCart(Request $request, $productId)
	{
		dd($productId);
		// if(auth()->check()){

		// }else{
		// 	session(['addToCart' => 'add-to-cart']);
		// 	return view('general.shopping.guest-buyer');
		// }
	}
}