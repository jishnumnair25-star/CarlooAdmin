<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    // Step 1: Show form (multi-step handled in Blade)
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Step 2: Register user with API
    public function register(Request $request)
    {
        $response = Http::post('https://carlo.algorethics.ai/api/auth/register', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($response->failed()) {
            return back()->withErrors(['msg' => 'Registration failed']);
        }

        // Save token in session
        $data = $response->json();
        session(['auth_token' => $data['token'] ?? null]);

        return response()->json(['success' => true, 'message' => 'Registered successfully']);
    }

    // Step 3: Complete Profile
    public function completeProfile(Request $request)
    {
        $token = session('auth_token');

        $response = Http::withToken($token)->post('https://carlo.algorethics.ai/api/auth/complete-profile', [
            'company_info' => [
                'company_name'   => $request->company_name,
                'industry'       => $request->industry,
                'website'        => $request->website,
                'company_size'   => $request->company_size,
                'country'        => $request->country,
            ],
            'project_details' => [
                'primary_use_case'      => $request->primary_use_case,
                'number_of_projects'    => (int) $request->number_of_projects,
                'compliance_frameworks' => explode(',', $request->compliance_frameworks),
            ],
            'subscription_details' => [
                'subscription_plan'  => $request->subscription_plan,
                'billing_frequency'  => $request->billing_frequency,
                'promo_code'         => $request->promo_code,
            ],
            'additional_features' => [
                'team_members'  => $request->team_members ? explode(',', $request->team_members) : [],
                'referral_code' => $request->referral_code,
                'refer'         => $request->refer,
            ],
            'developer_preferences' => [
                'preferred_language' => $request->preferred_language,
                'tools_integrations' => $request->tools_integrations ? explode(',', $request->tools_integrations) : [],
            ],
        ]);

        if ($response->failed()) {
            return back()->withErrors(['msg' => 'Profile completion failed']);
        }

        return redirect()->route('dashboard')->with('success', 'Profile completed successfully!');
    }
}
