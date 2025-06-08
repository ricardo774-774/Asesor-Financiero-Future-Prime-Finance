<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();

        // Check if user has 2FA enabled
        if ($user && $user->google2fa_enabled) {
            // Logout the user temporarily
            Auth::logout();
            
            // Store user ID in session for 2FA verification
            session(['2fa_user_id' => $user->id]);
            
            // Redirect to 2FA verification
            return redirect()->route('two-factor.verify');
        }

        $request->session()->regenerate();

        if ($user) {
            $roles = $user->getRoleNames();
            // Redireccionar según el rol del usuario
            if ($roles->contains('admin')) {
                return redirect()->intended(route('admin.index',absolute:false));
            } elseif ($roles->contains('user')) {
                return redirect()->intended(route('dashboard', absolute:false));
            }
        }

        // Default fallback
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
