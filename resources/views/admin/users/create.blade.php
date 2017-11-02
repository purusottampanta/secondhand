@extends('admin.dashboard-layout')

@section('content')
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->exists ? 'Update profile' : 'Register profile' }}</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ $user->exists ? route('admin.users.update', $user->id): route('admin.users.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
						{{ $user->exists ? method_field('PATCH') : '' }}
                        <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label for="full_name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control" name="full_name" value="{{ $user->exists ? $user->full_name : old('full_name') }}" required autofocus>

                                @if ($errors->has('full_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}


                        @if(!$user->exists)
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->exists ? $user->email : old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password" class="col-md-4 control-label">Password</label>

	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" name="password" required>

	                                @if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

	                            <div class="col-md-6">
	                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
	                            </div>
	                        </div>
                        @endif
                        
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->exists? $user->phone : old('phone') }}">

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
                                <input id="mobile_phone" type="text" class="form-control" name="mobile_phone" required value="{{ $user->exists ? $user->mobile_phone :old('mobile_phone') }}">

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
                                <input id="street" type="text" class="form-control" name="street" required value="{{ $user->exists ? $user->street : old('street') }}">

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
                                <input id="area_location" type="text" class="form-control" name="area_location" required value="{{ $user->exists ? $user->area_location : old('area_location') }}">

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
                                <input id="city" type="text" class="form-control" name="city" required value="{{ $user->exists ? $user->city : old('city') }}">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($user->exists)
                            <div class="form-group{{ $errors->has('profile_picture') ? ' has-error' : '' }}">
                                <label for="profile_picture" class="col-md-4 control-label">Profile picture</label>

                                <div class="col-md-6">
                                    <input id="profile_picture" type="file" name="profile_picture">
                                    <img class="media-object" src="{{ $user->profilePicture() }}" alt="{{ $user->full_name }}" height="40%" width="40%" class="img-responsive">
                                    @if ($errors->has('profile_picture'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('profile_picture') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <div class="pull-right">
                                    <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ $user->exists ? 'Update' : 'Register' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
@endsection