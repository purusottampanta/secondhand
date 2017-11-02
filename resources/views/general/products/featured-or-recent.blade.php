@extends('layouts.app')

@section('content')
		
	<div class="container">
		<div class="row">
			<div class="col-md-3" >
				<div style="margin-top: -20px">
                    @include('layouts.categories')
                </div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-info">
	                <div class="panel-heading">{{ request()->path() == 'featured' ? 'Featured Ads' : 'New Arrivals' }}</div>
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
			</div>
		</div>
	</div>

@endsection