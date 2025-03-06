<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = $product->reviews()->latest()->get();
        return view("products.show", compact("product", "reviews"));
    }


    public function storeReview(Request $request, $productId)
    {

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'name' => 'nullable|string|max:255'
        ]);

        $product = Product::findOrFail($productId);

        $review = new Review();
        $review->user_id = auth()->check() ? auth()->id() : null;
        $review->product_id = $product->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->name = $request->name ?? 'Anonymous';
        $review->save();

        return redirect()->route('products.show', $product->id)->with('success', 'Review added successfully!');
    }
    public function edit($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== auth()->id()) {
            return redirect()->route('products.show', $review->product_id)->with('error', 'You are not authorized to edit this review.');
        }

        return view('products.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== auth()->id()) {
            return redirect()->route('products.show', $review->product_id)->with('error', 'You are not authorized to update this review.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'name' => 'nullable|string|max:255'
        ]);

        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->name = $request->name ?? 'Anonymous';
        $review->save();

        return redirect()->route('products.show', $review->product_id)->with('success', 'Review updated successfully!');
    }

        public function showStatusForm(Product $product)
        {
            return view('products.statusedite', compact('product'));
        }

        public function updateStatus(Request $request, Product $product)
        {
            $request->validate([
                'status' => 'required|in:active,inactive',
            ]);

            $product->status = $request->status;
            $product->save();

            return redirect()->route('products.status.show', $product->id);
        }

        public function showStatus(Product $product)
        {
        $products = Product::all();

            return view('home', compact('products'));
        }

        public function shop()
        {
            $products = Product::all();
            return view('shop', compact('products'));
        }

}
