@extends('layoutsF.master')

@section('title', 'Edit Review')

@section('styles')
<style>
    .star {
        font-size: 28px;
        cursor: pointer;
        color: #ccc;
        transition: color 0.3s ease-in-out;
    }

    .star.filled {
        color: gold;
    }

    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection

@section('content')

<section class="bg-gradient-to-r from-purple-500 to-blue-600 text-white py-16 text-center shadow-lg">
    <h1 class="text-4xl font-bold">Edit Your Review</h1>
    <p class="text-lg mt-2 opacity-80">Modify your feedback for <span class="font-semibold">{{ $review->product->name }}</span></p>
</section>

<div class="container mx-auto mt-12 px-6">
    <div class="bg-white p-8 rounded-lg shadow-lg card">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Update Your Review</h2>

        <form action="{{ route('reviews.update', $review->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Rating</label>
                <div class="flex space-x-2 mt-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $review->rating ? 'filled' : '' }}" data-value="{{ $i }}" onclick="setRating({{ $i }})">&#9733;</span>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating" value="{{ $review->rating }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Comment</label>
                <textarea name="comment" id="comment" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $review->comment }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Your Name (Optional)</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $review->name }}">
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-bold shadow-lg hover:bg-green-600 transition duration-300">
                Update Review
            </button>
        </form>
    </div>
</div>

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
