<x-layout>
    {{-- displaying info message --}}
    @if (session('info'))
        <x-postdeleted>{{ session('info') }}</x-postdeleted>
    @elseif (session('success'))
        <x-usercreated>{{ session('success') }}</x-usercreated>
    @endif

    <x-header>Posts</x-header>

    {{-- only authenticated users can add posts, delete auth users through cookies --}}
    @auth
        <div class="flex justify-end">
            <a href="{{ route('posts.create') }}">
                <x-button>Add Post</x-button>
            </a>
        </div>
    @endauth

    {{-- displaying posts using table --}}
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Post Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Content
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Author
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    {{-- check if it's not the last post --}}
                    @if (!$loop->last)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $post->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $post->content }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->user->name }}
                            </td>
                        </tr>
                    @else
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $post->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $post->content }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->user->name }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- showing the current date --}}
    <p class="mt-4 text-xs text-blue-500">Today's Date: {{ date('Y-m-d') }}</p>
</x-layout>
