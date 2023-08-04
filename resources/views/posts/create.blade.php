<x-layout>
    <x-settings heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title"></x-form.input>
            <x-form.textarea name="excerpt"></x-form.textarea>
            <x-form.textarea class="textarea" name="body"></x-form.textarea>
            <x-form.input name="thumbnail" type="file"></x-form.input>

            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category_id">
                    @php
                        $categories = \App\Models\Category::all()->sortBy( 'name' );
                    @endphp
                    @foreach($categories as $cat)
                        <option
                                value="{{$cat->id}}"
                                {{old('category_id') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
                    @endforeach
                </select>
                <x-form.error name="category"></x-form.error>
            </x-form.field>

            <x-form.submit-button>Publish</x-form.submit-button>
        </form>

    </x-settings>
</x-layout>
