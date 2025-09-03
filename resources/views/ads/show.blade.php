@extends('layouts.app')

@section('header', $ad->title)

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <p class="text-gray-500">{{ $ad->category->name }} | {{ $ad->location }}</p>
    <p class="mt-2">{{ $ad->description }}</p>
    <p class="mt-2 font-semibold">${{ $ad->price }}</p>

    @if($ad->images->count())
        <div class="mt-4 grid grid-cols-3 gap-4">
            @foreach($ad->images as $image)
                <img src="{{ asset('storage/'.$image->path) }}" class="w-full h-32 object-cover rounded">
            @endforeach
        </div>
    @endif

    <div class="mt-4 flex gap-4">
        @auth
            <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete Ad</button>
            </form>

            <a href="{{ route('ads.edit', $ad->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit Ad</a>

            <form action="{{ route('favorites.toggle', $ad->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    {{ $isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}
                </button>
            </form>
        @endauth
    </div>
</div>
@endsection
