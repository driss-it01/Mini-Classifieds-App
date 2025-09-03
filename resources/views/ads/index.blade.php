@extends('layouts.app')

@section('header', 'All Ads')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($ads as $ad)
        <div class="border rounded-lg p-4 hover:shadow-lg transition">
            <a href="{{ route('ads.show', $ad->slug) }}" class="text-blue-600 font-bold">
                {{ $ad->title }}
            </a>
            <p class="text-gray-500 text-sm">{{ $ad->category->name }}</p>
            <p class="mt-2">{{ Str::limit($ad->description, 50) }}</p>
            <p class="mt-1 font-semibold">${{ $ad->price }}</p>
        </div>
    @empty
        <p>No ads found.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $ads->links() }}
</div>
@endsection
