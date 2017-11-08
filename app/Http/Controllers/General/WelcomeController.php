<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\SliderRepository;
use App\Events\Product\ProductViewCounter;

class WelcomeController extends Controller
{

	protected $productRepo;
   protected $slider;

   function __construct(ProductRepository $productRepo, SliderRepository $slider)
   {
   		$this->productRepo = $productRepo;
         $this->slider = $slider;
   }

   public function index()
   {

   		$products = $this->productRepo->productModel()->with(['images' => function($q){
   			$q->oldest();
   		}])->where('status', 'listed_for_sell')->latest()->get()->take(9);

   		$featured = $this->productRepo->productModel()->with(['images' => function($q){
               $q->oldest();
         }])->where('status', 'listed_for_sell')->where('is_featured', 1)->latest()->get()->take(9);

         $sliders = $this->slider->sliderModel()->orderBy('position', 'ASC')->get();

   		return view('welcome', compact('featured', 'products', 'sliders'));
   }

   public function showProduct($category, $product_slug)
   {
      $product = $this->productRepo->requiredBySlug($product_slug);

      event(new ProductViewCounter($product));

      return view('general.products.show', compact('product'));
   }

   public function productByCategory($category)
   {
      $products = $this->productRepo->productModel()->with(['images' => function($q){
            $q->oldest();
         }])->where('status', 'listed_for_sell')->where('category', $category)->latest()->paginate(30);

      return view('general.products.bycategory', compact('products', 'category'));
   }

   public function featuredOrRecentOnly()
   {
      if(request()->path() == 'featured'){

         $products = $this->productRepo->productModel()->with(['images' => function($q){
               $q->oldest();
         }])->where('status', 'listed_for_sell')->where('is_featured', 1)->latest()->paginate(30);
      }else{
         $products = $this->productRepo->productModel()->with(['images' => function($q){
            $q->oldest();
         }])->where('status', 'listed_for_sell')->latest()->paginate(30);
      }

      return view('general.products.featured-or-recent', compact('products'));
   }
}
