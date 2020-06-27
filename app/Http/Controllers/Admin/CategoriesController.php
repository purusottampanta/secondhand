<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Repositories\Eloquent\CategoryRepository;

class CategoriesController extends Controller
{

	protected $categoryReppo;

   function __construct(CategoryRepository $categoryReppo)
   {
   		$this->middleware('auth');
   		$this->categoryReppo = $categoryReppo;
   }

   public function index()
   {
   	$categories = $this->categoryReppo->fetchRootCategory()->sortByDesc('display_position')->groupBy('parent_id');

   	youAreDenied('view', authUser());

   	if(count($categories)>0)
   	{
   	$categories['root'] = $categories[''];
      unset($categories['']);
   	}
 
   	return view('admin.categories.index', compact('categories'));
   }

   public function store(CreateCategoryRequest $request)
   {
   	youAreDenied('create', authUser());

      if($request->hasFile('category_image'))
      {
         $image = $this->categoryReppo->uploadPhoto($request->file('category_image'), "uploads/products/categories");
      }else{
         $image['photo_path'] = null;
      }

      $category = [
      'category'  => $request->category,
      'parent_id' => $request->parent_id ? : null,
      'slug'         => str_slug(strtolower($request->category), '_'),
      'is_active' => $request->is_active,
      'category_image' => $image['photo_path'],
      'category_icon' => $request->category_icon,
      'display_position' => $request->display_position,
    ];

    $this->categoryReppo->create($category);

    return back()->withStatus('Success');

   }

   public function edit($categoryId)
   {
   	$category = $this->categoryReppo->requiredById($categoryId);

   	youAreDenied('update', $category);

   	return view('admin.categories.edit', compact('category'));
   }

   public function update(UpdateCategoryRequest $request, $categoryId)
   {
   		$category = $this->categoryReppo->requiredById($categoryId);

   		// youAreDenied('update', $category);
         
         if($request->hasFile('category_image'))
         {
            $image = $this->categoryReppo->uploadPhoto($request->file('category_image'), "uploads/products/categories");
         }else{
            $image['photo_path'] = $category->category_image;
         }

   		try {

   			$category->update([
	   			'category' => $request->category,
	      	'slug'			=> str_slug(strtolower($request->category), '_'),
	      	'is_active' => $request->is_active,
            'category_image' => $image['photo_path'],
            'category_icon' => $request->category_icon,
            'display_position' => $request->display_position,
	   		]);

   		} catch (\Exception $e) {

   			return back()->withError('Category name should be unique with all of items');	
   		}
   		
   		return redirect()->route('admin.categories.index')->withStatus('success');
   }

   public function destroy($id)
   {
      $category = $this->categoryReppo->requiredById($id)->load(['products', 'childCategories']);

      if (request()->ajax()) {
         if (count($category->products) > 0 || count($category->childCategories) > 0) {
            return response()->json(['error' => 'Sorry! can not delete category!', 'code' => 404], 404);
         }else{
            $category = $category->delete();

            if ($category){

               return 'success';

            }else{

               return 'failure';

            }
         }
      }
   }

   public function getCategoryList($categoryId)
   {
      $categories = $this->categoryReppo->getCategoryList($categoryId);

      return response()->json($categories);
   }
}
