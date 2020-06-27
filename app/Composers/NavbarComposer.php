<?php

namespace App\Composers;

use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\View\View;

/**
* 
*/
class NavbarComposer
{

	protected $categoryRepo;
	
	function __construct(CategoryRepository $categoryRepo)
	{
		$this->categoryRepo = $categoryRepo;
	}

	public function compose(View $view)
	{
		$categories = $this->categoryRepo->fetchRootCategory()->where('is_active', true)->sortByDesc('display_position')->groupBy('parent_id');

   	if(count($categories)>0)
   	{
   	$categories['root'] = $categories[''];
      unset($categories['']);
   	}
 
		$view->with('categories', $categories);
	}
}