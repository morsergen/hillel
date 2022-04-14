<div class="col-12" id="comment-id-{{$comment->id}}">
    <div class="card">
        <div class="card-header">
            <strong>{{ $comment->user->full_name }}</strong>
            @if($comment->parent_id)
                by {{ $comment->replyUser()->full_name }}
            @endif
            @if($comment->user_id == auth()->id())
                <a href="#" onclick="return false;" class="edit" data-edit-id="{{$comment->id}}">Edit</a>
            @endif
        </div>
        <div class="card-body" id="comment-content-{{$comment->id}}">
            @include('comments/chunk/form', ['model' => $model, 'route' => route('comment.update', $comment), 'class' => 'd-none update'])
            <p class="card-text comment-body">{{ $comment->body }}</p>
        </div>
        <div class="card-footer reply-wrapper" data-comment-id="{{ $comment->id }}">
            @include('comments/chunk/form', ['model' => $model, 'route' => route('comment.reply'), 'class' => 'd-none'])
            <a href="#" onclick="return false;" class="reply">Reply</a>
        </div>
    </div>
    <br>
    <div class="row reply">
        <div class="col-md-11 col-md-offset-1">
            @if(!empty($comment->replies))
                @foreach($comment->replies as $reply)
                    @include('comments/chunk/single_comment', ['comment' => $reply, 'model' => $model])
                @endforeach
            @endif
        </div>
    </div>
</div>
