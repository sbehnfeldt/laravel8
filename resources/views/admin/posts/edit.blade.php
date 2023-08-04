<x-layout>
    <x-settings :heading="'Edit the Post: ' . $post->title">
        <form method="POST" action="/admin/posts/{{$post->id}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old( 'title', $post->title)"></x-form.input>
            <x-form.textarea name="excerpt" name="excerpt">{{old('excerpt', $post->excerpt )}}</x-form.textarea>
            <x-form.textarea class="textarea" name="body">{{old('excerpt', $post->body )}}</x-form.textarea>

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)"></x-form.input>
                </div>
                <img src="{{asset( 'storage/' . $post->thumbnail )}}" alt="" class="rounded-xl ml-6" width="100">
            </div>

            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category_id">
                    @php
                        $categories = \App\Models\Category::all()->sortBy( 'name' );
                    @endphp
                    @foreach($categories as $cat)
                        <option
                                value="{{$cat->id}}"
                                {{old('category_id', $post->catgory_id) == $cat->id ? 'selected' : '' }}>
                            {{$cat->name}}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="category"></x-form.error>
            </x-form.field>

            <x-form.submit-button>Update</x-form.submit-button>
        </form>

    </x-settings>
</x-layout>
