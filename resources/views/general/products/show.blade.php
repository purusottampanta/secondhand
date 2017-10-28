@extends('layouts.app')

@section('stylesheet')
@parent
	<style>
		table tr td{
			max-width: 50px !important;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-info">
				  	<div class="panel-heading">General details</div>
				  	<div class="panel-body">
				    	<div class="col-md-3">
				    		<table class="table table-responsive borderless">
					    		<tr>
					    			<td>
					    				Ad id:
					    			</td>
					    		</tr>
					    		<tr>
					    			<td>
					    				Ad views:
					    			</td>
					    		</tr>
					    		<tr>
					    			<td>
					    				Ad post date:
					    			</td>
					    		</tr>
					    		@if($product->expiresAt())
									<tr>
						    			<td>
						    				Ad expiry date:
						    			</td>
						    		</tr>
					    		@endif
					    	</table>
				    	</div>
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
				    	</div>
				  	</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-info">
				  	<div class="panel-heading">Pricing details</div>
				  	<div class="panel-body">
				    	<div class="col-md-3">
				    		<table class="table table-responsive borderless">
					    		<tr>
					    			<td>
					    				Price:
					    			</td>
					    		</tr>
					    		<tr>
					    			<td>
					    				Price negotiable:
					    			</td>
					    		</tr>
					    		<tr>
					    			<td>
					    				Condition:
					    			</td>
					    		</tr>
					    	</table>
				    	</div>
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
				    	</div>
				  	</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-info">
				  	<div class="panel-heading">Delivery details</div>
				  	<div class="panel-body">
				    	<div class="col-md-3">
				    		<table class="table table-responsive borderless">
					    		<tr>
					    			<td>
					    				Home delivery:
					    			</td>
					    		</tr>
					    		@if($product->home_delivery)
									<tr>
						    			<td>
						    				Price negotiable:
						    			</td>
						    		</tr>
					    		@endif
					    	</table>
				    	</div>
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
				    	</div>
				  	</div>
				</div>
			</div>
		</div>
	</div>
@endsection