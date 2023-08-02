<article class="comment flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-4">
    <div class="user-avatar flex-shrink-0">
        <img src="https://i.pravatar.cc/60" alt="Placeholder Avatar" width="60" height="60" class="rounded-xl">
    </div>
    <div>
        <header class="mb-4">
            <h3 class="font-bold">John Doe</h3>
            <p class="text-xs">Posted <time>8 months ago</time></p>
        </header>
        <div class="comment-body">
            {{$slot}}
        </div>
    </div>
</article>