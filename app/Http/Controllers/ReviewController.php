<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reviews = Review::with(['user', 'produk'])
            ->latest()
            ->paginate(10);
        return view('review.index', compact('reviews'));
    }

    public function create(Pemesanan $pemesanan)
    {
        if ($pemesanan->status !== 'completed') {
            return back()->with('error', 'Anda hanya dapat memberikan ulasan untuk pemesanan yang telah selesai');
        }

        if ($pemesanan->review()->exists()) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk pemesanan ini');
        }

        return view('review.create', compact('pemesanan'));
    }

    public function store(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('reviews', 'public');
        }

        Review::create([
            'user_id' => auth()->id(),
            'produk_id' => $pemesanan->produk_id,
            'pemesanan_id' => $pemesanan->id,
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar'],
            'foto' => $foto
        ]);

        return redirect()->route('pemesanan.show', $pemesanan)
            ->with('success', 'Terima kasih atas ulasan Anda');
    }

    public function show(Review $review)
    {
        return view('review.show', compact('review'));
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        if ($review->foto) {
            Storage::disk('public')->delete($review->foto);
        }
        
        $review->delete();
        return redirect()->route('review.index')
            ->with('success', 'Ulasan berhasil dihapus');
    }
}
