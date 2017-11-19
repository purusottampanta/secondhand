@extends('users.user-dashboard-layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="bg-white border-round">
					<h3 class="pad-10"><strong>{{ $product->product_name }}</strong></h3>
				</div>
				@if($product->status == 'sell_request')
					<span class="pull-right" style="position: absolute; top: 1.9em; right: 1.5em;">
						<a href="{{ route('users.products.edit', $product->product_slug) }}" class="btn btn-success btn-xs" title="Edit this product">Edit<i class="fa fa-edit pad-l-10"></i></a>
					</span>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				@if($product->status == 'sell_request')
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-info">
							  	<div class="panel-heading">General details</div>
							  	<div class="panel-body">
						    		<table class="table table-responsive borderless">
							    		<tr>
							    			<td>
							    				Ad post date:
							    			</td>
							    			<td>
							    				{{ $product->created_at->format('d-m-Y') }}
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>
							    				Status: 
							    			</td>
							    			<td>
							    				{{ getStatus()[$product->status] }}
							    			</td>
							    		</tr>
							    	</table>
							  	</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-info">
							  	<div class="panel-heading">Pricing details</div>
							  	<div class="panel-body">
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
							  	</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-info">
							  	<div class="panel-heading">Delivery details</div>
							  	<div class="panel-body">
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
							  	</div>
							</div>
						</div>
					</div>
				@endif
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-info">
						  	<div class="panel-heading">Description</div>
						  	<div class="panel-body">
						    	{{ $product->description }}
						  	</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="col-md-12 zoom-grid">
					<div class="flexslider">
						{{-- <ul class="slides"> --}}
							@foreach($product->images as $image)
								{{-- <li data-thumb="{{ $image->smallThumbnail() }}"> --}}
									<div class="thumb-image"> <img src="{{ asset($image->image_path) }}" data-imagezoom="true" data-magnification = "2" data-zoomviewposition="left" data-zoomviewmargin="200" data-opacity="0.4" class="img-responsive" alt=""  id="zoom" /> </div>
								{{-- </li> --}}
							@endforeach
						{{-- </ul> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
