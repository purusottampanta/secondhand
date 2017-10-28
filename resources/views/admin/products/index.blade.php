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
		<h2>Products</h2>
		@forelse($products as $key => $product)
			<div class="row mar-5">
				<div class="media pad-10 bg-info">
					<div class="media-left">
					    <a href="{{ route('admin.products.show', $product->product_slug) }}">
					      <img class="media-object" src="{{ $product->images->first()->smallThumbnail() }}" alt="{{ $product->product_name }}" height="50%" class="img-responsive">
					    </a>
					</div>
					<div class="media-body">
					    <div class="col-md-10">
					    	<a href="{{ route('admin.products.show', $product->product_slug) }}">
						    	<div class="col-md-3">
						    		<h4 class="media-heading">{{ $product->product_name }}</h4>
						    	</div>
							    <div class="col-md-3">
							    	<span><i class="fa fa-eye pad-r-5"></i>{{ $product->views }}</span>
							    	<span class="pad-l-5"><i class="pad-r-5">Rs.</i>{{ $product->price }}</span>
							    </div>
								<div class="col-md-2">
							    	<p>{{ ucfirst(implode(' ', explode('_', $product->condition))) }}</p>
							    </div>
							    <div class="col-md-4">
							    	<span>{{ ucfirst(implode(' ', explode('_', $product->status))) }}</span>
							    	<span class="pull-right">{{ getCategories()[$product->category] }}</span>
							    </div>
						    </a>
					    </div>
					    <div class="col-md-2">
					    	<div class="pull-right">
						    	<a href="{{ route('admin.products.edit', $product->product_slug) }}" class="btn btn-xs" type="button" title="edit"><i class="fa fa-edit"></i></a>
						    	{!! getDeleteForm(route('admin.products.destroy', $product->id), 'Delete product?', 'Are you sure you want to delete this product', 'btn btn-flat ink-reaction text-warning', 'fa fa-archive') !!}
						    </div>
					    </div>
					</div>
				</div>
			</div>
		@empty

		@endforelse

		{{ $products->appends(['q' => $q, 'condition' => $condition, 'category' => $category, 'status' => $status, 'price' => $price, 'negotiable' => $negotiable, 'discount' => $discount, 'home_delivery' => $home_delivery, 'featured' => $featured, 'sort' => $sort])->links() }}
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