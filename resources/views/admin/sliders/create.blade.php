@extends('admin.dashboard-layout')

@section('stylesheet')
@parent
	
@endsection

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
          <div class="col-md-12 form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <div class="col-md-offset-1 col-md-2">
              <label for="description" class="control-label">description</label>
            </div>

            <div class="col-md-6">
              <textarea name="description" id="description" cols="30" rows="6" class="form-control">
                {{ old('description') }}
              </textarea>

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