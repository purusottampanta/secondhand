@extends('layouts.app')

@section('content')
		
	<div class="container">
		<div class="row mar-t-20">
		    <div class="col-md-8 col-md-offset-2 pad-t-20">
		        <div class="panel panel-default">
		            <div class="panel-heading">We need to know your contact for further processing</div>

		            <div class="panel-body">
		                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
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

		                    <div class="form-group">
		                        <div class="col-md-6 col-md-offset-4">
		                            <button type="submit" class="btn btn-primary">
		                                Submit
		                            </button>
		                        </div>
		                    </div>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
	</div>

@endsection