@extends('admin.dashboard-layout')

@section('stylesheet')
@parent
	 <style>
    .operation{
      position: absolute; 
      top: 0px; 
      right: 1em; 
      display: none;
      background-color: white;
    } 
    .slider-image:hover .operation{
      display: block;
    }
   </style>
@endsection
  
@section('content')
  <div class="container">
    <div class="col-md-12">
      <!-- Button trigger modal -->
      <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createSliderModal">
        Add new slide
      </a>
    </div>
  </div>

  <div class="container">
    <div class="col-md-11">
      @forelse($sliders->chunk(4) as $index => $chunked_slider)
        <div class="row pad-r-20">
          @foreach($chunked_slider as $key => $slider)
            <div class="col-md-3 slider-image">
              <a href="{{ asset($slider->image_path) }}" target="_blank">
                <img src="{{ $slider->smallThumbnail() }}" alt="{{ $slider->image_name }}" height="100%" width="100%">
              </a>
              <div class="operation">
                <a class="confirm-delete btn btn-flat" type="button" data-toggle="modal" data-target="#editSliderModel{{ $slider->id }}" data-keyboard="false" data-backdrop="static" title="delete">
                <i class="fa fa-edit opacity-75"></i> 
              </a>
                {!! getDeleteForm(route('admin.sliders.destroy', $slider->id), 'Delete slider?', 'Are you sure you want to delete this slider', 'btn btn-flat ink-reaction text-danger', 'fa fa-archive') !!}
              </div>
            </div>
            <!--create slider Modal -->
            <div class="modal fade" id="editSliderModel{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="editSliderModel{{ $slider->id }}Label">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form action="{{ route('admin.sliders.update', $slider->id) }}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="editSliderModel{{ $slider->id }}Label">Add new slide</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
                        <label for="position" class="control-label">Position</label>
                        <input type="number" class="form-control" id="position" name="position" min="1" max="10" step="1" value="{{ $slider->position }}">

                        @if($errors->has('position'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('position') }}</strong>
                          </span>
                        @endif
                      </div>
                      <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="image" class="control-label">Image</label>
                        <input type="file" class="" id="image" name="image">
                        @if($errors->has('image'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('image') }}</strong>
                          </span>
                        @endif
                        <img src="{{ $slider->smallThumbnail() }}" alt="{{ $slider->image_name }}">
                      </div>
                      {{-- <div class="form-group">
                        <label for="url" class="control-label">Url</label>
                        <input type="text" class="form-control" id="url" name="url">
                      </div> --}}

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @empty

      @endforelse
    </div>
  </div>

  <!--create slider Modal -->
<div class="modal fade" id="createSliderModal" tabindex="-1" role="dialog" aria-labelledby="createSliderModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="createSliderModalLabel">Add new slide</h4>
        </div>
        <div class="modal-body">
          <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
            <label for="position" class="control-label">Position</label>
            <input type="number" class="form-control" id="position" name="position" min="1" max="10" step="1" value="{{ old('position') }}">

            @if($errors->has('position'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('position') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
            <label for="image" class="control-label">Image</label>
            <input type="file" class="" id="image" name="image">
            @if($errors->has('image'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('image') }}</strong>
              </span>
            @endif
          </div>
          {{-- <div class="form-group">
            <label for="url" class="control-label">Url</label>
            <input type="text" class="form-control" id="url" name="url">
          </div> --}}

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
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
    });
  </script>


@endsection