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
			<div class="col-md-8">
				<div class="bg-white border-round">
					{{-- <div class="pull-left"> --}}
						<h3 class="pad-10"><strong>{{ $product->product_name }}</strong></h3>
					{{-- </div> --}}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-info">
						  	<div class="panel-heading">General details</div>
						  	<div class="panel-body">
						    	{{-- <div class="col-md-3"> --}}
						    		<table class="table table-responsive borderless">
							    		<tr>
							    			<td>
							    				Ad id:
							    			</td>
							    			<td>
							    				{{ $product->id }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				Ad views:
							    			</td>
							    			<td>
							    				{{ $product->views }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				Ad post date:
							    			</td>
							    			<td>
							    				{{ $product->created_at->format('d-m-Y') }}
							    			</td>
							    		</tr>
							    		@if($product->expiresAt())
											<tr>
								    			<td>
								    				Ad expiry date:
								    			</td>
								    			<td>
								    				{{ $product->expiresAt()['date']->format('d-m-Y') }} (in {{ $product->expiresAt()['duration'] }} {{ str_plural('day', $product->expiresAt()['duration']) }})
								    			</td>
								    		</tr>
							    		@endif
							    	</table>
						    	{{-- </div>
						    	<div class="col-md-6">
						    		<table class="table table-responsive borderless">
							    		<tr>
							    			<td>
							    				{{ $product->id }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				{{ $product->views }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				{{ $product->created_at->format('d-m-Y') }}
							    			</td>
							    		</tr>
							    		@if($product->expiresAt())
											<tr>
								    			<td>
								    				{{ $product->expiresAt()['date']->format('d-m-Y') }} (in {{ $product->expiresAt()['duration'] }} {{ str_plural('day', $product->expiresAt()['duration']) }})
								    			</td>
								    		</tr>
							    		@endif
							    	</table>
						    	</div> --}}
						  	</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-info">
						  	<div class="panel-heading">Pricing details</div>
						  	<div class="panel-body">
						    	{{-- <div class="col-md-3"> --}}
						    		<table class="table table-responsive borderless">
							    		<tr>
							    			<td>
							    				Price:
							    			</td>
							    			<td>
							    				Rs. {{ $product->price }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				Price negotiable:
							    			</td>
							    			<td>
							    				{{ $product->is_negotiable ? 'Yes' : 'No'  }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				Condition:
							    			</td>
							    			<td>
							    				{{ ucfirst(implode(' ', explode('_', $product->condition))) }}
							    			</td>
							    		</tr>
							    	</table>
						    	{{-- </div>
						    	<div class="col-md-6">
						    		<table class="table table-responsive borderless">
							    		<tr>
							    			<td>
							    				Rs. {{ $product->price }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				{{ $product->is_negotiable ? 'Yes' : 'No'  }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				{{ ucfirst(implode(' ', explode('_', $product->condition))) }}
							    			</td>
							    		</tr>
							    	</table>
						    	</div> --}}
						  	</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-info">
						  	<div class="panel-heading">Delivery details</div>
						  	<div class="panel-body">
						    	{{-- <div class="col-md-3"> --}}
						    		<table class="table table-responsive borderless">
							    		<tr>
							    			<td>
							    				Home delivery:
							    			</td>
							    			<td>
							    				{{ $product->home_delivery ? 'Yes' : 'No' }}
							    			</td>
							    		</tr>
							    		@if($product->home_delivery)
											<tr>
								    			<td>
								    				Delivery Price:
								    			</td>
								    			<td>
								    				Rs. {{ $product->delivery_charge }}
								    			</td>
								    		</tr>
							    		@endif
							    	</table>
						    	{{-- </div>
						    	<div class="col-md-6">
						    		<table class="table table-responsive borderless">
							    		<tr>
							    			<td>
							    				{{ $product->home_delivery ? 'Yes' : 'No' }}
							    			</td>
							    		</tr>
										@if($product->home_delivery)
											<tr>
								    			<td>
								    				Rs. {{ $product->delivery_charge }}
								    			</td>
								    		</tr>
							    		@endif
							    	</table>
						    	</div> --}}
						  	</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-info">
						  	<div class="panel-heading">Description</div>
						  	<div class="panel-body">
						    	{{-- <div class="col-md-12"> --}}
						    		{{ $product->description }}
						    	{{-- </div> --}}
						  	</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="col-md-12 zoom-grid">
					<div class="flexslider">
						<ul class="slides">
							@foreach($product->images as $image)
								<li data-thumb="{{ $image->smallThumbnail() }}">
									<div class="thumb-image"> <img src="{{ asset($image->image_path) }}" data-imagezoom="true" data-magnification = "2" data-zoomviewposition="left" data-zoomviewmargin="200" data-opacity="0.4" class="img-responsive" alt="" /> </div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
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