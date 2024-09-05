<x-layout>
    <x-header>Post Page</x-header>

    <div class="flex justify-end">
        <a href="/posts/create">
            <x-button>Add Post</x-button>
        </a>
    </div>

    {{-- showing the passed username and age from Controller --}}
    <p>Posts Author: {{ $username }} ({{ $age }})</p>

    {{-- displaying posts using foreach --}}
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post }}</li>
        @endforeach
    </ul>

    {{-- showing the current date --}}
    <p class="text-xs text-blue-500">Today's Date: {{ date('Y-m-d') }}</p>
</x-layout>
