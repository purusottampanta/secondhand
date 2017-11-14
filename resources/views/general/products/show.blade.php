@extends('layouts.app')

@section('stylesheet')
@parent
	<link rel="stylesheet" href="{{ asset('css/flexslider.css') }}" type="text/css" media="screen" />
	<style>
		table tr td{
			max-width: 50px !important;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="bg-white pad-10 border-round">
					<i class="fa fa-chevron-right pad-r-5"></i><a href="{{ route('welcome') }}">Home</a>
					<i class="fa fa-chevron-right pad-r-5"></i><a href="{{ route('general.category', $product->category) }}">{{ getCategories()[$product->category] }}</a>
				</div>
			</div>
			{{-- <div class="col-md-8">
				<div class="bg-white border-round">
					<div class="pull-left">
						<h3 class="pad-10"><strong>{{ $product->product_name }}</strong></h3>
					</div>
				</div>
			</div> --}}
		</div>
		{{-- @foreach($product->images as $image)
								<li data-thumb="{{ $image->smallThumbnail() }}">
									<div class="thumb-image"> <img src="{{ asset($image->image_path) }}" data-imagezoom="true" data-magnification = "2" data-zoomviewposition="left" data-zoomviewmargin="200" data-opacity="0.4" class="img-responsive" alt="" /> </div>
								</li>
							@endforeach --}}
		<div class="single-grids">
			<div class="col-md-9 single-grid">
				<div clas="single-top">
					<div class="single-left">
						<div class="flexslider">
							<ul class="slides">
								@foreach($product->images as $image)
									<li data-thumb="{{ $image->smallThumbnail() }}">
										<div class="thumb-image"> <img src="{{ asset($image->image_path) }}" data-imagezoom="true" class="img-responsive" alt="" /> </div>
									</li>
								@endforeach
								{{-- <li data-thumb="images/si.jpg">
									<div class="thumb-image"> <img src="images/si.jpg" data-imagezoom="true" class="img-responsive"> </div>
								</li>
								<li data-thumb="images/si1.jpg">
									 <div class="thumb-image"> <img src="images/si1.jpg" data-imagezoom="true" class="img-responsive"> </div>
								</li>
								<li data-thumb="images/si2.jpg">
								   <div class="thumb-image"> <img src="images/si2.jpg" data-imagezoom="true" class="img-responsive"> </div>
								</li>  --}}
							 </ul>
						</div>
					</div>
					<div class="single-right simpleCart_shelfItem">
						<h4>{{ $product->product_name }}</h4>
						<div class="block">
							<div class="starbox small ghosting"> </div>
						</div>
						<p class="price item_price">Rs. {{ $product->price }}</p>
						@if($product->description)
							<div class="description">
								<p><span>Quick Overview : </span>
									{{ $product->description }}
								</p>
							</div>
						@endif
						<div class="color-quality">
							<h6>Quality : <small>{{ getCategories()[$product->category] }}</small></h6>
						</div>
						<div class="color-quality">
							<h6>Condition : <small>{{ ucfirst(implode(' ', explode('_', $product->condition))) }}</small></h6>
						</div>
						@if($product->home_delivery)
							<p>Home delivery available</p>
							<div class="color-quality">
								<h6>Delivery charge : <small>Rs. {{ $product->delivery_charge }}</small></h6>
							</div>
						@endif
							<p>{{ $product->is_negotiable ? 'Price can be negotiated.' : 'Fixed price' }}</p>
						<div class="women">
							<a href="#" data-text="Add To Cart" class="my-cart-b item_add">Buy now</a>
						</div>
						<div class="social-icon">
							<a href="https://www.facebook.com/secondhandshop.ktm/" target="_blank"><i class="icon"></i></a>
							<a href="#"><i class="icon1"></i></a>
							{{-- <a href="#"><i class="icon2"></i></a>
							<a href="#"><i class="icon3"></i></a> --}}
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 single-grid1">
				<h2 class="text-center pad-b-10" style="color: #1565C0;">Popular <br> Products</h2>
				@forelse($popular_products as $key => $product)
					<div class="recent-grids">
						<div class="recent-left">
							<a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}"><img class="img-responsive " src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : '' }}" alt=""></a>	
						</div>
						<div class="recent-right">
							<h6 class="best2"><a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">{{ str_limit($product->product_name, 17) }} </a></h6>
							<div class="block">
								<div class="starbox small ghosting"> </div>
							</div>
							<span class=" price-in1"> Rs. {{ $product->price }}</span>
						</div>	
						<div class="clearfix"> </div>
					</div>
				@empty

				@endforelse
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="product-agile pad-20">
            <div class="container">
                <h3 class="tittle1">You may also like</h3>
                <div class="arrivals-grids">
                    @forelse($similar_products as $key => $product)
                        <div class="col-md-3 col-sm-6 arrival-grid simpleCart_shelfItem">
                            <div class="grid-arr">
                                <div  class="grid-arrival">
                                    <figure>        
                                        <a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
                                            <div class="grid-img">
                                                <img  src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : '' }}" class="img-responsive" alt="">
                                            </div>
                                            <div class="grid-img">
                                                <img  src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : '' }}" class="img-responsive"  alt="">
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
                    @empty

                    @endforelse
                    <div class="clearfix"></div>
                </div>
                {{-- @if(count($similar_products) == 4)
                    <div class="pull-right pad-10">
                        <a href="{{ route('recent') }}"><i class="fa fa-chevron-circle-right pad-r-5"></i>view more</a>
                    </div>
                @endif --}}
            </div>
        </div>
	</div>
@endsection
{{-- cursorcolor:'255,255,255',
    opacity:0.5,
    cursor:'crosshair',
    zindex:2147483647,
    zoomviewsize:[480,395],
    zoomviewposition:'right',
    zoomviewmargin:10,
    zoomviewborder:'none',
    magnification:1.925 --}}
@section('javascript')
	<script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('js/temp-main.js') }}"></script>
	<script src="{{ asset('js/imagezoom.js') }}"></script>
	<!-- FlexSlider -->
	<script defer src="{{ asset('js/jquery.flexslider.js') }}"></script>
	<script>
		// Can also be used with $(document).ready()
		$(window).load(function() {
		  $('.flexslider').flexslider({
			animation: "slide",
			controlNav: "thumbnails"
		  });
		});
	</script>
@endsection