@extends('admin.dashboard-layout')

@section('stylesheet')
@parent
	<style>
		.font-awesome-unique{
		  font-family: FontAwesome, sans-serif;
		}
	</style>
@endsection

@section('content')
	<div class="pad-20">
		<div class="box box-solid">
	        <div class="box-header with-border">
	          <i class="fa fa-list"></i>

	          <h3 class="box-title">Categories</h3>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	          @if(count($categories)>0)
				<ul class="list-unstyled">
					@foreach($categories['root'] as $main_menu)
						<li>
							<h3>
								{{ $main_menu->category }} 
								<button type="button" class="btn ink-reaction btn-raised btn-xs {{ $main_menu->is_active == 1 ? 'btn-primary' : 'btn-danger' }}">{{ $main_menu->is_active == 1 ? 'Active' : 'In-active' }}
								</button>
								<button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
									data-target="#newEditCategoryModal" 
									data-route="{{ route('admin.categories.update', $main_menu->id) }}"
									data-active="{{ $main_menu->is_active }}" 
									data-category="{{ $main_menu->category }}" 
									data-position="{{ $main_menu->display_position }}" 
									data-icon="{{ $main_menu->category_icon }}" 
									data-image="{{ getSmallThumbnail(asset($main_menu->category_image)) }}">
									<i class="fa fa-edit"></i>
								</button>

								<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#newAddCategoriesModal" data-parent="{{ $main_menu->id }}" data-active="{{ $main_menu->is_active }}">
									<i class="fa fa-plus"></i>
								</button>
								@if(count($main_menu->childCategories) <= 0)
									{!! getDeleteForm(route('admin.categories.destroy', $main_menu->id), 'Delete category?',
										'Are you sure you want to delete '. strtolower($main_menu->category) .' category ?',
										'btn ink-reaction btn-floating-action btn-xs btn-danger', 'fa fa-trash text-default-bright') !!}
								@endif
							</h3>
							@if(isset($categories[$main_menu->id]))
							<ul>
								@foreach($categories[$main_menu->id] as $category)
									<li>
										<h3>
											{{ $category->category }}
											<button type="button" class="btn ink-reaction btn-raised btn-xs {{ $category->is_active == 1 ? 'btn-primary' : 'btn-danger' }}">{{ $category->is_active == 1 ? 'Active' : 'In-active' }}
											</button>
											<button type="button" class="btn btn-xs btn-primary" 
												data-toggle="modal" 
												data-target="#newEditCategoryModal" 
												data-route="{{ route('admin.categories.update', $category->id) }}" 
												data-active="{{ $category->is_active }}" 
												data-category="{{ $category->category }}"
												data-position="{{ $category->display_position }}" 
												data-icon="{{ $category->category_icon }}" 
												data-image="{{ getSmallThumbnail(asset($category->category_image)) }}">
												<i class="fa fa-edit"></i>
											</button>
											<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#newAddCategoriesModal" data-parent="{{ $category->id }}" data-active="{{ $category->is_active }}">
												<i class="fa fa-plus"></i>
											</button>

											@if(count($category->childCategories) <= 0)
												{!! getDeleteForm(route('admin.categories.destroy', $category->id), 'Delete category?',
													'Are you sure you want to delete '. strtolower($category->category) .' category ?',
													'btn ink-reaction btn-floating-action btn-xs btn-danger', 'fa fa-trash text-default-bright') !!}
											@endif
										</h3>
										@if(isset($categories[$category->id]))
										<ul>
											@foreach($categories[$category->id] as $sub_menu)
												<li>
													<h3>
														{{ $sub_menu->category }}
														<button type="button" class="btn ink-reaction btn-raised btn-xs {{ $sub_menu->is_active == 1 ? 'btn-primary' : 'btn-danger' }}">{{ $sub_menu->is_active == 1 ? 'Active' : 'In-active' }}
														</button>
														<button type="button" class="btn btn-xs btn-primary"
														 data-toggle="modal" 
														 data-target="#newEditCategoryModal" 
														 data-route="{{ route('admin.categories.update', $sub_menu->id) }}" 
														 data-active="{{ $sub_menu->is_active }}" 
														 data-category="{{ $sub_menu->category }}"
														 data-position="{{ $sub_menu->display_position }}" 
														 data-icon="{{ $sub_menu->category_icon }}" 
														 data-image="{{ getSmallThumbnail(asset($sub_menu->category_image)) }}">
															<i class="fa fa-edit"></i>
														</button>

														@if(count($sub_menu->childCategories) <= 0)
															{!! getDeleteForm(route('admin.categories.destroy', $sub_menu->id), 'Delete category?',
																'Are you sure you want to delete '. strtolower($sub_menu->category) .' category ?',
																'btn ink-reaction btn-floating-action btn-xs btn-danger', 'fa fa-trash text-default-bright') !!}
														@endif
													</h3>
												</li>
												@endforeach
											</ul>
										@endif
									</li>
								@endforeach
							</ul>
							@endif
						</li>

					@endforeach
				</ul>
	          @endif

	          <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#newAddCategoriesModal">
	          	Add New menu<i class="fa fa-plus pad-l-5"></i>
	          </button>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>


	<div class="modal fade" id="newEditCategoryModal" tabindex="-1" role="dialog" aria-labelledby="newEditCategoryModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    <form method="POST" enctype="multipart/form-data">
	    	{{ csrf_field() }}
	    	{{ method_field('PATCH') }}
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="newEditCategoryModalLabel">Update category</h4>
	      </div>
	      <div class="modal-body">
	          <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
	            <label for="category_update" class="control-label">Category name</label>
	                <input type="text" name="category" class="form-control" id="category_update">

	                @if ($errors->has('category'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('category') }}</strong>
	                    </span>
	                @endif
	          </div>
	          <div class="form-group{{ $errors->has('display_position') ? ' has-error' : '' }}">
	            <label for="display_position_update" class="control-label">Display position
					<i>(Max value will be on top)</i>
	            </label>
	                <input type="text" name="display_position" class="form-control" id="display_position_update">

	                @if ($errors->has('display_position'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('display_position') }}</strong>
	                    </span>
	                @endif
	          </div>
	      		{{-- <div class="form-group{{ $errors->has('category_icon') ? ' has-error' : '' }}">
	      			<label for="category_icon">Service Icon</label>
	      			<select name="category_icon" id="category_icon_update" required="required" class="font-awesome-unique form-control">
	      				<option value="">Select icon</option>
	      				@foreach(font_awesome_icons() as $index => $icon)
	      					<option value="{{ $index }}">{{'&#x'.$icon.';'}} {{ $index }}</option>
	      				@endforeach
	      			</select>
	      			@if($errors->has('category_icon'))
	      				<span class="help-block">
	                        <strong>{{ $errors->first('category_icon') }}</strong>
	                      </span>
	                  @endif
	      		</div> --}}
    			<div class="form-group{{ $errors->has('category_image') ? ' has-error' : '' }}">
    				<label for="category_image">Category Image</label>
    				<input type="file" class="form-control" id="category_image" name="category_image">
    				@if($errors->has('category_image'))
						<span class="help-block">
							<strong>{{ $errors->first('category_image') }}</strong>
						</span>
    				@endif
    				<img src="" alt="No prevoius image" id="previous-image">
    			</div>
	          <div class="form-group">
	          	<input type="radio" name="is_active" value="1" id="active_update"><label for="active_update">Active</label>
	          	<input type="radio" name="is_active" value="0" id="inActive_update"><label for="inActive_update">In Active</label>
	          </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

	{{-- <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    <form method="POST">
	    	{{ csrf_field() }}
	    	{{ method_field('PATCH') }}
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="editCategoryModalLabel">New message</h4>
	      </div>
	      <div class="modal-body">
	          <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
	            <label for="category_update" class="control-label">Category name</label>
	                <input type="text" name="category" class="form-control" id="category_update">

	                @if ($errors->has('category'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('category') }}</strong>
	                    </span>
	                @endif
	          </div>
	          <div class="form-group">
	          	<input type="radio" name="is_active" value="1" id="active_update"><label for="active_update">Active</label>
	          	<input type="radio" name="is_active" value="0" id="inActive_update"><label for="inActive_update">In Active</label>
	          </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div> --}}

	<div class="modal fade" id="newAddCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="newAddCategoriesModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
	    	{{ csrf_field() }}
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="newAddCategoriesModalLabel">New message</h4>
	      </div>
	      <div class="modal-body">
	          <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
	            <label for="category" class="control-label">Category name</label>
	                <input type="text" name="category" class="form-control" id="category">

	                @if ($errors->has('category'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('category') }}</strong>
	                    </span>
	                @endif
	          </div>
	          <div class="form-group{{ $errors->has('display_position') ? ' has-error' : '' }}">
	            <label for="display_position" class="control-label">Display Positiin 
	            	<i>(Max value will be on top)</i>
	            </label>
	                <input type="number" name="display_position" class="form-control" id="display_position">

	                @if ($errors->has('display_position'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('display_position') }}</strong>
	                    </span>
	                @endif
	          </div>
	      		{{-- <div class="form-group{{ $errors->has('category_icon') ? ' has-error' : '' }}">
	      			<label for="category_icon">Service Icon</label>
	      			<select name="category_icon" id="category_icon" required="required" class="font-awesome-unique form-control">
	      				<option value="">Select icon</option>
	      				@foreach(font_awesome_icons() as $index => $icon)
	      					<option value="{{ $index }}">{{'&#x'.$icon.';'}} {{ $index }}</option>
	      				@endforeach
	      			</select>
	      			@if($errors->has('category_icon'))
	      				<span class="help-block">
	                        <strong>{{ $errors->first('category_icon') }}</strong>
	                      </span>
	                  @endif
	      		</div> --}}
      			<div class="form-group{{ $errors->has('category_image') ? ' has-error' : '' }}">
      				<label for="category_image">Category Image</label>
      				<input type="file" class="form-control" id="category_image" name="category_image">
      				@if($errors->has('category_image'))
						<span class="help-block">
							<strong>{{ $errors->first('category_image') }}</strong>
						</span>
      				@endif
      			</div>
      			<input type="hidden" name="parent_id" id="parent_id">
	          <div class="form-group">
	          	<input type="radio" name="is_active" value="1" id="active"><label for="active">Active</label>
	          	<input type="radio" name="is_active" value="0" id="inActive"><label for="inActive">In Active</label>
	          </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary">Add</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

	{{-- <div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="addCategoriesModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    <form method="POST" action="{{ route('admin.categories.store') }}">
	    	{{ csrf_field() }}
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="addCategoriesModalLabel">New message</h4>
	      </div>
	      <div class="modal-body">
	          <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
	            <label for="category" class="control-label">Category name</label>
	                <input type="text" name="category" class="form-control" id="category">

	                @if ($errors->has('category'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('category') }}</strong>
	                    </span>
	                @endif
	          </div>
	          <input type="hidden" name="parent_id" id="parent_id">
	          <div class="form-group">
	          	<input type="radio" name="is_active" value="1" id="active"><label for="active">Active</label>
	          	<input type="radio" name="is_active" value="0" id="inActive"><label for="inActive">In Active</label>
	          </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary">Add</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div> --}}

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
		$('#newEditCategoryModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 
		  var category = button.data('category') 
		  var is_active = button.data('active')
		  var route = button.data('route')
		  var position = button.data('position')
		  var icon = button.data('icon')
		  var image = button.data('image')
		  var modal = $(this)
		  modal.find('.modal-content form').attr('action', route)
		  modal.find('.modal-body input#category_update').val(category)
		  modal.find('.modal-body input#display_position_update').val(position)
		  modal.find('.modal-body #category_icon_update').val(icon)
		  modal.find('.modal-body #previous-image').attr('src', image)
		  if(is_active == 1){

		  	modal.find('.modal-body input#active_update').attr('checked', true)
		  }else{
		  	modal.find('.modal-body input#inActive_update').attr('checked', true)

		  }
		});

		// $('#editCategoryModal').on('show.bs.modal', function (event) {
		//   var button = $(event.relatedTarget) // Button that triggered the modal
		//   var category = button.data('category') 
		//   var is_active = button.data('active')
		//   var route = button.data('route')// Extract info from data-* attributes
		//   // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		//   // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		//   var modal = $(this)
		//   modal.find('.modal-content form').attr('action', route)
		//   modal.find('.modal-body input#category_update').val(category)
		//   if(is_active == 1){

		//   	modal.find('.modal-body input#active_update').attr('checked', true)
		//   }else{
		//   	modal.find('.modal-body input#inActive_update').attr('checked', true)

		//   }
		// });

		// $('#addCategoriesModal').on('show.bs.modal', function (event) {
		//   var button = $(event.relatedTarget)
		//   var is_active = button.data('active')
		//   var parent_id = button.data('parent')
		//   var modal = $(this)
		  
		//   if(parent_id){
		//   	modal.find('.modal-body input#parent_id').val(parent_id)

		//   	if(is_active == 1){

		//   		modal.find('.modal-body input#active').attr('checked', true)
		//   	}else{
		//   		modal.find('.modal-body input#inActive').attr('checked', true)

		//   	}
		//   }
		// })

		$('#newAddCategoriesModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget)
		  var is_active = button.data('active')
		  var parent_id = button.data('parent')
		  var modal = $(this)
		  console.log('wehqfvywqe')
		  
		  if(parent_id){
		  	modal.find('.modal-body input#parent_id').val(parent_id)

		  }
		  	if(is_active == 1){

		  		modal.find('.modal-body input#active').attr('checked', true)
		  	}else{
		  		modal.find('.modal-body input#inActive').attr('checked', true)

		  	}
		});

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
		});
	</script>
@endsection