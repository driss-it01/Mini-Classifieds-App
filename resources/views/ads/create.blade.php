@extends('layouts.app')

@section('header', 'Create New Ad')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-full border rounded p-2">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Category</label>
            <select name="category_id" class="mt-1 block w-full border rounded p-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Description</label>
            <textarea name="description" rows="4" class="mt-1 block w-full border rounded p-2">{{ old('description') }}</textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Price</label>
            <input type="number" name="price" value="{{ old('price') }}" class="mt-1 block w-full border rounded p-2">
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" class="mt-1 block w-full border rounded p-2">
            @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Images</label>
            <input type="file" name="images[]" multiple class="mt-1 block w-full">
            @error('images') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Ad</button>
    </form>
</div>
@endsection
