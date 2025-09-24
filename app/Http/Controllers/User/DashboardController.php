<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserSetting;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recentOrders = $user->orders()->latest()->take(5)->get();
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->where('status', 'completed')->sum('total_price');

        return view('user.dashboard', compact('user', 'recentOrders', 'totalOrders', 'totalSpent'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        
        // Verify current password if trying to change password
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }
        }
        
        // Update user data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $user->update($data);
        
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
    
    public function settings()
    {
        $user = auth()->user();
        $settings = $user->settings ?? new UserSetting([
            'theme' => 'light',
            'language' => 'id',
            'currency' => 'IDR',
            'timezone' => 'Asia/Jakarta',
            'marketing_emails' => true,
            'order_notifications' => true,
            'security_alerts' => true,
        ]);
        
        return view('user.settings', compact('user', 'settings'));
    }
    
    public function updateSettings(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'theme' => ['required', 'in:light,dark'],
            'language' => ['required', 'in:id,en'],
            'currency' => ['required', 'in:IDR,USD'],
            'timezone' => ['required', 'string'],
            'marketing_emails' => ['boolean'],
            'order_notifications' => ['boolean'],
            'security_alerts' => ['boolean'],
            'email_on_order' => ['boolean'],
            'email_on_promotion' => ['boolean'],
            'sms_notifications' => ['boolean'],
            'two_factor_enabled' => ['boolean'],
            'profile_visibility' => ['required', 'in:public,private,friends'],
            'show_online_status' => ['boolean'],
            'allow_friend_requests' => ['boolean'],
        ]);
        
        $notificationPreferences = [
            'email_on_order' => $request->boolean('email_on_order'),
            'email_on_promotion' => $request->boolean('email_on_promotion'),
            'sms_notifications' => $request->boolean('sms_notifications'),
        ];
        
        $privacySettings = [
            'two_factor_enabled' => $request->boolean('two_factor_enabled'),
            'profile_visibility' => $request->profile_visibility,
            'show_online_status' => $request->boolean('show_online_status'),
            'allow_friend_requests' => $request->boolean('allow_friend_requests'),
        ];
        
        $user->settings()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'theme' => $request->theme,
                'language' => $request->language,
                'currency' => $request->currency,
                'timezone' => $request->timezone,
                'marketing_emails' => $request->boolean('marketing_emails'),
                'order_notifications' => $request->boolean('order_notifications'),
                'security_alerts' => $request->boolean('security_alerts'),
                'notification_preferences' => $notificationPreferences,
                'privacy_settings' => $privacySettings,
            ]
        );
        
        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
    
    public function paymentMethods()
    {
        $user = auth()->user();
        $paymentMethods = $user->paymentMethods()->orderBy('is_primary', 'desc')->get();
        
        return view('user.payment-methods', compact('user', 'paymentMethods'));
    }
    
    public function storePaymentMethod(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'type' => ['required', 'in:bank_transfer,e_wallet,credit_card'],
            'provider' => ['required', 'string', 'max:50'],
            'account_name' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:50'],
        ]);
        
        // If this is set as primary, make others non-primary
        if ($request->boolean('is_primary')) {
            $user->paymentMethods()->update(['is_primary' => false]);
        }
        
        $user->paymentMethods()->create([
            'type' => $request->type,
            'provider' => $request->provider,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'is_primary' => $request->boolean('is_primary') || $user->paymentMethods()->count() === 0,
            'is_verified' => false, // Admin needs to verify
        ]);
        
        return back()->with('success', 'Metode pembayaran berhasil ditambahkan!');
    }
    
    public function deletePaymentMethod($id)
    {
        $user = auth()->user();
        $paymentMethod = $user->paymentMethods()->findOrFail($id);
        
        // Don't allow deletion of primary payment method if there are others
        if ($paymentMethod->is_primary && $user->paymentMethods()->count() > 1) {
            return back()->with('error', 'Tidak dapat menghapus metode pembayaran utama. Pilih metode lain sebagai utama terlebih dahulu.');
        }
        
        $paymentMethod->delete();
        
        // If deleted method was primary and there are other methods, make the first one primary
        if ($paymentMethod->is_primary) {
            $user->paymentMethods()->first()?->update(['is_primary' => true]);
        }
        
        return back()->with('success', 'Metode pembayaran berhasil dihapus!');
    }
}
