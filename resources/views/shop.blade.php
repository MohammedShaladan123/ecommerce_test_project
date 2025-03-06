@extends('layoutsF.master')

@section('title', 'Shop')

@section('styles')
<style>
    .product-card:hover {
        transform: scale(1.05);
        transition: all 0.3s ease-in-out;
    }
</style>
@endsection

@section('content')

<div class="container mx-auto px-6 mt-8">
    <h1 class="text-5xl font-extrabold text-center text-gray-800">🛍️ Shop Our Products</h1>

    <div class="flex justify-center mt-6">
        <input type="text" placeholder="Search for products..." class="w-full md:w-1/2 px-4 py-3 border rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>



<div class="container mx-auto mt-10 px-6">
    <h2 class="text-4xl font-extrabold text-center mb-8 text-gray-800">🛍️ Browse Our Collection</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden product-card">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">{{ $product->name }}</h3>
                <p class="text-gray-600 mt-2">{{ $product->description }}</p>

                <p class="mt-4 text-2xl font-semibold text-blue-600">${{ number_format($product->price, 2) }}</p>
                <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>

                <div class="flex items-center mt-3">
                    @php
                    $averageRating = $product->reviews()->avg('rating') ?? 0;
                    $totalStars = 5;
                    @endphp
                    @for ($i = 1; $i <= $totalStars; $i++)
                        <span class="text-yellow-400 text-2xl">{{ $i <= $averageRating ? '★' : '☆' }}</span>
                    @endfor
                    <span class="ml-2 text-sm text-gray-600">({{ number_format($averageRating, 1) }})</span>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('products.show', $product->id) }}"
                        class="block text-center bg-gradient-to-r from-green-500 to-teal-600 text-white py-3 px-6 rounded-lg font-bold shadow-lg hover:from-green-600 hover:to-teal-700 transition duration-300">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
