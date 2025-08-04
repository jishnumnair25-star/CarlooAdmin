<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProfileController extends Controller
{
    
public function fetchCompleteProfile()
{
    $accessToken = session('access_token'); // or however you stored it

    if (!$accessToken) {
        return redirect('/index')->with('error', 'Access token missing. Please login.');
    }

    $response = Http::withToken($accessToken)->get('https://carlo.algorethics.ai/api/auth/complete-profile');

    if ($response->successful()) {
        $data = $response->json();

        // Pass data to a view
        return view('profile.complete', ['profile' => $data]);
    } else {
        return redirect()->back()->with('error', 'Failed to fetch profile data.');
    }
}

}

