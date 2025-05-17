<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = auth()->user();
        $stats = [
            'total_pemesanan' => $user->pemesanan()->count(),
            'pemesanan_aktif' => $user->pemesanan()
                ->whereIn('status', ['processing', 'shipped'])
                ->count(),
            'total_reviews' => $user->reviews()->count()
        ];
        
        $pemesanan_terbaru = $user->pemesanan()
            ->with(['produk', 'transaksi'])
            ->latest()
            ->limit(5)
            ->get();

        return view('user.dashboard', compact('stats', 'pemesanan_terbaru'));
    }

    public function profile()
    {
        return view('user.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'no_hp' => 'required|string|max:15',
            'alamat' => 'nullable|string'
        ]);

        $user->update($validated);
        
        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password berhasil diperbarui');
    }

    public function pemesanan()
    {
        $pemesanan = auth()->user()->pemesanan()
            ->with(['produk', 'transaksi'])
            ->latest()
            ->paginate(10);
            
        return view('user.pemesanan', compact('pemesanan'));
    }

    public function reviews()
    {
        $reviews = auth()->user()->reviews()
            ->with('produk')
            ->latest()
            ->paginate(10);
            
        return view('user.reviews', compact('reviews'));
    }
}
