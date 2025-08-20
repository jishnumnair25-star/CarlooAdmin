<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Helper: If response is 401, clear session and redirect to login.
     * Returns null if not 401, otherwise a redirect response.
     */
    protected function handleTokenExpiry($response)
    {
        if ($response && method_exists($response, 'status') && $response->status() === 401) {
            session()->forget('access_token');
            return redirect('/login')->with('error', 'Session expired. Please log in again.');
        }
        return null;
    }

    public function show()
{
    $token = session('access_token');

    if (!$token) {
        return redirect('/login')->with('error', 'Please log in first.');
    }

    $response = Http::withToken($token)->get('https://carlo.algorethics.ai/api/auth/profile');
    if ($redir = $this->handleTokenExpiry($response)) return $redir;
    \Log::info('Dashboard API Status: ' . $response->status());
    \Log::info('Dashboard API Body: ' . $response->body());
    if ($response->successful()) {
        $profile = $response->json();

        // Fetch subscriptions and normalize response structure
    $response1 = Http::withToken($token)->get('https://carlo.algorethics.ai/api/subscription');
    if ($redir = $this->handleTokenExpiry($response1)) return $redir;
    $subscriptions = collect([]);
    if ($response1->successful()) {
            $json = $response1->json();
            $items = $json['data'] ?? $json;
            if (is_array($items) && array_key_exists('data', $items) && is_array($items['data'])) {
                $items = $items['data'];
            }
            $subscriptions = collect(is_array($items) ? $items : [])
                ->map(function ($item) {
                    // Some APIs return { subscription: {...} }
                    $sub = $item['subscription'] ?? $item;
                    return is_array($sub) ? $sub : null;
                })
                ->filter()
                ->values();
        }

        return view('fasto.dashboard.index', compact('profile','subscriptions'));
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
	
    // public function app_profile(){
    //     $page_title = 'App Profile';
    //     $page_description = 'Some description for the page';
    //     return view('fasto.app.profile', compact('page_title', 'page_description'));
    // }
     protected $apiUrl = 'https://carlo.algorethics.ai/api/auth/profile';

    // View the profile form (with prefilled data from API)
    public function showprofile()
    {
        $token = session('access_token'); // Make sure this is set on login
        
        if (!$token) {
            return redirect()->route('login')->with('error', 'Access token missing.');
        }

        $response = Http::withToken($token)->get($this->apiUrl);

        if (!$response->successful()) {
            return back()->with('error', 'Failed to fetch profile.');
        }

        $user = $response->json('user.user_info'); // Only the user_info portion

        return view('fasto.app.profile', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $token = session('access_token');
        
        if (!$token) {
            return redirect()->route('login')->with('error', 'Access token missing.');
        }

        $data = [
            'user_info' => [
                'first_name'    => $request->input('first_name'),
                'last_name'     => $request->input('last_name'),
                'email'         => $request->input('email'),
                'phone_number'  => $request->input('phone_number'),
            ]
        ];

        $response = Http::withToken($token)->put($this->apiUrl, $data);

        if ($response->successful()) {
            return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('profile.show')->with('error', 'Failed to update profile.');
        }
    }


public function userFrameworks()
{
    $token = session('access_token');

    if (!$token) {
        abort(401, 'Token missing from session');
    }

    $response = Http::withToken($token)->get('https://carlo.algorethics.ai/api/user-frameworks');

    if (!$response->successful()) {
        return back()->with('error', 'Failed to fetch frameworks');
    }

    $frameworks = $response->json('data');

    // Also fetch governance frameworks for the creation modal select
    $govRes = Http::withToken($token)->get('https://carlo.algorethics.ai/api/governance');
    $governanceFrameworks = [];
    if ($govRes->successful()) {
        // Normalize common shapes: {data:[...] } or direct array
        $json = $govRes->json();
        $governanceFrameworks = $json['data'] ?? $json;
        if (!is_array($governanceFrameworks)) {
            $governanceFrameworks = [];
        }
    }

    return view('fasto.table.databasic', [
        'frameworks' => $frameworks,
        'governanceFrameworks' => $governanceFrameworks,
    ]);
}

// ------------------------------------Form View --------------------------------------
public function showProjectForm()
{
    $token = session('access_token');

    if (!$token) {
        return redirect()->route('login')->with('error', 'Authentication token missing.');
    }

    $response = Http::withToken($token)->get('https://carlo.algorethics.ai/api/subscription');

    if (!$response->successful()) {
        return back()->with('error', 'Failed to fetch subscriptions.');
    }

    $data = collect($response->json('data', []));
    
    // Extract subscription data correctly
    $subscriptions = $data->map(function ($item) {
        return $item['subscription'];
    });

    return view('fasto.dashboard.index', compact('subscriptions'));
}

// ------------------------------------Form Store --------------------------------------

public function create()
{
    $token = session('access_token');

    if (!$token) {
        return redirect()->route('login')->with('error', 'Authentication token missing.');
    }

    $response = Http::withToken($token)->get('https://carlo.algorethics.ai/api/subscription');

    if (!$response->successful()) {
        return back()->with('error', 'Failed to fetch subscriptions.');
    }

    $data = collect($response->json('data', []));

    $subscriptions = $data->map(function ($item) {
        return $item['subscription'];
    });

    return view('fasto.dashboard.index', compact('subscriptions'));
}

public function store(Request $request)
{
    // Log the incoming request data for debugging
    \Log::info('Project creation request data:', $request->all());

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
    \Log::info('Constructed payload for API:', $payload);

    // Get the token from session
    $token = session('access_token');

    if (!$token) {
        return response()->json(['success' => false, 'message' => 'Authentication token missing'], 401);
    }

    // Make API Request
    $response = Http::withToken($token)->post('https://carlo.algorethics.ai/api/project/create', $payload);

    // Log the API response for debugging
    \Log::info('API Response Status:', ['status' => $response->status()]);
    \Log::info('API Response Body:', ['body' => $response->body()]);

    if ($response->successful()) {
        return response()->json(['success' => true, 'message' => 'Project created successfully!']);
    } else {
        return response()->json([
            'success' => false, 
            'message' => 'Failed to create project: ' . $response->body()
        ], $response->status());
    }
}


    public function edit(Request $request, $id)
    {
        $token = session('access_token');
        
        \Log::info('Edit method called', ['id' => $id, 'token_exists' => !empty($token)]);

        if (!$token) {
            \Log::warning('No access token found in session');
            return response()->json(['error' => 'Authentication token missing'], 401);
        }

        try {
            \Log::info('Making API request to fetch project', ['id' => $id]);
            $projectResponse = Http::withToken($token)->get("https://carlo.algorethics.ai/api/project/$id");
            
            \Log::info('API response received', ['status' => $projectResponse->status(), 'successful' => $projectResponse->successful()]);
            
            if (!$projectResponse->successful()) {
                \Log::error('API request failed', ['status' => $projectResponse->status(), 'body' => $projectResponse->body()]);
                return response()->json(['error' => 'Failed to fetch project data'], $projectResponse->status());
            }

            $project = $projectResponse->json('data');
            
            if (!$project) {
                \Log::warning('No project data in API response');
                return response()->json(['error' => 'No project data found'], 404);
            }

            // Also fetch subscriptions for the subscription select
            $subsRes = Http::withToken($token)->get('https://carlo.algorethics.ai/api/subscription');
            $subscriptions = [];
            if ($subsRes->successful()) {
                $json = $subsRes->json();
                $items = $json['data'] ?? $json;
                if (is_array($items) && array_key_exists('data', $items) && is_array($items['data'])) {
                    $items = $items['data'];
                }
                $subscriptions = collect(is_array($items) ? $items : [])
                    ->map(function ($item) {
                        $sub = $item['subscription'] ?? $item;
                        return is_array($sub) ? $sub : null;
                    })
                    ->filter()
                    ->values()
                    ->all();
            }

            // Normalize technology_stack for Blade prefill
            if (isset($project['technology_stack']) && is_string($project['technology_stack'])) {
                $project['technology_stack'] = json_decode($project['technology_stack'], true) ?: [];
            }
            foreach (['backend','frontend','database','ai_models','apis'] as $key) {
                if (!isset($project['technology_stack'][$key]) || !is_array($project['technology_stack'][$key])) {
                    $project['technology_stack'][$key] = [];
                }
            }

            \Log::info('Project data retrieved successfully', ['project_id' => $project['id'] ?? 'unknown']);
            if ($request->expectsJson()) {
                return response()->json([
                    'project' => $project,
                    'subscriptions' => $subscriptions,
                ]);
            }
            return view('fasto.dashboard.edit_project', [
                'project' => $project,
                'subscriptions' => $subscriptions,
            ]);
        } catch (\Exception $e) {
            \Log::error('Exception in edit method', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Error fetching project: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Error fetching project: ' . $e->getMessage());
        }
    }

    public function updateProject(Request $request, $id)
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

        // Helper to get array or default
        $arr = function($val) {
            return is_array($val) ? $val : (empty($val) ? [] : [$val]);
        };
        // Helper to get boolean
        $bool = function($val) {
            return filter_var($val, FILTER_VALIDATE_BOOLEAN);
        };

        // Parse nested objects
        $technologyStack = $request->input('technology_stack', []);
        if (is_string($technologyStack)) $technologyStack = json_decode($technologyStack, true);
        $technologyStack = is_array($technologyStack) ? $technologyStack : [];
        foreach(['backend','frontend','database','ai_models','apis'] as $k) {
            if (!isset($technologyStack[$k]) || !is_array($technologyStack[$k])) $technologyStack[$k] = [];
        }

        $infrastructure = $request->input('infrastructure', []);
        if (is_string($infrastructure)) $infrastructure = json_decode($infrastructure, true);
        $infrastructure = is_array($infrastructure) ? $infrastructure : [];
        foreach(['cloud_provider','containerization'] as $k) {
            if (!isset($infrastructure[$k]) || !is_array($infrastructure[$k])) $infrastructure[$k] = [];
        }
        if (!isset($infrastructure['deployment_type'])) $infrastructure['deployment_type'] = '';

        $dataSources = $request->input('data_sources', []);
        if (is_string($dataSources)) $dataSources = json_decode($dataSources, true);
        $dataSources = is_array($dataSources) ? $dataSources : [];
        foreach(['structure_type','access_type','processing_type'] as $k) {
            if (!isset($dataSources[$k]) || !is_array($dataSources[$k])) $dataSources[$k] = [];
        }

        $dataEncryption = $request->input('data_encryption', []);
        if (is_string($dataEncryption)) $dataEncryption = json_decode($dataEncryption, true);
        $dataEncryption = is_array($dataEncryption) ? $dataEncryption : [];
        if (!isset($dataEncryption['enabled'])) $dataEncryption['enabled'] = false;
        if (!isset($dataEncryption['type'])) $dataEncryption['type'] = 'AES-256';

        $biasRiskFactors = $request->input('bias_risk_factors', []);
        if (is_string($biasRiskFactors)) $biasRiskFactors = json_decode($biasRiskFactors, true);
        $biasRiskFactors = is_array($biasRiskFactors) ? $biasRiskFactors : [];
        if (!isset($biasRiskFactors['identified'])) $biasRiskFactors['identified'] = false;
        if (!isset($biasRiskFactors['description'])) $biasRiskFactors['description'] = '';

        // Build payload
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
            'audit_logging' => $bool($request->input('audit_logging')),
            'user_consent_mechanism' => $bool($request->input('user_consent_mechanism')),
            'compliance_standards' => is_array($request->input('compliance_standards')) ? $request->input('compliance_standards') : [],
            'bias_risk_factors' => $biasRiskFactors,
            'fairness_transparency_practices' => $bool($request->input('fairness_transparency_practices')),
            'has_ai_ml' => $bool($request->input('has_ai_ml')),
            'ai_model_type' => is_array($request->input('ai_model_type')) ? $request->input('ai_model_type') : [],
            'training_data_source' => is_array($request->input('training_data_source')) ? $request->input('training_data_source') : [],
            'model_monitoring' => $bool($request->input('model_monitoring')),
            'bias_detection' => $bool($request->input('bias_detection')),
            'automated_decision_making' => $bool($request->input('automated_decision_making')),
            'webhooks_notifications' => $bool($request->input('webhooks_notifications')),
            'custom_rules' => $bool($request->input('custom_rules')),
            'third_party_plugins' => $bool($request->input('third_party_plugins')),
            'compliance_consultation' => $bool($request->input('compliance_consultation')),
        ];

        \Log::info('Constructed payload for API update:', $payload);

        $token = session('access_token');
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Authentication token missing'], 401);
        }

        try {
            $response = Http::withToken($token)->put("https://carlo.algorethics.ai/api/project/$id", $payload);
            \Log::info('API Update Response Status:', ['status' => $response->status()]);
            \Log::info('API Update Response Body:', ['body' => $response->body()]);
            if ($response->successful()) {
                return response()->json(['success' => true, 'message' => 'Project updated successfully!']);
            }
            return response()->json([
                'success' => false,
                'message' => ($response->json('message') ?? $response->body() ?? 'Unknown error'),
                'error'   => $response->body(),
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating project: ' . $e->getMessage(),
            ], 500);
        }
    }

public function destroy($id)
{
    $token = session('access_token');

    $response = Http::withToken($token)->delete("https://carlo.algorethics.ai/api/project/$id");

    if ($response->successful()) {
        return response()->json(['message' => 'Project deleted successfully.'], 200);
    }

    return response()->json(['message' => 'Failed to delete project.'], 500);
}

// ---------------------user Frame Works -----------------------------------------------------------------------------------------------
 public function createFramework()
    {
        // Fetch governance frameworks from external API
        $frameworksResponse = Http::withToken(session('access_token'))
            ->get('https://carlo.algorethics.ai/api/governance');

        $frameworks = [];
        if ($frameworksResponse->successful()) {
            $json = $frameworksResponse->json();
            $frameworks = $json['data'] ?? $json;
            if (!is_array($frameworks)) {
                $frameworks = [];
            }
        }

        return view('frameworks.create', compact('frameworks'));
    }

    // Store framework
    public function storeFramework(Request $request)
    {
        // Validate
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'version' => 'required|string',
            'selected_governance_frameworks' => 'required|array',
            'custom_rules' => 'nullable|array',
            'status' => 'required|string',
        ]);

        // Convert checkbox to boolean
        $isActive = $request->has('is_active');

        // Prepare payload
        $payload = [
            "name" => $validated['name'],
            "description" => $validated['description'],
            "version" => $validated['version'],
            "selected_governance_frameworks" => $validated['selected_governance_frameworks'],
            "custom_rules" => $validated['custom_rules'] ?? [],
            "is_active" => $isActive,
            "status" => $validated['status'],
        ];

        // Send to external API
        $response = Http::withToken(session('access_token'))
            ->post('https://carlo.algorethics.ai/api/user-frameworks', $payload);
        if ($redir = $this->handleTokenExpiry($response)) return $redir;
        if ($response->successful()) {
            return back()->with('success', 'Framework created successfully!');
        }
        return back()->with('error', 'Failed to create framework: ' . $response->body());
    }

