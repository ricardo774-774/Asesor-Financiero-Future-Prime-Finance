<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\categoriasg;
use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google OAuth page
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists with this email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // User exists, just log them in
                Auth::login($user);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(24)), // Random password since they use OAuth
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ])->assignRole('user');

                // Create default expense categories for new user
                $categorias = categoriasg::all();
                foreach ($categorias as $value) {
                    $gasto = new Gasto();
                    $gasto->userID = $user->id;
                    $gasto->categoriasID = $value->id;
                    $gasto->monto = 0;
                    $gasto->save();
                }

                Auth::login($user);
            }

            return redirect()->route('dashboard')->with('success', '¡Bienvenido a Finanzas Pro! Has iniciado sesión correctamente con Google.');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Error al iniciar sesión con Google. Por favor, inténtalo de nuevo.');
        }
    }
}
