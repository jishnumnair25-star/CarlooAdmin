<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{public function show()
{
    $token = session('access_token');

    if (!$token) {
        return redirect('/login')->with('error', 'Please log in first.');
    }

    $response = Http::withToken($token)->get('https://carlo.algorethics.ai/api/auth/profile');

    \Log::info('Dashboard API Status: ' . $response->status());
    \Log::info('Dashboard API Body: ' . $response->body());

    if ($response->successful()) {
        $profile = $response->json();
        return view('fasto.dashboard.index', compact('profile'));
    }

    return back()->with('error', 'Failed to fetch profile details.');
}
// public function projects(){
//         $page_title = 'Projects';
//         $page_description = 'Some description for the page';
//         return view('fasto.dashboard.projects', compact('page_title', 'page_description'));
//     }






    // public function ui_card(){
    //     $page_title = 'Card';
    //     $page_description = 'Some description for the page';
    //     return view('fasto.ui.card', compact('page_title', 'page_description'));
    // }

public function ui_card()
{
    $response = Http::get('https://carlo.algorethics.ai/api/pricing');

    if ($response->successful()) {
        $plans = $response->json()['data'];
        return view('fasto.ui.card', compact('plans'));
    }

    return back()->with('error', 'Failed to load pricing plans.');
}

public function projects()
{
    $token = session('access_token');

    if (!$token) {
        return redirect()->route('login')->with('error', 'Please log in');
    }

    $response = Http::withToken($token)->get('https://carlo.algorethics.ai/api/project/my-projects');

    $projects = $response->json()['data'] ?? [];

    $statusCounts = collect($projects)->groupBy(function ($project) {
        return strtolower($project['status'] ?? 'unknown');
    })->map->count();

    // Add "all" count manually
    $statusCounts['all'] = count($projects);

    return view('fasto.dashboard.projects', [
        'projects' => $projects,
        'statusCounts' => $statusCounts,
    ]);
}

 public function view($id)
    {
        $token = session('access_token');
        $response = Http::withToken($token)->get("https://carlo.algorethics.ai/api/project/my-projects");

        $projects = $response->json();

        if (isset($projects['data']) && is_array($projects['data'])) {
            $project = collect($projects['data'])->firstWhere('subscription_id', $id);

            if ($project) {
                return view('fasto.dashboard.project_view', compact('project'));
            }
        }

        return redirect()->back()->with('error', 'Project not found.');
    }





    public function createProject(Request $request)
    {
        // Validate required fields first
        $request->validate([
            'subscription_id' => 'required|string',
            'project_name' => 'required|string',
            'project_description' => 'required|string',
            'industry_domain' => 'required|string',
            'status' => 'required|string'
        ]);

        // Prepare the data for API
        $data = [
            "subscription_id" => $request->subscription_id,
            "project_name" => $request->project_name,
            "project_description" => $request->project_description,
            "industry_domain" => $request->industry_domain,
            "technology_stack" => [
                "backend" => explode(',', $request->backend),
                "frontend" => explode(',', $request->frontend),
                "database" => explode(',', $request->database),
                "ai_models" => explode(',', $request->ai_models),
                "apis" => explode(',', $request->apis)
            ],
            "programming_languages" => explode(',', $request->programming_languages),
            "infrastructure" => [
                "deployment_type" => $request->deployment_type,
                "cloud_provider" => explode(',', $request->cloud_provider),
                "containerization" => explode(',', $request->containerization)
            ],
            "apis_integrations" => explode(',', $request->apis_integrations),
            "data_sources" => [
                "structure_type" => explode(',', $request->structure_type),
                "access_type" => explode(',', $request->access_type),
                "processing_type" => explode(',', $request->processing_type)
            ],
            "data_storage_location" => $request->data_storage_location,
            "data_sensitivity" => explode(',', $request->data_sensitivity),
            "data_encryption" => [
                "enabled" => $request->has('data_encryption'),
                "type" => "AES-256"
            ],
            "access_control" => explode(',', $request->access_control),
            "audit_logging" => $request->has('audit_logging'),
            "user_consent_mechanism" => $request->has('user_consent_mechanism'),
            "compliance_standards" => explode(',', $request->compliance_standards),
            "bias_risk_factors" => [
                "identified" => $request->has('bias_risk_factors'),
                "description" => "Potential for demographic bias"
            ],
            "fairness_transparency_practices" => $request->has('fairness_transparency_practices'),
            "has_ai_ml" => $request->has('has_ai_ml'),
            "webhooks_notifications" => $request->has('webhooks_notifications'),
            "custom_rules" => $request->has('custom_rules'),
            "third_party_plugins" => $request->has('third_party_plugins'),
            "compliance_consultation" => $request->has('compliance_consultation'),
            "status" => $request->status
        ];

        // Get the token from session
        $token = session('access_token');

        // Make API call
        $response = Http::withToken($token)
            ->post('https://carlo.algorethics.ai/api/project/create', $data);

        if ($response->successful()) {
            return back()->with('success', 'Project created successfully!');
        } else {
            return back()->with('error', 'API Error: ' . $response->json('message'));
        }
    }

// app/Http/Controllers/DashboardController.php
public function Subscription(Request $request)
{
    $response = Http::withToken(session('access_token'))
        ->get('https://carlo.algorethics.ai/api/subscription');

    if (! $response->successful()) {
        abort(500, 'Failed to fetch subscriptions.');
    }

    $data = collect($response->json('data', []));

    // Filter logic
    $search = $request->input('search');
    $status = $request->input('status');
    $plan = $request->input('plan');

    $filtered = $data->filter(function ($item) use ($search, $status, $plan) {
        $subscription = $item['subscription'];

        $matchSearch = !$search || str_contains(strtolower($subscription['user_username']), strtolower($search)) || str_contains(strtolower($subscription['pricing_tier']), strtolower($search));
        $matchStatus = !$status || strtolower($subscription['status']) === strtolower($status);
        $matchPlan = !$plan || strtolower($subscription['pricing_tier']) === strtolower($plan);

        return $matchSearch && $matchStatus && $matchPlan;
    });

    return view('fasto.table.bootstrap_basic', [
        'subscriptions' => $filtered
    ]);
}


 public function ui_alert(){
        $page_title = 'Alert';
        $page_description = 'Some description for the page';
        return view('fasto.ui.alert', compact('page_title', 'page_description'));
    }

    public function table_datatable_basic(){
        $page_title = 'Table Datatable';
        $page_description = 'Some description for the page';
        return view('fasto.table.databasic', compact('page_title', 'page_description'));
    }
	

}