// -------------------------------------------------------Support Center Controller -----------------------------------------------------------------------------
public function ticketsView()
{
    // Get the token from session
    $token = session('access_token');

    // Make API request with Bearer token
    $response = Http::withToken($token)
        ->get('https://support.policyenforcement.com/api/tickets');

    // Check the response
    if ($response->successful()) {
        $tickets = $response->json()['data']['data'] ?? [];
    } else {
        $tickets = [];
        // Optional: log or debug the error
        // logger()->error('Tickets API error', ['status' => $response->status(), 'body' => $response->body()]);
    }

    return view('fasto.ui.alert', compact('tickets'));
}

public function ticketShow($id)
{
    $token = session('access_token');
    if (!$token) {
        return redirect()->route('login')->with('error', 'Authentication token missing.');
    }

    // Fetch ticket details
    $ticketRes = Http::withToken($token)
        ->get("https://support.policyenforcement.com/api/tickets/{$id}");

    if (!$ticketRes->successful()) {
        \Log::error('Fetch ticket failed', ['id' => $id, 'status' => $ticketRes->status(), 'body' => $ticketRes->body()]);
        return back()->with('error', 'Failed to load ticket.');
    }

    $ticketJson = $ticketRes->json();
    $ticket = $ticketJson['data'] ?? $ticketJson;

    // Try to fetch conversation/messages if available; otherwise, look for messages on the ticket object
    $messages = [];
    try {
        $messagesRes = Http::withToken($token)
            ->get("https://support.policyenforcement.com/api/tickets/{$id}/messages");
        if ($messagesRes->successful()) {
            $mJson = $messagesRes->json();
            $items = $mJson['data'] ?? $mJson;
            if (is_array($items) && array_key_exists('data', $items) && is_array($items['data'])) {
                $items = $items['data'];
            }
            $messages = is_array($items) ? $items : [];
        } else {
            // fallback: some APIs embed messages/comments in ticket
            $messages = $ticket['messages'] ?? $ticket['comments'] ?? [];
            if (!is_array($messages)) { $messages = []; }
        }
    } catch (\Throwable $e) {
        $messages = $ticket['messages'] ?? $ticket['comments'] ?? [];
        if (!is_array($messages)) { $messages = []; }
    }

    return view('fasto.ui.ticket_show', compact('ticket', 'messages'));
}

