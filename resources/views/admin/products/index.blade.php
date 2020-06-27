@extends('admin.dashboard-layout')

@section('stylesheet')
@parent
	<style>
		.image-hover{
			background-color: rgba(255,255,255,0.5);
			/*opacity: 0.5;*/
			width: 90%; 
			position: absolute; 
			top: 10%; 
			bottom: 20%;
			-webkit-transition: all 1s ease-in-out 1s;
			-moz-transition: all 1s ease-in-out 1s;
			-o-transition: all 1s ease-in-out 1s;
			transition: all 1s ease-in-out 1s;
			display: none;
		}
		.image-container:hover .image-hover{
			display: block;
			-webkit-transition: all 1s ease-in-out 1s;
			-moz-transition: all 1s ease-in-out 1s;
			-o-transition: all 1s ease-in-out 1s;
			transition: all 1s ease-in-out 1s;
		}
	</style>
@endsection

@section('content')
	<div class="col-md-12">
		<h2>Products 
			<a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-info" title="Add new product">
				<i class="fa fa-plus"></i>
			</a>
			<br>
			
		</h2>

		@if(!$is_direct)
			<div class="row mar-5">
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="dropdown">
						<button id="dLabel1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-filter pad-5"></i>Condition: 
							@if($condition)
								@if(array_key_exists($condition, getProductsCondition()))
									{{ getProductsCondition()[$condition] }}
								@endif
							@else
								All
							@endif
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dLabel1">
							<li>
								<a href="{{ route('admin.products.index', ['category' => $category, 'status' => $status]) }}">All</a>
							</li>
							<li class="{{ $condition == 'like_new' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => 'like_new', 'category' => $category, 'status' => $status]) }}">Like new</a>
							</li>
							<li class="{{ $condition == 'excellent' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => 'excellent', 'category' => $category, 'status' => $status]) }}">Excellent</a>
							</li>
							<li class="{{ $condition == 'good' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => 'good', 'category' => $category, 'status' => $status]) }}">Good</a>
							</li>
							<li class="{{ $condition == 'fair' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => 'fair', 'category' => $category, 'status' => $status]) }}">Fair</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="dropdown">
						<button id="dLabel2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-filter pad-5"></i>Category: 
							@if($category)
								@if(array_key_exists($category, getCategories()))
									{{ getCategories()[$category] }}
								@endif
							@else
								All
							@endif
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dLabel2">
							<li>
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'status' => $status]) }}">All</a>
							</li>
							<li class="{{ $category == 'home_furniture' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => 'home_furniture', 'status' => $status]) }}">Home Furniture</a>
							</li>
							<li class="{{ $category == 'office_furniture' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => 'office_furniture', 'status' => $status]) }}">Office Furniture</a>
							</li>
							<li class="{{ $category == 'electronics' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => 'electronics', 'status' => $status]) }}">Electronics</a>
							</li>
							<li class="{{ $category == 'others' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => 'others', 'status' => $status]) }}">Others</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="dropdown">
						<button id="dLabel3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-filter pad-5"></i>Status: 
							@if($status)
								@if(array_key_exists($status, getStatus()))
									{{ getStatus()[$status] }}
								@endif
							@else
								All
							@endif
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dLabel3">
							<li>
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => $category]) }}">All</a>
							</li>
							<li class="{{ $status == 'listed_for_sell' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => $category, 'status' => 'listed_for_sell']) }}">Listed for sell</a>
							</li>
							{{-- <li class="{{ $status == 'booked' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => $category, 'status' => 'booked']) }}">Booked</a>
							</li> --}}
							<li class="{{ $status == 'sold' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => $category, 'status' => 'sold']) }}">Sold</a>
							</li>
							{{-- <li class="{{ $status == 'bought' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => $category, 'status' => 'bought']) }}">Bought by admin</a>
							</li>
							<li class="{{ $status == 'sell_request' ? 'bg-info' : '' }}">
								<a href="{{ route('admin.products.index', ['condition' => $condition, 'category' => $category, 'status' => 'sell_request']) }}">Request to sell</a>
							</li> --}}
						</ul>
					</div>
				</div>
			</div>
		@endif
		<div class="row">
			<span class="mar-5 pad-10">
				Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of total {{ $products->total() }} results
			</span>
		</div>
		<div class="row mar-5 hidden-xs">
			<div class="media pad-10 bg-info">
				<div class="media-left">
					<span>Image</span>
				</div>
				<div class="media-body">
					<div class="col-md-10">
						<div class="col-md-3">
							<span class="pad-l-20 mar-l-20">Product Name</span>
						</div>
						<div class="col-md-3">
							<span class="pad-l-20 mar-l-20">Views</span>
							<span class="pull-right">Price</span>
						</div>
						<div class="col-md-2">
							<span class="pad-l-20 mar-l-20">Condition</span>
						</div>
						<div class="col-md-4">
							<span class="pad-l-20 mar-l-20">Status</span>
							<span class="pull-right">Category</span>
						</div>
					</div>
					<div class="col-md-2">
						<span class="pull-right">Operations</span>
					</div>
				</div>
			</div>
		</div>
		@forelse($products as $key => $product)
			<div class="row mar-5">
				<div class="media pad-10 {{ getStatusColor($product->status) }}">
					<div class="media-left">
					    <a href="{{ route('admin.products.show', ['product' => $product->product_slug, 'status' => $status, 'is_direct' => $is_direct]) }}">
					      <img class="media-object" src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : asset('img/sliders/slide4.jpg') }}" alt="{{ $product->product_name }}" height="50%" class="img-responsive">
					    </a>
					</div>
					<div class="media-body">
					    <div class="col-md-10">
					    	<a href="{{ route('admin.products.show', ['product' => $product->product_slug, 'status' => $status, 'is_direct' => $is_direct]) }}" style="{{ getStatusColor($product->status) == 'bg-primary' ? 'color:#000000' : '' }}" class="hidden-xs">
						    	<div class="col-md-3">
						    		<h4 class="media-heading">{{ $product->product_name }}</h4>
						    	</div>
							    <div class="col-md-3">
							    	<span><i class="fa fa-eye pad-r-5"></i>{{ $product->views }}</span>
							    	<span class="pull-right"><i class="pad-r-5">Rs.</i>{{ $product->price }}</span>
							    </div>
								<div class="col-md-2">
							    	<p>{{ ucfirst(implode(' ', explode('_', $product->condition))) }}</p>
							    </div>
							    <div class="col-md-4">
							    	<span class="{{ $product->status == 'sold' ? 'text-danger' :'' }}">{{ getStatus()[$product->status] }}</span>
							    	<span class="pull-right">{{ $product->categories? $product->categories->category : 'N/A' }}</span>
							    </div>
						    </a>
						    <div class="hidden-md hidden-sm hidden-lg">
						    	<a href="{{ route('admin.products.show', ['product' => $product->product_slug, 'status' => $status, 'is_direct' => $is_direct]) }}" class="text-lg">{{ $product->product_name }}</a>
						    	<br>
						    	<small>
						    		<strong>Category: </strong>
						    		<span class="pad-l-10">{{ $product->categories? $product->categories->category : 'N/A' }}</span>
						    	</small>
								<br>
						    	<small>
						    		<strong>Date: </strong>
						    		<span class="pad-l-10">{{ $product->created_at->format('d-m-y') }}</span>
						    	</small>
						    	<small>
						    		<span class="pull-right"><strong> <span class="pad-r-10">Price:</span></strong><i class="pad-r-5">Rs.</i>{{ $product->price }}</span>
						    	</small>
								<div class="row pad-l-10">
									{{-- <small>
										<a href="{{ route('admin.products.edit', $product->product_slug) }}"><u>Edit Ad</u>
										</a>
									</small> --}}
									<small class="{{ $product->status == 'sold' ? 'text-danger' :'text-info' }} pad-l-5">
										<u>{{ getStatus()[$product->status] }}</u>
									</small>
									<small class="text-info pad-l-5">
										<u>{{ ucfirst(implode(' ', explode('_', $product->condition))) }}</u>
									</small>
									<span class="text-info pad-l-5">
										<i class="fa fa-eye pad-r-5"></i>
										{{ $product->views }}
									</span>
									<a href="{{ route('admin.products.edit', $product->product_slug) }}" class="btn btn-xs" type="button" title="edit">
										<i class="fa fa-edit"></i>
									</a>
						    	{!! getDeleteForm(route('admin.products.destroy', $product->id), 'Delete product?', 'Are you sure you want to delete this product', 'btn btn-flat ink-reaction text-warning', 'fa fa-archive') !!}
									@if($product->status == 'listed_for_sell')
										<form action="{{ route('admin.products.updateStatus', ['product' => $product->id, 'previous_status' => $status, 'is_direct' => $is_direct]) }}" method="POST">
											{{ csrf_field() }}
											<input type="hidden" name="status" value="sold">
											<input type="submit" class="btn btn-xs text-success" value="mark sold">
										</form>
						    		@endif
								</div>
						    </div>
					    </div>
					    <div class="col-md-2 hidden-xs">
					    	<div class="pull-right">
					    		@if($product->status == 'listed_for_sell')
									<form action="{{ route('admin.products.updateStatus', ['product' => $product->id, 'previous_status' => $status, 'is_direct' => $is_direct]) }}" method="POST">
										{{ csrf_field() }}
										<input type="hidden" name="status" value="sold">
										<input type="submit" class="btn btn-xs text-success" value="mark sold">
									</form>
					    		@endif
						    	<a href="{{ route('admin.products.edit', $product->product_slug) }}" 
						    		class="btn btn-xs {{ $product->status == 'booked' ? 'text-black' : '' }}" 
						    		type="button" title="edit" >
						    		<i class="fa fa-edit"></i>
						    	</a>
						    	{!! getDeleteForm(route('admin.products.destroy', $product->id), 'Delete product?', 'Are you sure you want to delete this product', 'btn btn-flat ink-reaction text-warning '. ($product->status == 'booked' ? 'text-black' : ''), 'fa fa-archive') !!}
						    </div>
					    </div>
					</div>
				</div>
			</div>
		@empty

		@endforelse

		{{ $products->appends([
			'q' 			=> $q, 
			'condition' 	=> $condition, 
			'category' 		=> $category, 
			'status' 		=> $status, 
			'price' 		=> $price, 
			'negotiable' 	=> $negotiable, 
			'discount' 		=> $discount, 
			'home_delivery' => $home_delivery, 
			'featured' 		=> $featured, 
			'sort' 			=> $sort,
			'is_direct' 	=> $is_direct
			])->links() 
		}}
        {{-- {{ $products->appends(request()->query())->links() }} --}}
	</div>

	{{-- modal for confirming --}}
  <div class="modal fade-scale" id="ConfirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
        <div class="text-center">
          <h1 class="text-xxxxl text-warning"> <i class="fa fa-exclamation-circle"></i></h1>
          <h3 class="text-xxxl text-default-dark"></h3>
          <p class="text-default-light "></p>
        </div>
          <form>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="text-center">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Yes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
@parent
  <script>
    $('#ConfirmDeleteModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      // var recipient = button.data('to') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      
      // $('body').css('opacity', '0.5');

      var title = button.data('title');
      var route = button.data('route');
      var text  = button.data('text');
      var modal = $(this);

      modal.find('.modal-body h3').text( title );
      modal.find('.modal-body p').text( text );
      modal.find('.modal-body form').attr({
        "action" : route,
        "method" : "post",
        "class"  : "delete-form"
      });
    })
  </script>


@endsection