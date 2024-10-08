<x-layout>
    {{-- displaying info message --}}
    @if (session('info'))
        <x-info>{{ session('info') }}</x-info>
    @elseif (session('success'))
        <x-success>{{ session('success') }}</x-success>
    @endif

    <x-header>Post Page</x-header>

    {{-- only authenticated users can add posts, delete auth users through cookies --}}
    @auth
        <div class="flex justify-end">
            <a href="{{ route('posts.create') }}">
                <x-button>Add Post</x-button>
            </a>
        </div>
    @endauth

    {{-- displaying posts using foreach --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($posts as $post)
            <a href="/posts/{{ $post->id }}"
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($post->content, 75, '...') }}
                </p>
                <button
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </a>
        @endforeach
    </div>

    {{-- displaying pagination links --}}
    <div class="mt-4">
        {{ $posts->links() }}
    </div>

    {{-- showing the current date --}}
    <p class="mt-4 text-xs text-blue-500">Today's Date: {{ date('Y-m-d') }}</p>
</x-layout>
