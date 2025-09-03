@extends('layouts.app')

@section('header', 'Categories')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-lg font-bold text-gray-800">{{ $category->name }}</h2>
                <p class="text-gray-600 mt-1">{{ $category->ads_count ?? 0 }} Ads</p>
            </div>
        @endforeach
    </div>
@endsection
