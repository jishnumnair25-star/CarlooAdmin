<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
   public function show()
{
    $token = session('access_token');

    if (!$token) {
        return redirect('/login')->with('error', 'Please log in first.');
    }

    try {
        $response = Http::withToken($token)->get('https://carlo.algorethics.ai/api/auth/profile');

        \Log::info('Dashboard API Status: ' . $response->status());
        \Log::info('Dashboard API Body: ' . $response->body());

        if ($response->successful()) {
            $profile = $response->json();
            
            return view('fasto.dashboard.index', compact('profile', 'token')); // Pass token explicitly
        } elseif ($response->status() === 401) {
            \Log::warning('Invalid token detected, clearing session.');
            session()->forget('access_token');
            return redirect('/login')->with('error', 'Your session has expired. Please log in again.');
        } else {
            \Log::error('Failed to fetch profile: HTTP ' . $response->status() . ' - ' . $response->body());
            return back()->with('error', 'Failed to fetch profile details. Please try again later.');
        }
    } catch (\Exception $e) {
        \Log::error('Exception during profile fetch: ' . $e->getMessage());
        return back()->with('error', 'An error occurred while fetching profile details.');
    }
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
// ---------------------------------------------Create Project------------------------------------------------------------------------>

public function create()
    {
        // Fetch subscriptions from API or database
        $subscriptions = [
            (object)['id' => '68808950dd13863478ed43b4', 'name' => 'Premium Subscription'],
            (object)['id' => '78808950dd13863478ed43b5', 'name' => 'Enterprise Subscription']
        ];
        
        return view('fasto.dashboard.form', compact('subscriptions'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'subscription_id' => 'required|string',
        'project_name' => 'required|string',
        'project_description' => 'required|string',
        'industry_domain' => 'required|string',
        'status' => 'required|string',
        'data_storage_location' => 'required|string',
        'technology_stack.backend' => 'required|array',
        'infrastructure.deployment_type' => 'nullable|string',
        // Add validations as needed
    ]);

    // Construct payload
    $payload = [
        'subscription_id' => $request->input('subscription_id'),
        'project_name' => $request->input('project_name'),
        'project_description' => $request->input('project_description'),
        'industry_domain' => $request->input('industry_domain'),
        'status' => $request->input('status'),
        'technology_stack' => $request->input('technology_stack'),
        'programming_languages' => $request->input('programming_languages', []),
        'infrastructure' => $request->input('infrastructure', []),
        'apis_integrations' => $request->input('apis_integrations', []),
        'data_sources' => $request->input('data_sources', []),
        'data_storage_location' => $request->input('data_storage_location'),
        'data_sensitivity' => $request->input('data_sensitivity', []),
        'data_encryption' => [
            'enabled' => $request->has('data_encryption'),
            'type' => $request->input('encryption_type'),
        ],
        'access_control' => $request->input('access_control', []),
        'audit_logging' => $request->has('audit_logging'),
        'user_consent_mechanism' => $request->has('user_consent'),
        'compliance_standards' => $request->input('compliance_standards', []),
        'bias_risk_factors' => [
            'identified' => $request->has('bias_identified'),
            'description' => $request->input('bias_risk_description'),
        ],
        'fairness_transparency_practices' => $request->has('fairness_practices'),
        'has_ai_ml' => $request->has('has_ai_ml'),
        'ai_model_type' => $request->input('ai_model_type', []),
        'training_data_source' => $request->input('training_data_source', []),
        'model_monitoring' => $request->has('model_monitoring'),
        'bias_detection' => $request->has('bias_detection'),
        'automated_decision_making' => $request->has('automated_decision_making'),
        'webhooks_notifications' => $request->has('webhooks_notifications'),
        'custom_rules' => $request->has('custom_rules'),
        'third_party_plugins' => $request->has('third_party_plugins'),
        'compliance_consultation' => $request->has('compliance_consultation'),
    ];

    // Make API Request
    $response = Http::post('https://carlo.algorethics.ai/api/project/create', $payload);

    if ($response->successful()) {
        return redirect()->route('projects.index')->with('success', 'Project created successfully via API!');
    } else {
        return back()->withErrors(['api_error' => $response->body()]);
    }
}


// -----------------------------------------End Project----------------------------------------------------------------->


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









public function edit($id)
{
    $token = session('access_token');

    if (!$token) {
        return redirect()->route('login')->with('error', 'Please log in first.');
    }

    // Fetch the specific project by ID
    $response = Http::withToken($token)->get("https://carlo.algorethics.ai/api/project/{$id}");

    if ($response->successful()) {
        $project = $response->json();
        
        // Fetch subscriptions for the form
        $subscriptionResponse = Http::withToken($token)->get('https://carlo.algorethics.ai/api/subscription');
        $subscriptions = collect([]);
        
        if ($subscriptionResponse->successful()) {
            $data = collect($subscriptionResponse->json('data', []));
            $subscriptions = $data->map(function ($item) {
                return $item['subscription'];
            });
        }

        return view('fasto.dashboard.edit_project', compact('project', 'subscriptions'));
    }

    return back()->with('error', 'Failed to fetch project details.');
}




public function editproject(Request $request, $id)
{
    // Log the incoming request data for debugging
    \Log::info('Project update request data:', $request->all());

    $validated = $request->validate([
        'subscription_id' => 'required|string',
        'project_name' => 'required|string',
        'project_description' => 'required|string',
        'industry_domain' => 'required|string',
        'status' => 'required|string',
        'data_storage_location' => 'required|string',
    ]);

    // Parse JSON fields that were sent as strings
    $technologyStack = [];
    if ($request->has('technology_stack')) {
        $technologyStack = is_string($request->input('technology_stack')) 
            ? json_decode($request->input('technology_stack'), true) 
            : $request->input('technology_stack');
    }

    $infrastructure = [];
    if ($request->has('infrastructure')) {
        $infrastructure = is_string($request->input('infrastructure')) 
            ? json_decode($request->input('infrastructure'), true) 
            : $request->input('infrastructure');
    }

    $dataSources = [];
    if ($request->has('data_sources')) {
        $dataSources = is_string($request->input('data_sources')) 
            ? json_decode($request->input('data_sources'), true) 
            : $request->input('data_sources');
    } else {
        // Build data_sources from individual fields
        $dataSources = [
            'structure_type' => $request->input('data_sources_structure_type') ? [$request->input('data_sources_structure_type')] : [],
            'access_type' => $request->input('data_sources_access_type', []),
            'processing_type' => $request->input('data_sources_processing_type', [])
        ];
    }

    $dataEncryption = [];
    if ($request->has('data_encryption')) {
        $dataEncryption = is_string($request->input('data_encryption')) 
            ? json_decode($request->input('data_encryption'), true) 
            : $request->input('data_encryption');
    }

    $biasRiskFactors = [];
    if ($request->has('bias_risk_factors')) {
        $biasRiskFactors = is_string($request->input('bias_risk_factors'))
            ? json_decode($request->input('bias_risk_factors'), true)
            : $request->input('bias_risk_factors');
    } else {
        // Build bias_risk_factors from individual fields
        $biasIdentified = $request->has('bias_identified');
        $biasDescription = $request->input('bias_risk_description', '');
        
        // Ensure description is provided when bias is identified
        if ($biasIdentified && empty($biasDescription)) {
            $biasDescription = "Bias risk factors identified";
        }
        
        $biasRiskFactors = [
            'identified' => $biasIdentified,
            'description' => $biasDescription
        ];
    }

    // Construct payload
    $payload = [
        'subscription_id' => $request->input('subscription_id'),
        'project_name' => $request->input('project_name'),
        'project_description' => $request->input('project_description'),
        'industry_domain' => $request->input('industry_domain'),
        'status' => $request->input('status'),
        'technology_stack' => $technologyStack,
        'programming_languages' => is_array($request->input('programming_languages')) ? $request->input('programming_languages') : [],
        'infrastructure' => $infrastructure,
        'apis_integrations' => is_array($request->input('apis_integrations')) ? $request->input('apis_integrations') : [],
        'data_sources' => $dataSources,
        'data_storage_location' => $request->input('data_storage_location'),
        'data_sensitivity' => is_array($request->input('data_sensitivity')) ? $request->input('data_sensitivity') : [],
        'data_encryption' => $dataEncryption,
        'access_control' => is_array($request->input('access_control')) ? $request->input('access_control') : [],
        'audit_logging' => $request->has('audit_logging'),
        'user_consent_mechanism' => $request->has('user_consent'),
        'compliance_standards' => is_array($request->input('compliance_standards')) ? $request->input('compliance_standards') : [],
        'bias_risk_factors' => $biasRiskFactors,
        'fairness_transparency_practices' => $request->has('fairness_practices'),
        'has_ai_ml' => $request->has('has_ai_ml'),
        'ai_model_type' => is_array($request->input('ai_model_type')) ? $request->input('ai_model_type') : [],
        'training_data_source' => is_array($request->input('training_data_source')) ? $request->input('training_data_source') : [],
        'model_monitoring' => $request->has('model_monitoring'),
        'bias_detection' => $request->has('bias_detection'),
        'automated_decision_making' => $request->has('automated_decision_making'),
        'webhooks_notifications' => $request->has('webhooks_notifications'),
        'custom_rules' => $request->has('custom_rules'),
        'third_party_plugins' => $request->has('third_party_plugins'),
        'compliance_consultation' => $request->has('compliance_consultation'),
    ];

    // Log the constructed payload for debugging
    \Log::info('Constructed payload for API update:', $payload);

    // Get the token from session
    $token = session('access_token');

    if (!$token) {
        return response()->json(['success' => false, 'message' => 'Authentication token missing'], 401);
    }

    // Make API Request to update the project
    $response = Http::withToken($token)->put("https://carlo.algorethics.ai/api/project/{$id}", $payload);

    // Log the API response for debugging
    \Log::info('API Update Response Status:', ['status' => $response->status()]);
    \Log::info('API Update Response Body:', ['body' => $response->body()]);

    if ($response->successful()) {
        return response()->json(['success' => true, 'message' => 'Project updated successfully!']);
    } else {
        return response()->json([
            'success' => false, 
            'message' => 'Failed to update project: ' . $response->body()
        ], $response->status());
    }
}
