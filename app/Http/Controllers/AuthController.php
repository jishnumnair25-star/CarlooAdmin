<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        // Send request to external API
        $response = Http::post('https://carlo.algorethics.ai/api/auth/login', [
            'username' => $request->username,
            'password' => $request->password
        ]);

        // Log response for debugging
        \Log::info('Login API response', $response->json());

        // If successful, store session and redirect
        if ($response->successful() && isset($response['accessToken'])) {
            $data = $response->json();

            session([
                'access_token' => $data['accessToken'],
                'refresh_token' => $data['refreshToken'],
                'user_id' => $data['id'],
                'username' => $data['username'],
                'profile_completed' => $data['profile_completed']
            ]);

            return redirect()->route('dashboard.index');
        }

        // On failure
        return back()->with('error', 'Invalid login credentials.');
    }
}