public function ticketReply(Request $request, $id)
{
    $token = session('access_token');
    if (!$token) {
        return response()->json(['message' => 'Authentication token missing'], 401);
    }

    $validated = $request->validate([
        'message'        => 'required_without:contents|nullable|string',
        'contents'       => 'nullable|string',
        'attachments'    => 'nullable',
        'attachments.*'  => 'file|max:4096',
    ]);

    $body = $request->input('message') ?? $request->input('contents');

    $multipart = [
        ['name' => 'message',  'contents' => (string) ($body ?? '')],
        ['name' => 'contents', 'contents' => (string) ($body ?? '')],
    ];

    if ($request->hasFile('attachments')) {
        $files = $request->file('attachments');
        $files = is_array($files) ? $files : [$files];
        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $multipart[] = [
                    'name'     => 'attachments[]',
                    'contents' => fopen($file->getPathname(), 'r'),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }
    }

    $res = Http::withToken($token)
        ->asMultipart()
        ->post("https://support.policyenforcement.com/api/tickets/{$id}/reply", $multipart);

    if (!$res->successful()) {
        \Log::error('Ticket reply failed', ['id' => $id, 'status' => $res->status(), 'body' => $res->body()]);
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Failed to submit reply', 'error' => $res->json('message') ?? $res->body()], $res->status());
        }
        return back()->with('error', 'Failed to submit reply.');
    }

    if ($request->expectsJson()) {
        return response()->json(['message' => 'Reply submitted successfully', 'data' => $res->json()], 201);
    }
    return back()->with('success', 'Reply submitted successfully.');
}

