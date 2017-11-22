@extends('layouts.app')

@section('content')
		
	<div class="container">
		<div class="row mar-t-20">
		    <div class="col-md-8 col-md-offset-2 pad-t-20">
		        <div class="panel panel-default">
		            @if(auth()->check() && authUser()->incompleteProfile())
						<div class="panel-heading">We need to know your contact for further processing</div>

			            <div class="panel-body">
			                <form class="form-horizontal" method="POST" action="{{ route('general.products.buyNow', ['product' => session('orderItem')->id, 'user' => authUser()->id, 'incomplete' => 'incomplete']) }}">
			                    {{ csrf_field() }}
			                    
			                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
			                        <label for="phone" class="col-md-4 control-label">Phone</label>

			                        <div class="col-md-6">
			                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

			                            @if ($errors->has('phone'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('phone') }}</strong>
			                                </span>
			                            @endif
			                        </div>
			                    </div>

			                    <div class="form-group{{ $errors->has('mobile_phone') ? ' has-error' : '' }}">
			                        <label for="mobile_phone" class="col-md-4 control-label">Mobile Phone</label>

			                        <div class="col-md-6">
			                            <input id="mobile_phone" type="text" class="form-control" name="mobile_phone" required value="{{ old('mobile_phone') }}">

			                            @if ($errors->has('mobile_phone'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('mobile_phone') }}</strong>
			                                </span>
			                            @endif
			                        </div>
			                    </div>
			                    
			                    <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
			                        <label for="street" class="col-md-4 control-label">Address 1 (Street name)</label>

			                        <div class="col-md-6">
			                            <input id="street" type="text" class="form-control" name="street" required value="{{ old('street') }}">

			                            @if ($errors->has('street'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('street') }}</strong>
			                                </span>
			                            @endif
			                        </div>
			                    </div>

			                    <div class="form-group{{ $errors->has('area_location') ? ' has-error' : '' }}">
			                        <label for="area_location" class="col-md-4 control-label">Address 2 (Area location)</label>

			                        <div class="col-md-6">
			                            <input id="area_location" type="text" class="form-control" name="area_location" required value="{{ old('area_location') }}">

			                            @if ($errors->has('area_location'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('area_location') }}</strong>
			                                </span>
			                            @endif
			                        </div>
			                    </div>
			                    
			                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
			                        <label for="city" class="col-md-4 control-label">Address 3 (City Name)</label>

			                        <div class="col-md-6">
			                            <input id="city" type="text" class="form-control" name="city" required value="{{ old('city') }}">

			                            @if ($errors->has('city'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('city') }}</strong>
			                                </span>
			                            @endif
			                        </div>
			                    </div>

			                    <div class="form-group">
			                        <div class="col-md-6 col-md-offset-4">
			                            <button type="submit" class="btn btn-primary">
			                                Continue
			                            </button>
			                        </div>
			                    </div>
			                </form>
			            </div>
					@else
						@if(auth()->check())
							<div class="panel-heading">Shipping Details</div>

				            <div class="panel-body">
				                <form class="form-horizontal" method="POST" action="{{ route('general.products.buyNow', ['product' => session('orderItem')->id,'user' => authUser()->id]) }}">
				                    {{ csrf_field() }}
				                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
				                    	<label for="profile_address" class="col-md-4 control-label">Use profile address</label>
				                    	<div class="col-md-6">
				                    		<input type="radio" id="profile_address" value="1" name="profile_address" style="height: 20px; width: 20px" checked="checked">
				                    		 @if ($errors->has('profile_address'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('profile_address') }}</strong>
				                                </span>
				                            @endif
				                    	</div>
				                    </div>

				                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
				                    	<label for="profile_address_new" class="col-md-4 control-label">New shipping address</label>
				                    	<div class="col-md-6">
				                    		<input type="radio" id="profile_address_new" value="0" name="profile_address" style="height: 20px; width: 20px">
				                    		 @if ($errors->has('profile_address'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('profile_address') }}</strong>
				                                </span>
				                            @endif
				                    	</div>
				                    </div>
				                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
				                        <label for="phone" class="col-md-4 control-label">Phone</label>

				                        <div class="col-md-6">
				                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

				                            @if ($errors->has('phone'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('phone') }}</strong>
				                                </span>
				                            @endif
				                        </div>
				                    </div>

				                    <div class="form-group{{ $errors->has('mobile_phone') ? ' has-error' : '' }}">
				                        <label for="mobile_phone" class="col-md-4 control-label">Mobile Phone</label>

				                        <div class="col-md-6">
				                            <input id="mobile_phone" type="text" class="form-control contact_details" name="mobile_phone" value="{{ old('mobile_phone') }}">

				                            @if ($errors->has('mobile_phone'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('mobile_phone') }}</strong>
				                                </span>
				                            @endif
				                        </div>
				                    </div>
				                    
				                    <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
				                        <label for="street" class="col-md-4 control-label">Address 1 (Street name)</label>

				                        <div class="col-md-6">
				                            <input id="street" type="text" class="form-control contact_details" name="street" value="{{ old('street') }}">

				                            @if ($errors->has('street'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('street') }}</strong>
				                                </span>
				                            @endif
				                        </div>
				                    </div>

				                    <div class="form-group{{ $errors->has('area_location') ? ' has-error' : '' }}">
				                        <label for="area_location" class="col-md-4 control-label">Address 2 (Area location)</label>

				                        <div class="col-md-6">
				                            <input id="area_location" type="text" class="form-control contact_details" name="area_location" value="{{ old('area_location') }}">

				                            @if ($errors->has('area_location'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('area_location') }}</strong>
				                                </span>
				                            @endif
				                        </div>
				                    </div>
				                    
				                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
				                        <label for="city" class="col-md-4 control-label">Address 3 (City Name)</label>

				                        <div class="col-md-6">
				                            <input id="city" type="text" class="form-control contact_details" name="city" value="{{ old('city') }}">

				                            @if ($errors->has('city'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('city') }}</strong>
				                                </span>
				                            @endif
				                        </div>
				                    </div>

				                    <div class="form-group">
				                        <div class="col-md-6 col-md-offset-4">
				                            <button type="submit" class="btn btn-primary">
				                                Continue
				                            </button>
				                        </div>
				                    </div>
				                </form>
				            </div>
						@else
						<div class="panel-heading">Shipping details</div>

						<div class="panel-body">
						    <form class="form-horizontal" method="POST" action="{{ route('general.products.buyNow', ['product' => session('orderItem')->id]) }}">
						        {{ csrf_field() }}

						        <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
						            <label for="full_name" class="col-md-4 control-label">Full Name</label>

						            <div class="col-md-6">
						                <input id="full_name" type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" required autofocus>

						                @if ($errors->has('full_name'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('full_name') }}</strong>
						                    </span>
						                @endif
						            </div>
						        </div>

						        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

						            <div class="col-md-6">
						                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

						                @if ($errors->has('email'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('email') }}</strong>
						                    </span>
						                @endif
						            </div>
						        </div>
						        
						        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
						            <label for="phone" class="col-md-4 control-label">Phone</label>

						            <div class="col-md-6">
						                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

						                @if ($errors->has('phone'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('phone') }}</strong>
						                    </span>
						                @endif
						            </div>
						        </div>

						        <div class="form-group{{ $errors->has('mobile_phone') ? ' has-error' : '' }}">
						            <label for="mobile_phone" class="col-md-4 control-label">Mobile Phone</label>

						            <div class="col-md-6">
						                <input id="mobile_phone" type="text" class="form-control" name="mobile_phone" required value="{{ old('mobile_phone') }}">

						                @if ($errors->has('mobile_phone'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('mobile_phone') }}</strong>
						                    </span>
						                @endif
						            </div>
						        </div>
						        
						        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
						            <label for="street" class="col-md-4 control-label">Address 1 (Street name)</label>

						            <div class="col-md-6">
						                <input id="street" type="text" class="form-control" name="street" required value="{{ old('street') }}">

						                @if ($errors->has('street'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('street') }}</strong>
						                    </span>
						                @endif
						            </div>
						        </div>

						        <div class="form-group{{ $errors->has('area_location') ? ' has-error' : '' }}">
						            <label for="area_location" class="col-md-4 control-label">Address 2 (Area location)</label>

						            <div class="col-md-6">
						                <input id="area_location" type="text" class="form-control" name="area_location" required value="{{ old('area_location') }}">

						                @if ($errors->has('area_location'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('area_location') }}</strong>
						                    </span>
						                @endif
						            </div>
						        </div>
						        
						        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
						            <label for="city" class="col-md-4 control-label">Address 3 (City Name)</label>

						            <div class="col-md-6">
						                <input id="city" type="text" class="form-control" name="city" required value="{{ old('city') }}">

						                @if ($errors->has('city'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('city') }}</strong>
						                    </span>
						                @endif
						            </div>
						        </div>

						        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
			                    	<div class="col-md-12">
			                    		<div class="col-md-offset-4 col-md-1">
			                    			<input type="checkbox" id="create_account" value="1" name="create_account" style="height: 20px; width: 20px">
				                    	</div>
				                    	<div class="col-md-4">
				                    		<label for="create_account" class="pull-left control-label">Create account also</label>
				                    	</div>
				                    	@if ($errors->has('create_account'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('create_account') }}</strong>
			                                </span>
			                            @endif
			                    	</div>
			                    </div>

			                    <div class="form-group">
						            <div class="col-md-6 col-md-offset-4">
						                <button type="submit" class="btn btn-primary">
						                    Continue
						                </button>
						            </div>
						        </div>

						    </form>
						</div>
						@endif
		            @endif
		        </div>
		    </div>
		</div>
	</div>

@endsection

@section('javascript')
@parent
	<script>
		$(document).ready(function() {
		    $('input[type=radio][name=profile_address]').change(function() {
		        if (this.value == '1') {
		            console.log("1");
		            $('.contact_details').removeAttr('required');
		        }
		        else if (this.value == '0') {
		            console.log("0");
		            $('.contact_details').attr('required', true);
		        }
		    });
		});
	</script>
@endsection