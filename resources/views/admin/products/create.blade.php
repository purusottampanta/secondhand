@extends('admin.dashboard-layout')

@section('content')
	<div class="row">
		<div class="col-md-12">
			
			<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
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
                        <input type='file' id="image[0]" name="image[0]" class="image" />
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
                        <input type='file' id="image[1]" name="image[1]" class="image" />
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
				<div class="row">
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
	<script>
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