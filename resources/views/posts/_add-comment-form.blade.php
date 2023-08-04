@auth()
    <x-panel>
        <form method="POST" action="/posts/{{$post->slug}}/comments">

            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" alt="My Avatar" width="40"
                     height="40" class="rounded-xl">

                <h2 class="ml-4">Want to participate?</h2>

            </header>
            <div class="mt-6">
                <textarea class="w-full text-sm focus:outline-none focus:ring" name="body" id=""
                          rows="5" placeholder="Join the conversation!" required></textarea>
                @error('body')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror

            </div>
            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <x-form.submit-button>Post</x-form.submit-button>
            </div>
        </form>
    </x-panel>
@else
    <p>
        <a class="text-xs font-bold uppercase" href="/register">Register</a> or
        <a class="text-xs font-bold uppercase" href="/login">login</a>
        to join the conversation
    </p>
@endauth
