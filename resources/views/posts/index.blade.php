<x-layout>
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
</x-layout>