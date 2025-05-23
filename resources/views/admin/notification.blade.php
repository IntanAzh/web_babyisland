@extends('layouts.app') {{-- atau layout admin kamu --}}

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Notifications</h2>

    <div class="bg-white shadow-md rounded-md p-4">
        @forelse ($notifications as $notification)
            <div class="flex justify-between items-center border-b py-2">
                <div>
                    <p class="font-semibold">{{ $notification['nama'] }}</p>
                    <p class="text-sm text-gray-500">Rp. {{ number_format($notification['harga'], 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400">{{ $notification['tanggal'] }}</p>
                </div>
                <span class="bg-yellow-400 text-white text-xs px-2 py-1 rounded">Sold</span>
            </div>
        @empty
            <p class="text-gray-500">No notifications found.</p>
        @endforelse
    </div>
</div>
@endsection
