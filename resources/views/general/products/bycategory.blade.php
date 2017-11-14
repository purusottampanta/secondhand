@extends('layouts.app')

@section('content')
		
	<div class="container">
		<div class="row">
			{{-- <div class="col-md-3">
				<div style="margin-top: -20px">
                    @include('layouts.categories')
                </div>
			</div> --}}
			{{-- <div class="col-md-9">
				<div class="panel panel-info">
	                <div class="panel-heading">{{ getCategories()[$category] }}</div>
	                <div class="panel-body pad-0">
						<div class="col-md-12">
							@forelse($products->chunk(6) as $index => $chunked_products)
								<div class="row">
									@foreach($chunked_products as $key => $product)
										<div class="col-md-2">
											<a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
				                                <div class="row pad-b-20">
				                                    <div class="pad-10">
				                                        <img src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : '' }}" height="100%" width="100%" alt="{{ $product->product_name }}">
				                                    </div>
				                                    <div class="pad-10 text-center">
				                                        {{ $product->product_name }}
				                                        <br>
				                                        Rs. {{ $product->price }}
				                                        <br>
				                                        ({{ ucfirst(implode(' ', explode('_', $product->condition))) }})
				                                    </div>
				                                </div>
				                            </a>
										</div>
									@endforeach
								</div>
							@empty
								<div class="text-center pad-20">
									Sorry! No products belongs to this category.
								</div>
							@endforelse
						</div>
						<div class="pull-right">
							{{ $products->links() }}
						</div>
					</div>
				</div>
			</div> --}}

			<div class="product-agile pad-20">
                <div class="container">
                    <h3 class="tittle1">{{ getCategories()[$category] }}</h3>
                    <div class="arrivals-grids">
                    	@forelse($products->chunk(4) as $index => $chunked_products)
                    		<div class="row mar-b-20">
		                        @foreach($chunked_products as $key => $product)
		                            <div class="col-md-3 col-xs-6 col-sm-6 arrival-grid simpleCart_shelfItem">
		                                <div class="grid-arr">
		                                    <div  class="grid-arrival">
		                                        <figure>        
		                                            <a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
		                                                <div class="grid-img">
		                                                    <img  src="{{ $product->images->first() ? $product->images->first()->thumbnail() : '' }}" class="img-responsive" alt="">
		                                                </div>
		                                                <div class="grid-img">
		                                                    <img  src="{{ $product->images->first() ? $product->images->first()->thumbnail() : '' }}" class="img-responsive"  alt="">
		                                                </div>          
		                                            </a>        
		                                        </figure>   
		                                    </div>
		                                    @if($product->status == 'sold')
		                                        <div class="ribben1">
		                                            <p>sold</p>
		                                        </div>
		                                    @elseif($product->status == 'booked')
		                                        <div class="ribben">
		                                            <p>booked</p>
		                                        </div>
		                                    @endif
		                                    
		                                    {{-- <div class="ribben1">
		                                        <p>SALE</p>
		                                    </div> --}}
		                                    <div class="block">
		                                        <div class="starbox small ghosting"> </div>
		                                    </div>
		                                    <div class="women" style="{{ strlen($product->product_name) > 25 ? '' : 'padding-top: 0.5em;'  }}">
		                                        <h6>
		                                            <a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
		                                                {{ str_limit($product->product_name, 44) }}
		                                            </a>
		                                        </h6>
		                                        {{-- <span class="size">XL / XXL / S </span> --}}
		                                        <p >
		                                            {{-- <del>$100.00</del> --}}
		                                            <em class="item_price">Rs. {{ $product->price }}</em>
		                                        </p>
		                                        {{-- <a href="#" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a> --}}
		                                    </div>
		                                </div>
		                            </div>
		                         @endforeach
		                     </div>
                        @empty
							<div class="text-center pad-20">
								Sorry! No products belongs to this category.
							</div>
                        @endforelse
                        <div class="clearfix"></div>
                    </div>
                    <div class="pull-right">
							{{ $products->links() }}
						</div>
                </div>
            </div>
		</div>
	</div>

@endsection