@extends('admin.dashboard-layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="bg-white border-round">
					<h3 class="pad-10"><strong>{{ $product->product_name }}</strong></h3>
				</div>
				<span class="pull-right" style="position: absolute; top: 1.9em; right: 1.5em;">
					<span class="btn btn-xs btn-default" data-toggle="modal" data-target="#statusUpdateModal" data-keyboard="false" data-backdrop="static" title="delete">Update status</span>
					<a href="{{ route('admin.products.edit', $product->product_slug) }}" class="btn btn-success btn-xs" title="Edit this product">Edit<i class="fa fa-edit pad-l-10"></i></a>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-info">
						  	<div class="panel-heading">General details</div>
						  	<div class="panel-body">
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
						    		{{-- @if($product->expiresAt())
										<tr>
							    			<td>
							    				Ad expiry date:
							    			</td>
							    			<td>
							    				{{ $product->expiresAt()['date']->format('d-m-Y') }} (in {{ $product->expiresAt()['duration'] }} {{ str_plural('day', $product->expiresAt()['duration']) }})
							    			</td>
							    		</tr>
						    		@endif --}}
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

	<!-- Modal -->
	<div class="modal fade" id="statusUpdateModal" tabindex="-1" role="dialog" aria-labelledby="statusUpdateModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <form action="{{ route('admin.products.updateStatus', ['product' => $product->id, 'previous_status' => $previous_status, 'is_direct' => $is_direct]) }}" method="POST">
	      	{{ csrf_field() }}
	      	{{-- {{ method_field('PATCH') }} --}}
	      	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="statusUpdateModalLabel">Update Status</h4>
		      </div>
		      <div class="modal-body">
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('status') ? ' has-error' : '' }}">
		                <div class="col-md-offset-1 col-md-2">
		                	<label for="status" class="control-label">status</label>
		                </div>

		                <div class="col-md-6">
		                    <select name="status" id="status" class="form-control" required autofocus>
		                    	<option value="">Select status</option>
		                    	@foreach(getStatus() as $key=> $status)
									<option value="{{ $key }}" {{ $product->status ? ($product->status == $key ? 'selected' : ''): (old('status') == $key ? 'selected' :'') }}>{{ $status }}</option>
		                    	@endforeach
		                    </select>

		                    @if ($errors->has('status'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('status') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Update</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
@endsection
{{-- @section('javascript')

<script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/imagezoom.js') }}"></script>
	<script>
		$(document).ready(function(){
		    $('#zoom').imageZoom();
		  });
	</script>
  <!-- Morris.js charts -->
  <script src="{{ asset('lib/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('lib/morris.js/morris.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('lib/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('lib/jquery-knob/dist/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('lib/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('lib/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('lib/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

  <!-- Slimscroll -->
  <script src="{{ asset('lib/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('lib/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>

@endsection --}}