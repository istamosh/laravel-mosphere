@props([
    'active' => false,
])

{{-- fill in $slot with the text content from the caller --}}
{{-- $attributes from these <a> tags will be passed to the caller --}}

<li>
    <a {{ $attributes }} @class([
        'block py-2 px-3 bg-blue-700 rounded md:bg-transparent md:p-0',
        'text-blue-500' => $active,
        'text-white hover:text-blue-500' => !$active,
    ]) aria-current="page">{{ $slot }}</a>
</li>
