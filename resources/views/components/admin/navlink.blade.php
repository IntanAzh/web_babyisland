@props(['active' => false])

<a {{ $attributes }}
    class="{{ $active
        ? 'block text-center py-3 rounded-full bg-yellow-400 text-gray-800 font-bold shadow'
        : 'block text-center py-2 text-gray-800 font-semibold hover:text-orange-500' }}"
    aria-current="{{ $active ? 'page' : false }}">{{ $slot }}</a>
