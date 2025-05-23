@props(['active' => false])

<a {{ $attributes }}
    class="{{ $active
        ? 'bg-[#F9BD64] text-white'
        : 'text-black-300
         hover:bg-[#FBD7A2] hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
    aria-current="{{ $active ? 'page' : false }}">{{ $slot }}</a>
