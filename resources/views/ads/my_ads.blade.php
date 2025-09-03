@extends('layouts.app')

@section('header', 'My Ads')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($ads as $ad)
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-bold text-lg">{{ $ad->title }}</h2>
            <p class="text-gray-500 text-sm">{{ $ad->category->name }} | {{ $ad->location }}</p>
            <p class="mt-2 font-semibold">${{ $ad->price }}</p>

            @if($ad->images->count())
                <img src="{{ asset('storage/'.$ad->images->first()->path) }}" class="w-full h-32 object-cover rounded mt-2">
            @endif

            <div class="mt-4 flex gap-2">
                <a href="{{ route('ads.edit', $ad->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>

                <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ad?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <p class="col-span-3 text-center text-gray-500">You have no ads yet.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $ads->links() }}
</div>
@endsection
