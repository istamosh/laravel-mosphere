<x-layout>
    {{-- displaying info message --}}
    @if (session('info'))
        <x-info>{{ session('info') }}</x-info>
    @endif

    <x-header>Post Table</x-header>

    {{-- displaying posts using table --}}
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Post Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Author
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr class="{{ $loop->last ? '' : 'bg-white border-b' }} dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ Str::limit($post->title, 50, '...') }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $post->created_at }} (modified {{ $post->updated_at->diffForHumans() }})
                        </td>
                        <td class="px-6 py-4">
                            {{ $post->user->name }}
                        </td>
                        <td class="px-6 py-4 flex flex-wrap justify-center">
                            {{-- add specialized routes for admin --}}
                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>

                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            No post yet.
                        </th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- showing the current date --}}
    <p class="mt-4 text-xs text-blue-500">Today's Date: {{ date('Y-m-d') }}</p>
</x-layout>
