@extends('admin.dashboard-layout')

@inject('main_category', 'App\Models\Category')

@section('content')
	<div class="row">
		<div class="col-md-12">
			
			<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="createImageForm">
				{{-- {{ csrf_field() }} --}}
				<div class="row pad-b-10">
					<div class="col-md-9" style="margin-right: 20px">
						<div class="col-md-offset-4">
							<h3>Create new product</h3>
						</div>
						<div class="pull-right">
							<a href="{{ url()->previous() }}">
								<button class="btn btn-danger text-uppercase" type="button">Cancel</button>
							</a>
							<input type="submit" class="btn btn-primary text-uppercase" value="Create">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 col-md-offset-3 form-group {{ ($errors->has('image.0') ? 'has-error' : '') }}">
                        <label for="image[0]" class="control-label">
                                Image 1/2
                                <span class="text-danger pad-l-10">*</span>
                            </label>
                        <input type='file'  id="image0" name="image[0]" class="image" accept="image/*" />
                        {{-- <input type='file' id="image[0]" name="image[0]" class="image" /> --}}
                        <img id="img1" src="#" alt="your image" height="150em" width="200em" hidden="hidden" class="viewImage" />
                        {{-- @if($product->exists && array_key_exists(0, $images))
                            <img src="{{ $images[0] }}" alt="your image" height="150em" width="200em">
                        @endif --}}
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
                        <input type='file' id="image1" name="image[1]" class="image" accept="image/*" />
                        {{-- <input type='file' id="image[1]" name="image[1]" class="image" /> --}}
                        <img id="img1" src="#" alt="your image" height="150em" width="200em" hidden="hidden" class="viewImage" />
                        {{-- @if($product->exists && array_key_exists(0, $images))
                            <img src="{{ $images[0] }}" alt="your image" height="150em" width="200em">
                        @endif --}}
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
		                    <input id="product_name" type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" required autofocus>

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
		                    {{-- <input id="condition" type="text" class="form-control" name="condition" value="{{ old('condition') }}" required autofocus> --}}
		                    <select name="condition" id="condition" class="form-control" required autofocus>
		                    	<option value="">Select condition</option>
		                    	<option value="like_new" {{ old('condition') == 'like_new' ? 'selected' :'' }}>Like New</option>
		                    	<option value="excellent" {{ old('condition') == 'excellent' ? 'selected' :'' }}>Excellent</option>
		                    	<option value="good" {{ old('condition') == 'good' ? 'selected' :'' }}>Good</option>
		                    	<option value="fair" {{ old('condition') == 'fair' ? 'selected' :'' }}>Fair</option>
		                    </select>

		                    @if ($errors->has('condition'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('condition') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
				</div>
				{{-- <div class="row">
					<div class="col-md-12 form-group{{ $errors->has('category') ? ' has-error' : '' }}">
		                <div class="col-md-offset-1 col-md-2">
		                	<label for="category" class="control-label">Category</label>
		                </div>

		                <div class="col-md-6">
		                    <select name="category" id="category" class="form-control" required autofocus>
		                    	<option value="">Select Category</option>
		                    	@foreach(getCategories() as $key=> $category)
									<option value="{{ $key }}" {{ old('category') == $key ? 'selected' :'' }}>{{ $category }}</option>
		                    	@endforeach
		                    </select>

		                    @if ($errors->has('category'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('category') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
				</div> --}}
				<div class="form-group {{ ($errors->has('main_category') ? 'has-error' : '') }}">
				    <div class="col-md-3 col-sm-6">
				        <label for="main_category" class="control-label pull-right">
				            Category
				            <span class="text-danger pad-l-10">*</span>
				        </label>
				    </div>
				    <div class="col-md-6 col-sm-6">
				        <select class="form-control" id="main_category" name="main_category" required>
				            <option value="">Select category</option>
				            @foreach($main_category->where('parent_id', null)->get() as $main)
				                <option value="{{ $main->id }}" {{old("main_category") == $main->id ? "selected":"" }}>{{ $main->category }}</option>
				            @endforeach
				        </select>
				        @if ($errors-> has('main_category'))
				        <span class="glyphicon glyphicon-warning-sign form-control-feedback">
				        </span>
				        <span class="help-block">
				            <strong>
				              {{ $errors-> first('main_category') }}
				            </strong>
				        </span>
				        @endif
				    </div>
				    <div  id="spinner" hidden="hidden">

				        <span class="fa fa-spinner fa-spin fa-2x"></span>

				    </div>

				    <div class="col-md-offset-3 col-md-6">
				        <div class="form-group secondselector pad-r-10" hidden="hidden" style="margin-top: 10px!important">
				            <select id=secondselectbox class="form-control mar-l-10" name="category"></select>
				            <div  id="spinnerSecond" hidden="hidden">

				                <span class="fa fa-spinner fa-spin fa-2x"></span>

				            </div>
				        </div>
				        <div class="form-group thirdselector pad-r-10" hidden="hidden" style="margin-top: 10px!important">
				            <select id=thirdselectbox class="form-control mar-l-10" name="sub_category"></select>
				        </div> 
				    </div> 
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('price') ? ' has-error' : '' }}">
						<div class="col-md-offset-1 col-md-2">
							<label for="price" class="control-label">Price</label>
						</div>

						<div class="col-md-6">
							<input type="number" step="0.01" min="0.00" id="price" class="form-control" name="price" value="{{ old('price') }}" required autofocus>

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
							<input type="number" step="0.01" min="0.00" max="90.00" id="discount" class="form-control" name="discount" value="{{ old('discount') }}">

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
							<input type="checkbox" name="is_negotiable" id="is_negotiable" value="1" style="height: 20px; width: 20px">
							<label for="is_negotiable" class="control-label mar-l-10">Price negotiable ?</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('is_featured') ? ' has-error' : '' }}">
						<div class="col-md-6 col-md-offset-3">
							<input type="checkbox" name="is_featured" id="is_featured" value="1" style="height: 20px; width: 20px">
							<label for="is_featured" class="control-label mar-l-10">Featured product ?</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group{{ $errors->has('home_delivery') ? ' has-error' : '' }}">
						<div class="col-md-6 col-md-offset-3">
							<input type="checkbox" name="home_delivery" id="home_delivery" value="1" style="height: 20px; width: 20px" {{ old('home_delivery') == 1 ? 'checked' : '' }}>
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
							<input type="number" step="0.01" min="0.00" id="delivery_charge" class="form-control" name="delivery_charge" value="{{ old('delivery_charge') }}">

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
							<input type="number" step="1" max="90" min="1" id="listing_duration" class="form-control" name="listing_duration" value="{{ old('listing_duration') }}" required autofocus>

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
							<input type="text" id="features" class="form-control" name="features" value="{{ old('features') }}" required autofocus>

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
							<textarea name="description" id="description" cols="30" rows="6" class="form-control">{{ old('description') }}</textarea>

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
							<textarea name="page_title" id="page_title" cols="30" rows="3" class="form-control">{{ old('page_title') }}</textarea>

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
							<textarea name="meta_key" id="meta_key" cols="30" rows="3" class="form-control">{{ old('meta_key') }}</textarea>

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
							<textarea name="meta_description" id="meta_description" cols="30" rows="6" class="form-control">{{ old('meta_description') }}</textarea>

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
							<input type="submit" class="btn btn-primary text-uppercase" value="Create">
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

		$('#main_category').on('change', function(e){
		    e.preventDefault();
		    $('#spinner').show();
		    var id = $(this).val();
		    var url = "/admin/categories/" + id +"/category-list";
		    var data = {'id' : id};

		    if(id){
		    	$.ajax({
			        url: url,
			        type: 'GET',
			        // data: data,
			        success:function(data){
			            var locationString = '<option value="">Please select</option>';
			            $('#thirdselectbox').html(locationString);
			            for(var i =0; i<data.length; i++){
			                locationString += '<option value="' + data[i].id + '">' + data[i].category + '</option>';
			            }
			            $('#secondselectbox').parent('.secondselector').removeAttr('hidden');
			            $('#secondselectbox').html(locationString);
			            $('#spinner').hide();
			        }
			    });
		    }else{
		    	var locationString = '<option value="">Please select</option>';
		    	$('#secondselectbox').html(locationString);
			    $('#thirdselectbox').html(locationString);
		    }
		});
		$('#secondselectbox').on('change', function(e){
		    e.preventDefault();
		    $('#spinnerSecond').show();
		    var id = $(this).val();
		    var url = "/admin/categories/" + id +"/category-list";
		    var data = {'id' : id};

		    if(id){
		    	$.ajax({
		    	    url: url,
		    	    type: 'GET',
		    	    // data: data,
		    	    success:function(data){
		    	        var locationString = '<option value="">Please select</option>';
		    	        for(var i =0; i<data.length; i++){
		    	            locationString += '<option value="' + data[i].id + '">' + data[i].category + '</option>';
		    	        }
		    	        $('#thirdselectbox').parent('.thirdselector').removeAttr('hidden');
		    	        $('#thirdselectbox').html(locationString);
		    	        $('#spinnerSecond').hide();
		    	    }
		    	});
		    }else{
		    	var locationString = '<option value="">Please select</option>';
		    	$('#thirdselectbox').html(locationString);
		    	$('#spinnerSecond').hide();
		    }
		});

		// if (window.File && window.FileReader && window.FileList && window.Blob) {
		//     document.getElementById('image0').onchange = function(){
		//         var files = document.getElementById('image0').files;
		//         for(var i = 0; i < files.length; i++) {
		//             resizeAndUpload(files[i]);
		//         }
		//     };
		// } else {
		//     alert('The File APIs are not fully supported in this browser.');
		// }
		
		function alertProductCreation() {
			var para = document.createElement("p");
			var node = document.createTextNode("Creating New product ");
			para.appendChild(node);
			swal({
				title: 'Please wait ...',
				content: para,
				buttons: false,
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		}

		 $("#createImageForm").submit(function(e){
                e.preventDefault();
                alertProductCreation();
                resizeAndUpload();
            });
		function resizeAndUpload() {
			var form = document.getElementById("createImageForm");
			var files = document.getElementById('image0').files;
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

	               // Create a FormData and append the file
// <<<<<<< HEAD
	               var fd = new FormData();
// =======
	               var fd = new FormData($("#createImageForm")[0]);
// >>>>>>> 455d010842560e6ad93e9105c42239dfb48bc2a2
	               fd.append('product_name', $('#product_name').val());
	               fd.append('condition', $('#condition').val());
	               fd.append('main_category', $('#main_category').val());
	               fd.append('category', $('#secondselectbox').val());
	               fd.append('sub_category', $('#thirdselectbox').val());
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
	               fd.append("image[0]", blob, file.name);

	               console.log(fd);

			        $.ajax({
	                    url:"{{ route('admin.products.store') }}",
	                    data: fd,// the formData function is available in almost all new browsers.
	                    type:"POST",
	                    contentType:false,
	                    processData:false,
	                    cache:false,
	                    dataType:"json", // Change this according to your response from the server.
	                    error:function(err){
	                        console.error(err);
	                    },
	                    success:function(data){
	                        if (document.getElementById("image1").value != "") {
	                        	console.log(data);
	                        	resizeAndUploadSecondImage(data);
	                        }else{
	                        	window.location.href = "{{ route('admin.products.index') }}";
	                        }
	                    },
	                    complete:function(){
	                        console.log("Request finished.");
	                    }
	                });
			    }
		 
		   }
		   reader.readAsDataURL(file);
		}

		function resizeAndUploadSecondImage(id) {
			var url = '/admin/products/update-image-only/'+id;
		 resizeAndUploadImageOnly(url);
		}

		function resizeAndUploadImageOnly(url) {
			var files = document.getElementById('image1').files;
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

	               // Create a FormData and append the file
<<<<<<< HEAD
	               var fd = new FormData();
=======
	               var fd = new FormData($("#createImageForm")[0]);
>>>>>>> 455d010842560e6ad93e9105c42239dfb48bc2a2
	               fd.append('is_from_create', 'yes');
	               fd.append("image", blob, file.name);

	               console.log(fd);

			        $.ajax({
	                    url:url,
	                    data: fd,// the formData function is available in almost all new browsers.
	                    type:"POST",
	                    contentType:false,
	                    processData:false,
	                    cache:false,
	                    dataType:"json", // Change this according to your response from the server.
	                    error:function(err){
	                        console.error(error);
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

        $(".image").change(function(){
            var img = $(this).siblings('.viewImage');
            readURL(this, img);
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