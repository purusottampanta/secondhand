@extends('users.user-dashboard-layout')

@section('content')
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update profile</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.profile.update', $user->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
						{{ method_field('PATCH') }}
                        <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label for="full_name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control" name="full_name" value="{{ $user->full_name }}" required autofocus>

                                @if ($errors->has('full_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}">

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
                                <input id="mobile_phone" type="text" class="form-control" name="mobile_phone" required value="{{ $user->mobile_phone }}">

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
                                <input id="street" type="text" class="form-control" name="street" required value="{{ $user->street }}">

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
                                <input id="area_location" type="text" class="form-control" name="area_location" required value="{{ $user->area_location }}">

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
                                <input id="city" type="text" class="form-control" name="city" required value="{{ $user->city }}">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <div class="pull-right">
                                    <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                    Update
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