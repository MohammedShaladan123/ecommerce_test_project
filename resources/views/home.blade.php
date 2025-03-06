@extends('layoutsF.master')

@section('title', 'Home')

@section('styles')
<style>
    .star {
        color: #ddd;
        font-size: 1.5rem;
    }

    .star.filled {
        color: #f39c12;
    }
</style>
@endsection

@section('content')

<section class="bg-cover bg-center h-96 flex items-center justify-center text-white text-center" style="background-image: url('https://source.unsplash.com/1600x900/?shopping');">
    <div class="bg-black bg-opacity-50 p-8 rounded-lg">
        <h1 class="text-5xl font-bold">Welcome My Store</h1>
        <p class="text-lg mt-2">Find the best products at unbeatable prices!</p>
        <a href="{{ route('shop') }}" class="mt-4 inline-block bg-yellow-500 text-white py-3 px-6 rounded-full text-lg shadow-lg hover:bg-yellow-600">Shop Now</a>
    </div>
</section>

<div id="products" class="container mx-auto mt-12 px-6">
    <h2 class="text-4xl font-extrabold text-center mb-8 text-gray-800">🔥 Featured Products 🔥</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">{{ $product->name }}</h3>
                <p class="text-gray-600 mt-2">{{ $product->description }}</p>

                <!-- السعر -->
                <p class="mt-4 text-2xl font-semibold text-blue-600">${{ number_format($product->price, 2) }}</p>
                <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>

                <!-- نظام التقييم -->
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

                <a href="{{ route('products.show', $product->id) }}"
                    class="block mt-6 text-center bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-bold text-lg shadow-lg hover:from-blue-600 hover:to-purple-700 transition duration-300">
                    View Details
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
