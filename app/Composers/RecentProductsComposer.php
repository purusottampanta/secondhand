<?php

namespace App\Composers;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\View\View;

/**
* 
*/
class RecentProductsComposer
{

	protected $productRepo;
	
	function __construct(ProductRepository $productRepo)
	{
		$this->productRepo = $productRepo;
	}

	public function compose(View $view)
	{
		$recent_products = $this->productRepo->stockedProductsWithoutRelated()->latest()->limit(5)->get();
 
		$view->with('recent_products', $recent_products);
	}
}