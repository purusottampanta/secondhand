<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;
use App\Events\Product\ProductViewCounter;

class WelcomeController extends Controller
{

	protected $productRepo;

   function __construct(ProductRepository $productRepo)
   {
   		$this->productRepo = $productRepo;
   }

   public function index()
   {

   		$products = $this->productRepo->productModel()->with(['images' => function($q){
   			$q->oldest();
   		}])->where('status', 'listed_for_sell')->latest()->get();

   		$featured = $products->where('is_featured', 1);

   		return view('welcome', compact('featured', 'products'));
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
         }])->where('status', 'listed_for_sell')->where('category', $category)->latest()->get();

      return view('general.products.bycategory', compact('products'));
   }
}
