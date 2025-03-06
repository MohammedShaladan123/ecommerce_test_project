@extends('layoutsF.master')

@section('title', 'Change Product Status')

@section('styles')
<style>
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
    <div class="bg-white p-8 rounded-lg shadow-lg card w-full md:w-2/3 lg:w-1/3 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Change Status for</h2>
        <p class="text-xl font-semibold text-blue-600 mt-1">{{ $product->name }}</p>

        <form action="{{ route('products.status.update', $product->id) }}" method="POST" class="mt-6">
            @csrf

            <div class="mb-6">
                <label for="status" class="block text-lg font-semibold text-gray-700 mb-2">Select Status:</label>
                <select name="status" id="status"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="out_of_stock" {{ $product->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>

            <button type="submit"
                class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-bold shadow-lg hover:bg-green-600 transition duration-300">
                Update Status
            </button>
        </form>


    </div>
</div>

@endsection
