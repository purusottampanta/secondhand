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
   protected $status = ['listed_for_sell', 'booked', 'sold'];

   function __construct(ProductRepository $productRepo, SliderRepository $slider)
   {
   		$this->productRepo = $productRepo;
         $this->slider = $slider;
   }

   public function index()
   {

   		// $products = $this->productRepo->productModel()->with(['images' => function($q){
     //        $q->oldest();
     //     }])->where('status', 'listed_for_sell')->where('is_featured', 0)->latest()->get()->take(12);

     //     $featured = $this->productRepo->productModel()->with(['images' => function($q){
     //           $q->oldest();
     //     }])->where('status', 'listed_for_sell')->where('is_featured', 1)->latest()->get()->take(12);

         $products = $this->productRepo->productModel()->with(['images' => function($q){
   			$q->oldest();
   		}])->whereIn('status', $this->status)->where('is_featured', 0)->latest()->get()->take(4);

   		$featured = $this->productRepo->productModel()->with(['images' => function($q){
               $q->oldest();
         }])->whereIn('status', $this->status)->where('is_featured', 1)->latest()->get()->take(4);

         $sliders = $this->slider->sliderModel()->orderBy('position', 'ASC')->get();

   		return view('welcome', compact('featured', 'products', 'sliders'));
   }

   public function showProduct($category, $product_slug)
   {
      $product = $this->productRepo->requiredBySlug($product_slug);

      $product = $product->load('comments.user');

      $comments = $product->comments->groupBy('parent_id');

      $similar_products = $this->productRepo->productModel()->with(['images' => function($q){
            $q->oldest();
         }])->whereIn('status', $this->status)->where('category', $product->category)->where('id', '!=', $product->id)->latest()->limit(4)->get();

      $popular_products = $this->productRepo->productModel()->with(['images' => function($q){
            $q->oldest();
         }])->whereIn('status', $this->status)->where('id', '!=', $product->id)->orderBy('views', 'desc')->limit(6)->get();

      event(new ProductViewCounter($product));

       if(isset($comments['']))
       {
         $comments['root'] = $comments[''];

         unset($comments['']);
       }
// return $product;
      return view('general.products.show', compact('product', 'similar_products', 'popular_products', 'comments'));
   }

   public function productByCategory($category)
   {
      $products = $this->productRepo->productModel()->with(['images' => function($q){
            $q->oldest();
         }])->whereIn('status', $this->status)->where('category', $category)->latest()->paginate(20);

      return view('general.products.bycategory', compact('products', 'category'));
   }

   public function featuredOrRecentOnly()
   {
      if(request()->path() == 'featured'){

         $products = $this->productRepo->productModel()->with(['images' => function($q){
               $q->oldest();
         }])->whereIn('status', $this->status)->where('is_featured', 1)->latest()->paginate(20);
      }else{
         $products = $this->productRepo->productModel()->with(['images' => function($q){
            $q->oldest();
         }])->whereIn('status', $this->status)->where('is_featured', 0)->latest()->paginate(20);
      }

      return view('general.products.featured-or-recent', compact('products'));
   }
}
