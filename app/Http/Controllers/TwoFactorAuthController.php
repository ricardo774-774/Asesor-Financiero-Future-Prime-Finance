<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class TwoFactorAuthController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Show 2FA setup page
     */
    public function show()
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Generate secret if not exists
        if (!$user->google2fa_secret) {
            $secret = $this->google2fa->generateSecretKey();
            $user->google2fa_secret = encrypt($secret);
            $user->save();
        } else {
            $secret = decrypt($user->google2fa_secret);
        }

        // Generate QR Code URL (we'll use a simple inline SVG or external service)
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        // For simplicity, we'll use Google Charts API to generate QR code
        $qrCodeImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($qrCodeUrl);

        return view('auth.two-factor', [
            'qrCodeImageUrl' => $qrCodeImageUrl,
            'secret' => $secret,
            'is_enabled' => $user->google2fa_enabled
        ]);
    }

    /**
     * Enable 2FA after verification
     */
    public function enable(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|digits:6'
        ]);

        /** @var User $user */
        $user = Auth::user();
        $secret = decrypt($user->google2fa_secret);

        $valid = $this->google2fa->verifyKey($secret, $request->verification_code);

        if ($valid) {
            $user->google2fa_enabled = true;
            $user->google2fa_verified_at = now();
            $user->save();

            return redirect()->route('two-factor.show')->with('success', '¡Autenticación de dos factores habilitada exitosamente!');
        }

        return back()->withErrors(['verification_code' => 'Código de verificación inválido.']);
    }

    /**
     * Disable 2FA
     */
    public function disable(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|digits:6'
        ]);

        /** @var User $user */
        $user = Auth::user();
        $secret = decrypt($user->google2fa_secret);

        $valid = $this->google2fa->verifyKey($secret, $request->verification_code);

        if ($valid) {
            $user->google2fa_enabled = false;
            $user->google2fa_secret = null;
            $user->google2fa_verified_at = null;
            $user->save();

            return redirect()->route('two-factor.show')->with('success', 'Autenticación de dos factores deshabilitada.');
        }

        return back()->withErrors(['verification_code' => 'Código de verificación inválido.']);
    }

    /**
     * Show 2FA verification form during login
     */
    public function verify()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-verify');
    }

    /**
     * Verify 2FA code during login
     */
    public function validateTwoFactor(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|digits:6'
        ]);

        $userId = session('2fa_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Sesión expirada.']);
        }

        $secret = decrypt($user->google2fa_secret);
        $valid = $this->google2fa->verifyKey($secret, $request->verification_code);

        if ($valid) {
            session()->forget('2fa_user_id');
            Auth::login($user);
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['verification_code' => 'Código de verificación inválido.']);
    }
}
