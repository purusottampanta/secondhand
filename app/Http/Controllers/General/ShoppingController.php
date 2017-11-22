<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\UserRepository;


/**
* 
*/
class ShoppingController extends Controller
{
	protected $productRepo;
	protected $userRepo;
	
	function __construct(ProductRepository $productRepo, UserRepository $userRepo)
	{
		// $this->middleware('auth');
		$this->productRepo = $productRepo;
		$this->userRepo = $userRepo;
	}

	public function addToCart(Request $request, $productId)
	{
		// dd($productId);
		$product = $this->productRepo->requiredById($productId);
		if($product->status === 'listed_for_sell'){

			if(authUser()){
				if(authUser()->incompleteProfile()){
					session(['incompleteProfile' => 'incomplete profile buyer']);
					session(['orderItem' => $product]);
					return view('general.shopping.shipping-details');
				}else{

					session(['orderItem' => $product]);
					return view('general.shopping.shipping-details');
				}
			}else{
				session(['orderItem' => $product]);
				session(['url.intended' => route('general.products.addToCart', $productId)]);
				return view('general.shopping.guest-buyer');
			}
		}else{
			return back()->withError('Product already booked or sold');
		}
		
	}

	public function continueAsGuest()
	{
		session()->forget('url.intended');
		return view('general.shopping.shipping-details');
	}

	public function buyNow(Request $request, $productId, $userId = null, $incompleteProfile = null)
	{
		if($userId){
			if($incompleteProfile){
				$user = $this->userRepo->requiredById($userId);
				
				$this->userRepo->updateUser($user, $request);

				$order = $user->orders()->create([
					'product_id' => $productId,
					'is_guest' => 0,
					'new_address' => 1,
					'status' => 'booked',
				]);

				$this->addNewShippingAddress($order, $request);

				$this->updateProductStatus($productId);
			}else{
				$user = $this->userRepo->requiredById($userId);
				if($request->has('profile_address') && $request->profile_address == '1'){

					$order = $user->orders()->create([
						'product_id' => $productId,
						'is_guest' => 0,
						'new_address' => 0,
						'status' => 'booked',
					]);

					$this->updateProductStatus($productId);
				}else{
					$order = $user->orders()->create([
						'product_id' => $productId,
						'is_guest' => 0,
						'new_address' => 1,
						'status' => 'booked',
					]);

					$this->addNewShippingAddress($order, $request);

					$this->updateProductStatus($productId);
				}
			}
		}else{
			if($request->has('create_account') && $request->create_account == '1'){
				$inputs = $request->all();
				$inputs['password'] = str_random();
				$user = $this->userRepo->registerUser($inputs, null);

				$order = $user->orders()->create([
					'product_id' => $productId,
					'is_guest' => 0,
					'new_address' => 1,
					'status' => 'booked',
				]);

				$this->addNewShippingAddress($order, $request);

				$this->updateProductStatus($productId);

			}else{
				$order = new Order;
				$order->product_id = $productId;
				$order->is_guest = 1;
				$order->new_address = 1;
				$order->status = 'booked';

				$order->save();

				$this->addNewShippingAddress($order, $request);

				$this->updateProductStatus($productId);
			}
		}

		session()->forget('orderItem');
		return redirect()->route('welcome')->withStatus('Successfully bought');
	}

	protected function addNewShippingAddress($order, $request)
	{
		$address = $order->shippingAddress()->create([
			'full_name' => authUser() ? authUser()->full_name : $request->full_name,
			'email' => authUser() ? authUser()->email : $request->email,
			'phone' => $request->phone,
			'mobile_phone' => $request->mobile_phone,
			'street' => $request->street,
			'area_location' => $request->area_location,
			'city' => $request->city,
		]);

		return $address;
	}

	protected function updateProductStatus($productId)
	{
		$product = $this->productRepo->requiredById($productId)->update(['status' => 'booked']);

		return $product;
	}
}