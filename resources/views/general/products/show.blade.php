@extends('layouts.app')

@section('meta-tag')
	    <meta property="og:title" content="{{ $product->product_name }} | {{ getCategories()[$product->category] }}, Buy Sell used second hand furniture " />
        <meta property="og:description" content="{{ $product->product_name }}, {{ getCategories()[$product->category] }}, You Sell We Buy You Buy We Sell, secondhand, furniture, office, home furniture, furniture price, online shopping, home shopping" />
        <meta property="og:image" content="{{ asset($product->images->first()->image_path) }}" />
        @if($product->meta_description)
			<?php 
				$meta_description =$product->meta_description;
			?>
        @else
			<?php 
				$meta_description =$product->product_name.", furniture stores, furniture price in nepal, ".getCategories()[$product->category].", secondhand shop, used furniture, office, home, furniture, buy and sell, chair, sofa, bed, bookcase, office desk, online shopping, home shopping, https://www.facebook.com/secondhandshop.ktm";
			?>
        @endif
        {{-- <meta name="description" content="{{ $product->product_name }}, furniture stores, furniture price in nepal, {{ getCategories()[$product->category] }}, secondhand shop, used furniture, office, home, furniture, buy and sell, chair, sofa, bed, bookcase, office desk, online shopping, home shopping, https://www.facebook.com/secondhandshop.ktm"> --}}
        <meta name="description" content="{{ $meta_description }}">

        @if($product->meta_key)
			<?php 
				$meta_key =$product->meta_key;
			?>
        @else
			<?php 
				$meta_key = "furniture stores, furniture price, ".$product->product_name.", used furniture, office, home, furniture, ".getCategories()[$product->category].", buy and sell, chair, sofa, bed, bookcase, office desk, online shopping, home shopping";
			?>
        @endif
        <meta name="keywords" content="{{ $meta_key }}">
@endsection

@section('title')
	@if($product->page_title)
		{{ $product->page_title }}
	@else
		{{ $product->product_name }}, {{ getCategories()[$product->category] }}, Buy Sell used second hand furniture, furniture price
	@endif
@endsection

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
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=194051244503766&autoLogAppEvents=1';
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		</div>
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
							<h6>Category : <small>{{ getCategories()[$product->category] }}</small></h6>
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
							@if($product->status == 'listed_for_sell')
								<a href="{{ route('general.products.addToCart', $product->id) }}" data-text="Add To Cart" class="my-cart-b item_add">Buy now</a>
							@elseif($product->status == 'booked')
								<p>Booked by someone else</p>
							@elseif($product->status == 'sold')
								<p>Product already sold</p>
							@endif
						</div>
						<div class="social-icon">
							<a href="https://www.facebook.com/secondhandshop.ktm/" target="_blank"><i class="icon"></i></a>
							<a href="#"><i class="icon1"></i></a>
							{{-- <a href="#"><i class="icon2"></i></a>
							<a href="#"><i class="icon3"></i></a> --}}
							<br>
							<div class="fb-share-button" data-href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 single-grid1">
				<h2 class="text-center pad-b-10" style="color: #1565C0;">Popular <br> Products</h2>
				@forelse($popular_products as $key => $popular_product)
					<div class="recent-grids pad-b-10" style="background-color: white;">
						<div class="recent-left">
							<a href="{{ route('general.products.show', ['category' => $popular_product->category, 'slug'=> $popular_product->product_slug]) }}"><img class="img-responsive " src="{{ $popular_product->images->first() ? $popular_product->images->first()->smallThumbnail() : '' }}" alt=""></a>	
						</div>
						<div class="recent-right">
							<h6 class="best2"><a href="{{ route('general.products.show', ['category' => $popular_product->category, 'slug'=> $popular_product->product_slug]) }}">{{ str_limit($popular_product->product_name, 17) }} </a></h6>
							<div class="block">
								<div class="starbox small ghosting"> </div>
							</div>
							<span class=" price-in1"> Rs. {{ $popular_product->price }}</span>
						</div>	
						<div class="clearfix"> </div>
					</div>
				@empty

				@endforelse
			</div>
			<div class="clearfix"> </div>
		</div>

		<div class="response">
			  	<div class="media response-info">
			  		<h4>Post Your Review</h4>
			  			<div class="media-left response-text-left">
								<a href="#">
									@if(authUser())
										<img src="{{ authUser()->profilePicture() }}" alt="{{ authUser()->full_name }}" height="70" width="70">
									@endif
								</a>
								{{-- <h5><a href="#">Username</a></h5> --}}
							</div>
							<div class="media-body response-text-right">
								@if(!auth()->check())
									<div class="reviewRule" hidden style="background-color: #e3e3e3; font-size: 16px">
										<span class="text-lg">You need to login to post review. <a href="{{ route('login') }}">Click here</a> to login</span>
									</div>
								@endif
					  		<div id="{{ authUser() ? '': 'reviewFormDiv' }}">
					  			@include('general.comments.form')
					  		</div>
					  	</div>
			  	</div>

			  	@if(isset($comments['root']))
						@include('general.comments.commentlist', ['commentsCollection' => $comments['root']])
			  	@endif
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

		$(document).ready(function(){
		    $('.reviewReply').on('click', function(e){
		    	e.preventDefault();
		    	// $('.replyBox').hide();
		    	$(this).parent('ul').find('.replyBox').toggle( "slow" );
		    });

		    $('.reviewTextarea').on('focus',function(e){
		    	e.preventDefault();
		    	// alert('hye');
		    	$('.reviewRule').show( "slow" );
		    	$(this).prop('disabled', true);

		    });

		    $('.reviewTextarea').on('focusout', function(e){
	    		e.preventDefault();
	    		$(this).prop('disabled', false);
	    	});

		});	

	</script>
@endsection