public function ticketDestroy(Request $request, $id)
{
    $token = session('access_token');
    if (!$token) {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Authentication token missing'], 401);
        }
        return back()->with('error', 'Authentication token missing.');
    }

    $client = Http::withToken($token)->accept('application/json');

    // Attempt standard DELETE
    $response = $client->delete("https://support.policyenforcement.com/api/tickets/{$id}");

    if (!$response->successful()) {
        \Log::error('Ticket delete failed', [
            'id' => $id,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        // Fallback 1: POST to /{id}/delete
        $fallback1 = $client->post("https://support.policyenforcement.com/api/tickets/{$id}/delete");
        if ($fallback1->successful()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Ticket deleted successfully']);
            }
            return back()->with('success', 'Ticket deleted successfully.');
        }

        // Fallback 2: Method override via POST to /{id}
        $fallback2 = $client->asForm()->post("https://support.policyenforcement.com/api/tickets/{$id}", [
            '_method' => 'DELETE',
        ]);
        if ($fallback2->successful()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Ticket deleted successfully']);
            }
            return back()->with('success', 'Ticket deleted successfully.');
        }

        // Fallback 3: POST to /delete with id payload
        $fallback3 = $client->asForm()->post("https://support.policyenforcement.com/api/tickets/delete", [
            'id' => $id,
        ]);
        if ($fallback3->successful()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Ticket deleted successfully']);
            }
            return back()->with('success', 'Ticket deleted successfully.');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete ticket',
                'error' => $response->json('message') ?? $fallback1->json('message') ?? $fallback2->json('message') ?? $fallback3->json('message') ?? ($response->body() ?: 'Unknown error'),
            ], 500);
        }
        return back()->with('error', 'Failed to delete ticket.');
    }

    if ($request->expectsJson()) {
        return response()->json(['success' => true, 'message' => 'Ticket deleted successfully']);
    }
    return back()->with('success', 'Ticket deleted successfully.');
}

