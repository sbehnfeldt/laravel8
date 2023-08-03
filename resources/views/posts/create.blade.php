<x-layout>
    <section class="px-6 py-8">
        <x-panel class="max-w-sm mx-auto">
            <form method="POST" action="/admin/posts">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block mb02 uppercase font-bold text-xs text-gray-700">Title</label>
                    <input type="text" class="border border-gray-400 p-2 w-full"
                           name="title" id="title" value="{{old('title')}}" required>
                    @error('title')
                    <p class="text-red-500 text-xs mt-2">{{$mesage}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="excerpt" class="block mb02 uppercase font-bold text-xs text-gray-700">Excerpt</label>
                    <textarea class="border border-gray-400 p-2 w-full"
                              name="excerpt" id="excerpt" value="{{old('excerpt')}}" required></textarea>
                    @error('excerpt')
                    <p class="text-red-500 text-xs mt-2">{{$mesage}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="body" class="block mb02 uppercase font-bold text-xs text-gray-700">Body</label>
                    <textarea class="border border-gray-400 p-2 w-full"
                              name="body" id="body" value="{{old('body')}}" required></textarea>
                    @error('body')
                    <p class="text-red-500 text-xs mt-2">{{$mesage}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="category" class="block mb02 uppercase font-bold text-xs text-gray-700">Category</label>
                    <select name="category_id" id="category_id" >
                        @php
                            $categories = \App\Models\Category::all()->sortBy( 'name' );
                        @endphp
                        @foreach($categories as $cat)
                            <option
                                    value="{{$cat->id}}"
                                    {{old('category_id') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
                        @endforeach
                    </select>

                    @error('category')
                    <p class="text-red-500 text-xs mt-2">{{$mesage}}</p>
                    @enderror
                </div>

                <x-submit-button>Publish</x-submit-button>
            </form>
        </x-panel>

    </section>
</x-layout>
