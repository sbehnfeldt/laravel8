@props([ 'comment' ])

<article class="comment flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-4">
    <div class="user-avatar flex-shrink-0">
        <img src="https://i.pravatar.cc/60?u={{$comment->id}}" alt="Placeholder Avatar" width="60" height="60" class="rounded-xl">
    </div>
    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{$comment->author->username}}</h3>
            <p class="text-xs">Posted <time>{{$comment->created_at}}</time></p>
        </header>
        <div class="comment-body">
            {!! $comment->body !!}
        </div>
    </div>
</article>