public function fetchTicketDepartments()
{
    $token = session('access_token');
    if (!$token) {
        return response()->json(['message' => 'Authentication token missing'], 401);
    }

    $response = Http::withToken($token)
        ->get('https://support.policyenforcement.com/api/departments');

    if (!$response->successful()) {
        \Log::error('Fetch departments failed', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
        return response()->json(['message' => 'Failed to load departments'], 500);
    }

    $json = $response->json();
    // Normalize common response shapes: {data:[...]}, {data:{data:[...]}}, {departments:[...]}
    $items = $json['data'] ?? $json;
    if (is_array($items) && array_key_exists('data', $items) && is_array($items['data'])) {
        $items = $items['data'];
    }
    if (is_array($items) && array_key_exists('departments', $items) && is_array($items['departments'])) {
        $items = $items['departments'];
    }

    if (!is_array($items)) {
        $items = [];
    }

    return response()->json(['data' => array_values($items)]);
}

public function fetchTicketPriorities()
{
    $token = session('access_token');
    if (!$token) {
        return response()->json(['message' => 'Authentication token missing'], 401);
    }

    // Try external API first
    $response = Http::withToken($token)
        ->get('https://support.policyenforcement.com/api/priorities');

    if ($response->successful()) {
        $json = $response->json();
        $items = $json['data'] ?? $json;
        if (is_array($items) && array_key_exists('data', $items) && is_array($items['data'])) {
            $items = $items['data'];
        }
        if (is_array($items) && array_key_exists('priorities', $items) && is_array($items['priorities'])) {
            $items = $items['priorities'];
        }
        if (!is_array($items)) {
            $items = [];
        }
        return response()->json(['data' => array_values($items)]);
    }

    // Fallback to common default priorities if API is unavailable
    return response()->json(['data' => [
        ['id' => 1, 'name' => 'Low'],
        ['id' => 2, 'name' => 'Medium'],
        ['id' => 3, 'name' => 'High'],
    ]]);
}

public function createTicket(Request $request)
{
    $token = session('access_token');

    if (!$token) {
        return response()->json(['error' => 'Authentication token missing'], 401);
    }

    $validated = $request->validate([
        'subject'        => 'required|string',
        'department_id'  => 'required|integer',
        'priority'       => 'required',
        'description'    => 'required_without:contents|string|nullable',
        'contents'       => 'nullable|string',
        'attachments'    => 'nullable',
        'attachments.*'  => 'file|max:2048',
    ]);

    // Determine department and description values (support both naming conventions)
    $departmentValue = $request->filled('department_id')
        ? $request->input('department_id')
        : ($request->input('department') ?? null);
    $descriptionValue = $request->filled('description')
        ? $request->input('description')
        : ($request->input('contents') ?? null);

    // Build multipart form data and only include fields that have values
    $multipartData = [];
    $multipartData[] = ['name' => 'subject', 'contents' => (string) $validated['subject']];
    if (!is_null($departmentValue) && $departmentValue !== '') {
        // Always send both department_id and department for maximum compatibility
        $multipartData[] = ['name' => 'department_id', 'contents' => (string) $departmentValue];
        $multipartData[] = ['name' => 'department', 'contents' => (string) $departmentValue];
    }
    if (isset($validated['priority'])) {
        $multipartData[] = ['name' => 'priority', 'contents' => (string) $validated['priority']];
    }
    if (!is_null($descriptionValue) && $descriptionValue !== '') {
        // Prefer description if provided, else contents
        $descKey = $request->filled('description') ? 'description' : 'contents';
        $multipartData[] = ['name' => $descKey, 'contents' => (string) $descriptionValue];
    }

    // Support both single file and array of files under "attachments"
    if ($request->hasFile('attachments')) {
        $files = $request->file('attachments');
        $files = is_array($files) ? $files : [$files];

        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $multipartData[] = [
                    'name'     => 'attachments[]',
                    'contents' => fopen($file->getPathname(), 'r'),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }
    }

    $response = Http::withToken($token)
        ->asMultipart()
        ->post('https://support.policyenforcement.com/api/tickets', $multipartData);

    if (!$response->successful()) {
        \Log::error('Ticket creation failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Failed to create ticket',
            'error'   => $response->json('message') ?? $response->body(),
        ], $response->status());
    }

    return response()->json([
        'success' => true,
        'message' => 'Ticket created successfully',
        'data'    => $response->json('data') ?? $response->json(),
    ], 201);
}

