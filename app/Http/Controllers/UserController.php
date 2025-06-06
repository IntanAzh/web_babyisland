<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
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
            'total_orders' => $user->orders()->count(),
            'active_orders' => $user->orders()
                ->whereIn('status', ['process', 'sent', 'delivered'])
                ->count(),
            'completed_orders' => $user->orders()
                ->where('status', 'complete')
                ->count()
        ];

        $recent_orders = $user->orders()
            ->with(['product'])
            ->latest()
            ->paginate(5);

        $title = 'My Dashboard';

        return view('user.dashboard', compact('stats', 'recent_orders', 'title'));
    }

    public function profile()
    {
        return view('user.profile', ['user' => auth()->user(), 'title' => 'My Profile']);
    }

    public function editProfile()
    {
        return view('user.edit', ['user' => auth()->user(), 'title' => 'Edit Profile']);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phonenumber' => 'required|string|max:15',
        ]);

        $user->update($validated);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
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

    public function cancelOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        // Verify that the order belongs to the authenticated user
        if ($order->user_id != auth()->id()) {
            return redirect()->route('user.dashboard')
                ->with('error', 'You do not have permission to cancel this order.');
        }
        
        // Check if the order can be cancelled (only processing status)
        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->route('user.dashboard')
                ->with('error', 'This order cannot be cancelled at its current status.');
        }
        
        // Update the order status to cancelled
        $order->status = 'cancel';
        $order->save();
        
        // If there's an associated transaction, mark it as cancelled too
        if ($order->transaction) {
            $order->transaction->status = 'rejected';
            $order->transaction->save();
        }
        
        return redirect()->route('user.dashboard')
            ->with('success', 'Order has been successfully cancelled.');
    }
}
