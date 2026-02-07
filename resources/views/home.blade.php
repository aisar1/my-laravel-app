<!DOCTYPE html>
<html>
<head>
    <title>My Laravel App</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        nav { background: #f4f4f4; padding: 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; }
        .post-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .post-card h3 { margin-top: 0; }
        .btn { padding: 8px 15px; background: #3490dc; color: white; text-decoration: none; border-radius: 4px; }
        .btn-red { background: #e3342f; }
        form { display: inline; }
    </style>
</head>
<body>

    <nav>
        <div>
            <strong>My Laravel App</strong>
        </div>
        <div>
            @auth
                <span>Hi, {{ auth()->user()->name }}!</span>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-red" style="border:none; cursor:pointer; margin-left: 10px;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="/register" class="btn" style="background:#38c172; margin-left: 5px;">Register</a>
            @endauth
        </div>
    </nav>

    <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

    <h1>Latest Posts</h1>

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="post-card">
                <h3>{{ $post->title }}</h3>
                <p>{{ Str::limit($post->body, 100) }}</p> <a href="/post/{{ $post->id }}">Read more</a>
            </div>
        @endforeach
    @else
        <p>No posts found. You should <a href="/tinker">add some via Tinker</a>!</p>
    @endif

</body>
</html>