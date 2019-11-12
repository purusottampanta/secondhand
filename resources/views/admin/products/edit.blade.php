@extends('admin.dashboard-layout')

@section('content')
	<div class="row">
		<div class="col-md-12">
			
			<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
				{{-- {{ csrf_field() }} --}}
				{{-- {{ method_field('PATCH') }} --}}
				<div class="row pad-b-10">
					<div class="col-md-9" style="margin-right: 20px">
						<div class="col-md-offset-4">
							<h3>Edit product</h3>
						</div>
						<div class="pull-right">
							<a href="{{ url()->previous() }}">
								<button class="btn btn-danger text-uppercase" type="button">Cancel</button>
							</a>
							<input type="submit" class="btn btn-default text-uppercase" value="update">
						</div>
					</div>
				</div>
				<?php 
					if($product->images){
						$images = $product->imageArray();
					}
				?>
				<div class="row">
					<div class="col-sm-3 col-md-offset-3 form-group {{ ($errors->has('image.0') ? 'has-error' : '') }}">
                        <label for="image[0]" class="control-label">
                                Image 1/2
                                <span class="text-danger pad-l-10">*</span>
                            </label>
                        <input type='file' id="image[0]" name="image[0]" class="image" />
                        <img id="img1" src="#" alt="your image" height="150em" width="200em" hidden="hidden" class="viewImage" />
                        @if($product->images && array_key_exists(0, $images))
                            <img src="{{ $images[0] }}" alt="your image" height="150em" width="200em">
                        @endif
                        @if ($errors-> has('image.0'))
                        <span class="glyphicon glyphicon-warning-sign form-control-feedback">
                        </span>
                        <span class="help-block">
                            <strong>
                              {{ $errors-> first('image.0') }}
                            </strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-3 form-group {{ ($errors->has('image.1') ? 'has-error' : '') }}">
                        <label for="image[1]" class="control-label">
                                Image 2/2
                                <span class="text-danger pad-l-10">*</span>
                            </label>
                        <input type='file' id="image[1]" name="image[1]" class="image" />
                        <img id="img1" src="#" alt="your image" height="150em" width="200em" hidden="hidden" class="viewImage" />
                        @if($product->images && array_key_exists(1, $images))
                            <img src="{{ $images[1] }}" alt="your image" height="150em" width="200em">
                        @endif
                        @if ($errors-> has('image.1'))
                        <span class="glyphicon glyphicon-warning-sign form-control-feedback">
                        </span>
                        <span class="help-block">
                            <strong>
                              {{ $errors-> first('image.1') }}
                            </strong>
                        </span>
                        @endif
                    </div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
		                <div class="col-md-offset-1 col-md-2">
		                	<label for="product_name" class="control-label">Product name</label>
		                </div>

		                <div class="col-md-6">
		                    <input id="product_name" type="text" class="form-control" name="product_name" value="{{ $product->product_name ? $product->product_name :old('product_name') }}" required autofocus>

		                    @if ($errors->has('product_name'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('product_name') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('condition') ? ' has-error' : '' }}">
		                <div class="col-md-offset-1 col-md-2">
		                	<label for="condition" class="control-label">Condition</label>
		                </div>

		                <div class="col-md-6">
		                    <select name="condition" id="condition" class="form-control" required autofocus>
		                    	<option value="">Select condition</option>
		                    	<option value="like_new" {{ $product->condition ? ($product->condition == 'like_new' ? 'selected' : ''): (old('condition') == 'like_new' ? 'selected' :'') }}>Like New</option>
		                    	<option value="excellent" {{ $product->condition ? ($product->condition == 'excellent' ? 'selected' : ''): (old('condition') == 'excellent' ? 'selected' :'') }}>Excellent</option>
		                    	<option value="good" {{ $product->condition ? ($product->condition == 'good' ? 'selected' : ''): (old('condition') == 'good' ? 'selected' :'') }}>Good</option>
		                    	<option value="fair" {{ $product->condition ? ($product->condition == 'fair' ? 'selected' : ''): (old('condition') == 'fair' ? 'selected' :'') }}>Fair</option>
		                    </select>

		                    @if ($errors->has('condition'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('condition') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('category') ? ' has-error' : '' }}">
		                <div class="col-md-offset-1 col-md-2">
		                	<label for="category" class="control-label">Category</label>
		                </div>

		                <div class="col-md-6">
		                    <select name="category" id="category" class="form-control" required autofocus>
		                    	<option value="">Select Category</option>
		                    	@foreach(getCategories() as $key=> $category)
									<option value="{{ $key }}" {{ $product->category ? ($product->category == $key ? 'selected' : ''): (old('category') == $key ? 'selected' :'') }}>{{ $category }}</option>
		                    	@endforeach
		                    </select>

		                    @if ($errors->has('category'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('category') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('price') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="price" class="control-label">Price</label>
						</div>

						<div class="col-md-6">
							<input type="number" step="0.01" min="0.00" id="price" class="form-control" name="price" value="{{ $product->price? $product->price :old('price') }}" required autofocus>

							@if($errors->has('price'))
								<span class="help-block">
									<strong>{{ $errors->first('price') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="discount" class="control-label">Discount</label>
						</div>

						<div class="col-md-6">
							<input type="number" step="0.01" min="0.00" max="90.00" id="discount" class="form-control" name="discount" value="{{ $product->discount? $product->discount :old('discount') }}">

							@if($errors->has('discount'))
								<span class="help-block">
									<strong>{{ $errors->first('discount') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('is_negotiable') ? ' has-error' : '' }}">
						<div class="col-md-6 col-md-offset-3">
							<input type="checkbox" name="is_negotiable" id="is_negotiable" style="height: 20px; width: 20px" {{ $product->is_negotiable ? ($product->is_negotiable ? 'checked' : '') : (old('is_negotiable') == 1 ? 'checked' : '') }}>
							<label for="is_negotiable" class="control-label mar-l-10">Price negotiable ?</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('is_featured') ? ' has-error' : '' }}">
						<div class="col-md-6 col-md-offset-3">
							<input type="checkbox" name="is_featured" id="is_featured" style="height: 20px; width: 20px" {{ $product->is_featured ? ($product->is_featured ? 'checked' : '') : (old('is_featured') == 1 ? 'checked' : '') }}>
							<label for="is_featured" class="control-label mar-l-10">Featured product ?</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('home_delivery') ? ' has-error' : '' }}">
						<div class="col-md-6 col-md-offset-3">
							<input type="checkbox" name="home_delivery" id="home_delivery" style="height: 20px; width: 20px" {{ $product->home_delivery ? ($product->home_delivery ? 'checked' : '') : (old('home_delivery') == 1 ? 'checked' : '') }}>
							<label for="home_delivery" class="control-label mar-l-10">Home delivery available ?</label>
						</div>
					</div>
				</div>
				<div class="row charge_row" hidden>
					<div class="col-md-12 form-group{{ $errors->has('delivery_charge') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="delivery_charge" class="control-label">Delivery charge</label>
						</div>

						<div class="col-md-6">
							<input type="number" step="0.01" min="0.00" id="delivery_charge" class="form-control" name="delivery_charge" value="{{ $product->delivery_charge ? $product->delivery_charge :old('delivery_charge') }}">

							@if($errors->has('delivery_charge'))
								<span class="help-block">
									<strong>{{ $errors->first('delivery_charge') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				{{-- <div class="row">
					<div class="col-md-12 form-group{{ $errors->has('listing_duration') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="listing_duration" class="control-label">Listing duration</label>
						</div>

						<div class="col-md-6">
							<input type="number" step="1" max="90" min="1" id="listing_duration" class="form-control" name="listing_duration" value="{{ $product->listing_duration ? $product->listing_duration : old('listing_duration') }}" required autofocus>

							@if($errors->has('listing_duration'))
								<span class="help-block">
									<strong>{{ $errors->first('listing_duration') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div> --}}
				{{-- <div class="row">
					<div class="col-md-12 form-group{{ $errors->has('features') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="features" class="control-label">Features</label>
						</div>

						<div class="col-md-6">
							<input type="text" id="features" class="form-control" name="features" value="{{ $product->features ? $product->features : old('features') }}" required autofocus>

							@if($errors->has('features'))
								<span class="help-block">
									<strong>{{ $errors->first('features') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div> --}}
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('description') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="description" class="control-label">description</label>
						</div>

						<div class="col-md-6">
							<textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $product->description ? $product->description : old('description') }}</textarea>

							@if($errors->has('description'))
								<span class="help-block">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('page_title') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="page_title" class="control-label">Page Title</label>
						</div>

						<div class="col-md-6">
							<textarea name="page_title" id="page_title" cols="30" rows="3" class="form-control">{{ $product->page_title ? $product->page_title : old('page_title') }}</textarea>

							@if($errors->has('page_title'))
								<span class="help-block">
									<strong>{{ $errors->first('page_title') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('meta_key') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="meta_key" class="control-label">Meta Key</label>
						</div>

						<div class="col-md-6">
							<textarea name="meta_key" id="meta_key" cols="30" rows="3" class="form-control">{{ $product->meta_key ? $product->meta_key : old('meta_key') }}</textarea>

							@if($errors->has('meta_key'))
								<span class="help-block">
									<strong>{{ $errors->first('meta_key') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="meta_description" class="control-label">Meta Description</label>
						</div>

						<div class="col-md-6">
							<textarea name="meta_description" id="meta_description" cols="30" rows="6" class="form-control">{{ $product->meta_description ? $product->meta_description : old('meta_description') }}</textarea>

							@if($errors->has('meta_description'))
								<span class="help-block">
									<strong>{{ $errors->first('meta_description') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row pad-b-10">
					<div class="col-md-9" style="margin-right: 20px">
						<div class="pull-right">
							<a href="{{ url()->previous() }}">
								<button class="btn btn-danger text-uppercase" type="button">Cancel</button>
							</a>
							<input type="submit" class="btn btn-default text-uppercase" value="update">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('javascript')
@parent
	<script src="{{asset('js/sweetalert.min.js')}}"></script>
	<script>
		
      var images = [];
      var fileNames = [];
      var status = '{{ $product->status }}';
      function alertProductCreation() {
      	var para = document.createElement("p");
      	var node = document.createTextNode("Updating product ");
      	para.appendChild(node);
      	swal({
      		title: 'Please wait ...',
      		content: para,
      		buttons: false,
      		closeOnClickOutside: false,
      		closeOnEsc: false,
      	});
      }
		function resizeAndUpload(elementId) {
			var files = document.getElementById(elementId).files;
			console.log(files);
			var file = files[0];
			var reader = new FileReader();
		    reader.onloadend = function() {
		 
			    var tempImg = new Image();
			    tempImg.src = reader.result;
			    tempImg.onload = function() {
			 
			        var MAX_WIDTH = 800;
			        var MAX_HEIGHT = 600;
			        var tempW = tempImg.width;
			        var tempH = tempImg.height;
			        if (tempW > tempH) {
			            if (tempW > MAX_WIDTH) {
			               tempH *= MAX_WIDTH / tempW;
			               tempW = MAX_WIDTH;
			            }
			        } else {
			            if (tempH > MAX_HEIGHT) {
			               tempW *= MAX_HEIGHT / tempH;
			               tempH = MAX_HEIGHT;
			            }
			        }
			 
			        var canvas = document.createElement('canvas');
			        canvas.width = tempW;
			        canvas.height = tempH;
			        var ctx = canvas.getContext("2d");
			        ctx.drawImage(this, 0, 0, tempW, tempH);
			        var dataURL = canvas.toDataURL("image/jpeg");

			        var block = dataURL.split(";");
	               // Get the content type
	               var contentType = block[0].split(":")[1];// In this case "image/gif"
	               // get the real base64 content of the file
	               var realData = block[1].split(",")[1];// In this case "iVBORw0KGg...."

	               // Convert to blob
	               var blob = b64toBlob(realData, contentType);

	               if (elementId === 'image[0]') {
	               		images[0] = blob;
	               		fileNames[0] = file.name;
	               }else{
	                    images[1] = blob;
	                    fileNames[1] = file.name;
	               }
	               // images.push(blob);
	               // fileNames.push(file.name);

			    }
		 
		   }
		   reader.readAsDataURL(file);
		}

		function b64toBlob(b64Data, contentType, sliceSize) {
           contentType = contentType || '';
           sliceSize = sliceSize || 512;

           var byteCharacters = atob(b64Data);
           var byteArrays = [];

           for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
               var slice = byteCharacters.slice(offset, offset + sliceSize);

               var byteNumbers = new Array(slice.length);
               for (var i = 0; i < slice.length; i++) {
                   byteNumbers[i] = slice.charCodeAt(i);
               }

               var byteArray = new Uint8Array(byteNumbers);

               byteArrays.push(byteArray);
           }

         var blob = new Blob(byteArrays, {type: contentType});
         return blob;
       }


		function readURL(input, img) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    img.removeAttr('hidden');
                    img.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".image").change(function(e){
            var img = $(this).siblings('.viewImage');
            readURL(this, img);
            console.log(e.target.id);
            resizeAndUpload(e.target.id);
        });

        $('#editProductForm').submit(function (e){
        	e.preventDefault();
        	alertProductCreation();
        	// console.log(images);
        	// console.log(images.length);

        	// console.log($('#product_name').val());
        	// console.log($("#editProductForm").serialize());

           var fd = new FormData($("#editProductForm")[0]);
           fd.append('product_name', $('#product_name').val());
           fd.append('condition', $('#condition').val());
           fd.append('category', $('#category').val());
           fd.append('price', $('#price').val());
           fd.append('discount', $('#discount').val());

           if(document.getElementById("is_negotiable").checked){
               fd.append('is_negotiable', $('#is_negotiable').val());
           }

           if(document.getElementById("is_featured").checked){
               fd.append('is_featured', $('#is_featured').val());
           }

           if(document.getElementById("home_delivery").checked){
               fd.append('home_delivery', $('#home_delivery').val());
           }

           fd.append('delivery_charge', $('#delivery_charge').val());
           fd.append('description', $('#description').val());
           fd.append('page_title', $('#page_title').val());
           fd.append('meta_key', $('#meta_key').val());
           fd.append('meta_description', $('#meta_description').val());
           fd.append('status', status);

      //      if (images.length > 0) {
	     //       for(var i=0; i<images.length; i++){
	 				// fd.append("image["+ i +"]", images[i], fileNames[i]);
	     //       }
      //      }

      		if(images[0] && images[0] !== ""){
           		fd.append('image[0]', images[0], fileNames[0]);
           		console.log('0000');
      		}

      		if(images[1] && images[1] !== ""){
           		console.log('1111');
           		fd.append('image[1]', images[1], fileNames[1]);
      		}

           console.log(fd);
           console.log(images);
           var d = $("#editProductForm").serialize();
	        $.ajax({
                url:"{{ route('admin.products.updateAjax', $product->id) }}",
                data: fd,// the formData function is available in almost all new browsers.
                type:"POST",
                contentType:false,
                processData:false,
                cache:false,
                dataType:"json", // Change this according to your response from the server.
                error:function(err){
                    console.error(err);
                    window.location.href = "{{ route('admin.products.index') }}";
                },
                success:function(data){
                    console.log(data);
                    window.location.href = "{{ route('admin.products.index') }}";
                },
                complete:function(){
                    console.log("Request finished.");
                }
            });

        });

        $(document).ready(function(){
        	if($("#home_delivery").is(':checked')){
        		$(".charge_row").removeAttr('hidden');
        	}
        });

        $("#home_delivery").change(function() {
		    if(this.checked) {
		        $(".charge_row").removeAttr('hidden');
		    }else{
		    	$(".charge_row").attr('hidden', true);
		    }
		});
	</script>
@endsection