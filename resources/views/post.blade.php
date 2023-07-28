<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/app.css">
        <title>Document</title>
    </head>
    <body>
        <article>
            <h1>
                {{ $post->title }}
            </h1>
            <p>by <a href="/authors/{{$post->author->username}}">{{$post->author->name}}</a> in <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a></p>
            <div>
                {!! $post->body !!}
            </div>

        </article>

        <a href="/">Home</a>
    </body>
</html>