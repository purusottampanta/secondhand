<div class="media response-info">
	<div class="media-left response-text-left">
		<a href="#">
			<img src="{{ $comment->user->profilePicture() }}" alt="{{ $comment->user->full_name }}" height="70" width="70">
		</a>
		{{-- <h5><a href="#">{{ $comment->user->full_name }}</a></h5> --}}
	</div>
	<div class="media-body response-text-right">
	 	<h5 class="media-heading"><strong>{{ $comment->user->full_name }}</strong></h5>
		<p>{{ $comment->comment }}</p>
		<ul>
			<li>{{ $comment->created_at->diffForHumans() }}</li>
			<li class="reviewReply"><a>Reply</a></li>
		
			
			<div class="replyBox" hidden>
				@if(!authUser())
					<div class="reviewRule" hidden style="background-color: #e3e3e3; font-size: 16px">
						<span class="text-lg">You need to login to post review. <a href="{{ route('login') }}">Click here</a> to login</span>
					</div>
				@endif
				@include('general.comments.form', ['parent_id' => $comment->id])
			</div>
		</ul>
			
			@if(isset($comments[$comment->id]))
				@include('general.comments.commentlist', ['commentsCollection' => $comments[$comment->id]])
			@endif
	</div>
	<div class="clearfix"> </div>
</div>