// ----------------------------------------------SIGN Up-----------------------------------------------------------
 public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Step 2: Register user with API
   public function register(Request $request)
{
    $response = Http::post('https://carlo.algorethics.ai/api/auth/register', [
        'user_info' => [
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
        ],
        'account_setup' => [
            'username'                         => $request->username,
            'password'                         => $request->password,
            'preferred_communication_channel'  => $request->preferred_communication_channel,
        ]
    ]);

    if ($response->failed()) {
        return back()->withErrors(['msg' => $response->json()['message'] ?? 'Registration failed']);
    }

    $data = $response->json();
    session(['auth_token' => $data['token'] ?? null]);

    return response()->json(['success' => true, 'message' => 'Registered successfully']);
}

public function completeProfile(Request $request)
{
    $token = session('auth_token');

    $response = Http::withToken($token)->post('https://carlo.algorethics.ai/api/auth/complete-profile', [
        'company_info' => [
            'company_name' => $request->company_name,
            'industry'     => $request->industry,
            'website'      => $request->website,
            'company_size' => $request->company_size,
            'country'      => $request->country,
        ],
        'project_details' => [
            'primary_use_case'   => $request->primary_use_case,
            'number_of_projects' => (int) $request->number_of_projects,
            'compliance_frameworks' => $request->compliance_frameworks ? explode(',', $request->compliance_frameworks) : [],
        ],
        'subscription_details' => [
            'subscription_plan' => $request->subscription_plan,
            'billing_frequency' => $request->billing_frequency,
            'promo_code'        => $request->promo_code,
        ],
        'additional_features' => [
            'team_members'  => $request->team_members ? explode(',', $request->team_members) : [],
            'referral_code' => $request->referral_code,
            'refer'         => $request->refer,
        ],
        'developer_preferences' => [
            'preferred_language' => $request->preferred_language,
            'tools_integrations' => $request->tools_integrations ? explode(',', $request->tools_integrations) : [],
        ]
    ]);

    if ($response->failed()) {
        return back()->withErrors(['msg' => $response->json()['message'] ?? 'Profile completion failed']);
    }

    return redirect()->route('login')->with('success', 'Profile completed successfully!');
}





}








