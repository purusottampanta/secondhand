@extends('admin.dashboard-layout')

@section('content')
	<div class="col-md-12">
		<h2>Users</h2>
		<div class="row">
			<div class="media pad-10 bg-info">
				<div class="media-left">
					<span class="pad-l-20 mar-l-20">Image</span>
				</div>
				<div class="media-body">
					<div class="col-md-10">
						<div class="col-md-3">
							<span class="pad-l-20 mar-l-20">Full name</span>
						</div>
						<div class="col-md-3">
							<span class="pad-l-20 mar-l-20">Email</span>
						</div>
						<div class="col-md-2">
							<span>Mobile phone</span>
						</div>
						<div class="col-md-4">
							<span>Confirmed</span>
							<span class="pull-right">Admin</span>
						</div>
					</div>
					<div class="col-md-2">
						<span class="pull-right">Operations</span>
					</div>
				</div>
			</div>
		</div>
		@forelse($users as $key => $user)
			<div class="row mar-5">
				<div class="media pad-10 {{ $user->is_admin ? 'bg-success': 'bg-info' }}">
					<div class="media-left">
					    <a href="{{ route('admin.users.show', $user->slug) }}">
					      <img class="media-object" src="{{ $user->profilePicture() }}" alt="{{ $user->full_name }}" height="{{ $user->profile_picture ? '100%': '35%'  }}" class="img-responsive">
					    </a>
					</div>
					<div class="media-body">
					    <div class="col-md-10">
					    	<a href="{{ route('admin.users.show', $user->slug) }}">
						    	<div class="col-md-3">
						    		<h4 class="media-heading">{{ $user->full_name }}</h4>
						    	</div>
							    <div class="col-md-3">
							    	<span><i class="fa fa-envelope pad-r-5"></i>{{ $user->email }}</span>
							    </div>
								<div class="col-md-2">
							    	<span><i class="fa fa-phone pad-r-5"></i>{{ $user->mobile_phone or '--' }}</span>
							    </div>
							    <div class="col-md-4">
							    	<span title="{{ $user->confirmed ? 'confirmed': 'Not confirmed' }}"><i class="fa fa-{{ $user->confirmed ? 'check text-success': 'times text-danger' }}"></i></span>
							    	<span title="{{ $user->is_admin ? 'admin': 'not admin' }}" class="pull-right"><i class="fa fa-{{ $user->is_admin ? 'check text-success': 'times text-danger' }}"></i></span>
							    	{{-- <span class="pull-right">{{ getCategories()[$user->category] }}</span> --}}
							    </div>
						    </a>
					    </div>
					    <div class="col-md-2">
					    	<div class="pull-right">
						    	<a href="{{ route('admin.users.edit', $user->slug) }}" class="btn btn-xs" type="button" title="edit"><i class="fa fa-edit"></i></a>
						    	{!! getDeleteForm(route('admin.users.destroy', $user->id), 'Delete user?', 'Are you sure you want to delete this user', 'btn btn-flat ink-reaction text-warning', 'fa fa-archive') !!}
						    </div>
					    </div>
					</div>
				</div>
			</div>
		@empty

		@endforelse

		{{ $users->appends(['q' => $q, 'confirmed' => $confirmed, 'admin' => $admin, 'sort' => $sort])->links() }}
        {{-- {{ $users->appends(request()->query())->links() }} --}}
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