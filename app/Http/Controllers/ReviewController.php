<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('user', 'produk')
            ->latest()
            ->paginate(10);
            
        return view('review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Produk $produk)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'nullable|string|max:500'
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'produk_id' => $produk->id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $this->authorize('update', $review);
        return view('review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'nullable|string|max:500'
        ]);

        $review->update($request->only('rating', 'komentar'));

        return redirect()->route('produk.show', $review->produk_id)->with('success', 'Ulasan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();

        return redirect()->back()
            ->with('success', 'Ulasan berhasil dihapus');
    }
}
