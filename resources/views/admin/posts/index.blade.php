<x-layout>
    <x-settings heading="Manage Post">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Published</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>
                        <a href="/posts/{{$post->slug}}">{{$post->title}}</a></td>
                    <td>{{$post->author->name}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->created_at->format( 'Y-m-d')}}</td>
                    <td><a href="/admin/posts/{{$post->slug}}/edit">Edit</a></td>
                    <td>
{{--                        <a href="">Delete</a>--}}
                        <form method="POST" action="/admin/posts/{{$post->id}}">
                            @csrf
                            @method('DELETE')
                            <button style="border: 1px solid red">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-settings>
</x-layout>
