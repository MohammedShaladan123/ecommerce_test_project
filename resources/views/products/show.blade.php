@extends('layoutsF.master')

@section('title', $product->name)

@section('styles')
<style>
    .star {
        font-size: 24px;
        cursor: pointer;
        color: #ccc;
    }

    .star.filled {
        color: gold;
    }

    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection

@section('content')

<div class="flex justify-center mt-12">
    <div class="bg-white p-8 rounded-lg shadow-lg card w-full md:w-2/3 lg:w-1/2 text-center">
        <h2 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h2>
        <p class="mt-4 text-2xl font-semibold text-blue-600">${{ number_format($product->price, 2) }}</p>
        <p class="text-gray-500 mt-1">Stock: {{ $product->stock }}</p>
        <p class="text-gray-600 mt-4 leading-relaxed">{{ $product->description }}</p>
        <p class="mt-4"><strong>Current Status:</strong> <span class="text-green-500">{{ $product->status }}</span></p>

        @if($product->status_updated_at)
        <p class="text-sm text-gray-500"><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($product->status_updated_at)->format('d M Y, h:i A') }}</p>
        @endif

        <a href="{{ route('shop') }}"
            class="block mt-6 text-center bg-gradient-to-r from-green-500 to-teal-600 text-white py-3 px-6 rounded-lg font-bold shadow-lg hover:from-green-600 hover:to-teal-700 transition duration-300">
            Back to Shop
        </a>
    </div>
</div>

<div class="container mx-auto mt-12 px-6 text-center">
    <h3 class="text-3xl font-bold text-gray-800">Customer Reviews</h3>
    <div class="mt-6 space-y-6 flex flex-col items-center">
        @foreach ($reviews as $review)
        <div class="bg-white p-6 rounded-lg shadow-lg card w-full md:w-2/3 lg:w-1/2 text-center">
            <div class="flex justify-center mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">&#9733;</span>
                @endfor
            </div>
            <p class="font-semibold text-gray-800">{{ $review->name }}</p>
            <p class="text-gray-600">{{ $review->comment }}</p>

            @if (auth()->check() && auth()->id() == $review->user_id)
            <a href="{{ route('reviews.edit', $review->id) }}"
                class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300">
                Edit Review
            </a>
            @endif
        </div>
        @endforeach
    </div>
</div>

@if (auth()->check() && !$product->reviews->contains('user_id', auth()->id()))
<div class="flex justify-center mt-12">
    <div class="bg-white p-6 rounded-lg shadow-lg card w-full md:w-2/3 lg:w-1/2 text-center">
        <h3 class="text-3xl font-bold text-gray-800">Add a Review</h3>
        <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Rating</label>
                <div class="flex justify-center space-x-2 mt-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star" data-value="{{ $i }}" onclick="setRating({{ $i }})">&#9733;</span>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating" value="0">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Comment</label>
                <textarea name="comment" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Your Name (Optional)</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ auth()->user()->name ?? '' }}">
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-bold shadow-lg hover:bg-green-600 transition duration-300">
                Submit Review
            </button>
        </form>
    </div>
</div>
@else
<p class="mt-6 text-gray-600 text-center">You have already reviewed this product.</p>
@endif

<script>
    function setRating(starValue) {
        document.getElementById('rating').value = starValue;
        var stars = document.querySelectorAll('.star');
        stars.forEach(function(star, index) {
            if (index < starValue) {
                star.classList.add('filled');
            } else {
                star.classList.remove('filled');
            }
        });
    }
</script>

@endsection
