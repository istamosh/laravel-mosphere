<x-layout>
    <div class="flex justify-end">

        {{-- only authenticated users can edit and delete owned posts --}}
        @can('update', $post)
            {{-- edit post using post id --}}
            <a href="{{ route('posts.edit', $post->id) }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit
                Post</a>
        @endcan

        @can('delete', $post)
            {{-- delete post using post id --}}
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete
                    Post</button>
            </form>
        @endcan

    </div>

    {{-- display the post's title --}}
    <x-header>{{ $post->title }}</x-header>

    {{-- display the post's content --}}
    <p
        class="mb-3 text-gray-500 dark:text-gray-400 first-line:uppercase first-line:tracking-widest first-letter:text-5xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:me-2 first-letter:float-start">
        {{ $post->content }}</p>

    <p class="text-gray-500 dark:text-gray-400"></p>
</x-layout>
