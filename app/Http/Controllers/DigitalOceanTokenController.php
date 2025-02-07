<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DigitalOceanTokenController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $request->user()->fill([
            'token' => Crypt::encryptString($request->token),
        ])->save();

        return redirect('/secrets');
    }

    public function decrypt()
    {
        $user = User::find(1);

        if ($user) {

            try {
                return Crypt::decryptString($user->token);
            } catch (DecryptException $e) {
                // Handle any decryption errors, like invalid token or tampered data
                return "Error decrypting token: " . $e->getMessage();
            }
        } else {
            return "User not found.";
        }
    }
}
