<?php

namespace App\Composers;

use App\Repositories\Eloquent\CmsPageRepository;
use Illuminate\View\View;

/**
* 
*/
class CmsPageComposer
{

	protected $cmsPageRepo;
	
	function __construct(CmsPageRepository $cmsPageRepo)
	{
		$this->cmsPageRepo = $cmsPageRepo;
	}

	public function compose(View $view)
	{
		$cms_pages = $this->cmsPageRepo->cmsPages()->where('status', 1)->orderBy('display_position')->get();

 
		$view->with('cms_pages', $cms_pages);
	}
}