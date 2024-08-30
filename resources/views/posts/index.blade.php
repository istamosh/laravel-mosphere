{{-- Blade is a Laravel template engine --}}
{{-- This will be called from the PostController --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts | Mosphere</title>
</head>
<body>
    <h1>Post Page</h1>

    {{-- showing the passed username and age from Controller --}}
    <p>Posts Author: {{ $username }} ({{ $age }})</p>
    
    {{-- displaying posts using foreach --}}
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post }}</li>
        @endforeach
    </ul>

    {{-- showing the current date --}}
    <p>Today's Date: {{ date('Y-m-d') }}</p>
</body>
</html>