<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/app.css">
        <title>My Blog</title>
    </head>
    <body>
        <h1>Posts</h1>

        @foreach ($posts as $post)
        <article>
            <h2><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h2>
            <p><a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a></p>
            {{$post->excerpt}}
        </article>
        @endforeach
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad adipisci alias assumenda at aut cum delectus dicta eaque, iure laborum mollitia quasi quibusdam reprehenderit, totam ullam veniam vero voluptate.</p>
    </body>
</html>