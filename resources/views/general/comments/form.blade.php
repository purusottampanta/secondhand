<form action="{{ route('comments.store', $product->id) }}" method="POST">
{{ csrf_field() }}

	@if(isset($parent_id))
	<input type="hidden" name="parent_id" value="{{ $parent_id }}">
	@endif
	<textarea name="comment" cols="25" rows="3" class="form-control {{ !authUser() ? 'reviewTextarea' : '' }}" id=""></textarea>

	<div class="pull-right">
		<div style="position: relative; bottom: 40px; right: 10px">
			<input type="submit" value="POST" class="btn btn-primary" {{ !authUser() ? 'disabled' : '' }}>
		</div>
	</div>
</form>