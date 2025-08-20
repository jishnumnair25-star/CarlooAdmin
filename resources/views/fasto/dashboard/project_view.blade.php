@extends('layouts.default')
@section('content')

<div class="container py-4">
    <div class="row gx-4 gy-4 flex-wrap">
<!-- Left Column -->
<div class="col-lg-4 col-md-12">

    <!-- Project Status -->
    <div class="card mb-3 shadow-sm w-100 " style="height: 153px;">
        <div class="card-body">
            <h5 class="card-title">Project Status</h5>
            @php
                $status = strtolower($project['project_status'] ?? '');
                $statusColor = match($status) {
                    'active' => 'success',
                    'draft' => 'primary',
                    'pending' => 'warning',
                    default => 'danger'
                };
            @endphp
            <span class="badge bg-{{ $statusColor }}">{{ ucfirst($status) ?: 'Unknown' }}</span>
        </div>
    </div>

    <!-- API Key -->
    <div class="card mb-3 shadow-sm w-100" style="height: 153px;">
        <div class="card-body">
            <h5 class="card-title"><i class="fa fa-key me-1"></i>API Key</h5>
            <div class="input-group">
                <input type="text" class="form-control" readonly value="{{ $project['api_key'] ?? 'N/A' }}">
                <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ $project['api_key'] ?? '' }}')">Copy</button>
            </div>
        </div>
    </div>

    <!-- Project Details -->
    <div class="card mb-3 shadow-sm w-100" style="height: 355px;">
        <div class="card-body">
            <h5 class="card-title">Project Details</h5>
            <p><strong>ID:</strong> {{ $project['id'] ?? '-' }}</p>
            <p><strong>Name:</strong> {{ $project['project_name'] ?? '-' }}</p>
            <p><strong>Owner:</strong> {{ $project['owner'] ?? '-' }}</p>
            <p><strong>Created:</strong> {{ \Carbon\Carbon::parse($project['created_at'])->format('M d, Y h:i A') }}</p>
            <p><strong>Industry:</strong> {{ $project['industry_domain'] ?? '-' }}</p>
        </div>
    </div>

    <!-- Skills -->
    <div class="card mb-3 shadow-sm w-100" style="height: 153px;">
        <div class="card-body">
            <h5 class="card-title">Interest</h5>
            <p><strong>Skills:</strong></p>
            @forelse($project['skills'] ?? [] as $skill)
                <span class="badge bg-secondary me-1">{{ $skill }}</span>
            @empty
                <p>No skills listed.</p>
            @endforelse
        </div>
    </div>

</div>



        <!-- Right Column -->
        <div class="col-lg-8 col-md-12">

            <h4 class="mb-3">{{ $project['project_name'] ?? 'Unnamed Project' }}</h4>

            @php
                $infra = $project['infrastructure'] ?? [];
                $deployment = $infra['deployment'] ?? ($infra['deployment_type'] ?? '-');
                $cloudProviders = $infra['cloud_provider'] ?? [];
                $container = $infra['container'] ?? (isset($infra['containerization']) ? (is_array($infra['containerization']) ? implode(', ', $infra['containerization']) : $infra['containerization']) : '-');
                $storage = $infra['storage'] ?? ($project['data_storage_location'] ?? '-');

                $aiDetails = $project['ai_ml_details'] ?? [];
                $modelType = $aiDetails['model_type'] ?? (isset($project['ai_model_type']) ? (is_array($project['ai_model_type']) ? implode(', ', $project['ai_model_type']) : $project['ai_model_type']) : '-');
                $trainingSource = $aiDetails['training_data_source'] ?? (isset($project['training_data_source']) ? (is_array($project['training_data_source']) ? implode(', ', $project['training_data_source']) : $project['training_data_source']) : '-');

                $governance = $aiDetails['governance'] ?? [
                    'model_monitoring' => $project['model_monitoring'] ?? null,
                    'bias_detection' => $project['bias_detection'] ?? null,
                    'automated_decision_making' => $project['automated_decision_making'] ?? null,
                    'webhooks_notifications' => $project['webhooks_notifications'] ?? null,
                    'custom_rules' => $project['custom_rules'] ?? null,
                    'third_party_plugins' => $project['third_party_plugins'] ?? null,
                    'compliance_consultation' => $project['compliance_consultation'] ?? null,
                    'fairness_transparency_practices' => $project['fairness_transparency_practices'] ?? null,
                ];
                $governance = array_filter($governance, function($v) { return $v !== null; });

                $biasRisk = $aiDetails['bias_risk'] ?? (function() use ($project) {
                    $br = $project['bias_risk_factors'] ?? null;
                    if (is_array($br)) {
                        if (($br['identified'] ?? false) && !empty($br['description'] ?? '')) return $br['description'];
                        return ($br['identified'] ?? false) ? 'Identified' : 'Not identified';
                    }
                    return 'N/A';
                })();

                $features = $project['features'] ?? null;
                if (!$features) {
                    $features = [
                        'Fairness Transparency Practices' => $project['fairness_transparency_practices'] ?? null,
                        'Model Monitoring' => $project['model_monitoring'] ?? null,
                        'Bias Detection' => $project['bias_detection'] ?? null,
                        'Automated Decision Making' => $project['automated_decision_making'] ?? null,
                        'Webhooks & Notifications' => $project['webhooks_notifications'] ?? null,
                        'Custom Rules' => $project['custom_rules'] ?? null,
                        'Third Party Plugins' => $project['third_party_plugins'] ?? null,
                        'Compliance Consultation' => $project['compliance_consultation'] ?? null,
                    ];
                    $features = array_filter($features, function($v){ return $v !== null; });
                }
            @endphp

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="projectTabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tech">Technology Stack</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#data">Data Sources</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#ai">AI/ML Details</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#features">Features</a></li>
            </ul>

            <!-- Tab Contents -->
            <div class="tab-content card p-3 shadow-sm text-break">

                <!-- Overview -->
                <div class="tab-pane fade show active" id="overview">
                    <h6><i class="fa fa-info-circle me-1"></i> Description</h6>
                    <p>{{ $project['description'] ?? '-' }}</p>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6>General Info</h6>
                            <p><strong>ID:</strong> {{ $project['id'] }}</p>
                            <p><strong>Industry:</strong> {{ $project['industry_domain'] }}</p>
                            <p><strong>Created:</strong> {{ \Carbon\Carbon::parse($project['created_at'])->format('F d, Y h:i A') }}</p>
                            <p><strong>Updated:</strong> {{ \Carbon\Carbon::parse($project['updated_at'])->format('F d, Y h:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Compliance</h6>
                            <p><strong>Standards:</strong> {{ is_array($project['compliance_standards'] ?? null) ? implode(', ', $project['compliance_standards']) : '-' }}</p>
                            <p><strong>Encryption:</strong> {{ is_array($project['data_encryption'] ?? null) ? implode(', ', $project['data_encryption']) : '-' }}</p>
                            <p><strong>Sensitivity:</strong> {{ is_array($project['data_sensitivity'] ?? null) ? implode(', ', $project['data_sensitivity']) : '-' }}</p>
                            <p><strong>Access Control:</strong> {{ is_array($project['access_control'] ?? null) ? implode(', ', $project['access_control']) : '-' }}</p>
                            <p><strong>Audit Logging:</strong> {{ ($project['audit_logging'] ?? false) ? 'Enabled' : 'Disabled' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Technology Stack -->
                <!-- Technology Stack -->
<div class="tab-pane fade" id="tech">
    <h6 class="mb-3"><i class="fa fa-code me-1"></i> Technology Stack</h6>

    <div class="row mb-3">
        <div class="col-md-6 mb-2">
            <strong>Backend:</strong>
            @foreach($project['technology_stack']['backend'] ?? [] as $item)
                <span class="badge bg-success me-1">{{ $item }}</span>
            @endforeach
        </div>
        <div class="col-md-6 mb-2">
            <strong>Frontend:</strong>
            @foreach($project['technology_stack']['frontend'] ?? [] as $item)
                <span class="badge bg-primary me-1">{{ $item }}</span>
            @endforeach
        </div>
        <div class="col-md-6 mb-2">
            <strong>Database:</strong>
            @foreach($project['technology_stack']['database'] ?? [] as $item)
                <span class="badge bg-success me-1">{{ $item }}</span>
            @endforeach
        </div>
        <div class="col-md-6 mb-2">
            <strong>AI Models:</strong>
            @foreach($project['technology_stack']['ai_models'] ?? [] as $item)
                <span class="badge bg-warning text-dark me-1">{{ $item }}</span>
            @endforeach
        </div>
        <div class="col-md-6 mb-2">
            <strong>APIs:</strong>
            @foreach($project['technology_stack']['apis'] ?? [] as $item)
                <span class="badge bg-danger me-1">{{ $item }}</span>
            @endforeach
        </div>
    </div>

    <h6 class="mt-4"><i class="fa fa-cloud me-1"></i> Infrastructure</h6>
    <div class="row">
        <div class="col-md-6 mb-2"><strong>Deployment:</strong> {{ $deployment }}</div>
        <div class="col-md-6 mb-2"><strong>Cloud Provider:</strong> {{ is_array($cloudProviders) ? implode(', ', $cloudProviders) : ($cloudProviders ?: '-') }}</div>
        <div class="col-md-6 mb-2"><strong>Container:</strong> {{ $container }}</div>
        <div class="col-md-6 mb-2"><strong>Storage:</strong> {{ $storage }}</div>
    </div>
</div>


                <!-- Data Sources -->
                <div class="tab-pane fade" id="data">
                    <h6><i class="fa fa-database me-1"></i> Data Sources</h6>
                    <p><strong>Structure:</strong> {{ is_array($project['data_sources']['structure_type'] ?? null) ? implode(', ', $project['data_sources']['structure_type']) : '-' }}</p>
                    <p><strong>Access:</strong> {{ is_array($project['data_sources']['access_type'] ?? null) ? implode(', ', $project['data_sources']['access_type']) : '-' }}</p>
                    <p><strong>Processing:</strong> {{ is_array($project['data_sources']['processing_type'] ?? null) ? implode(', ', $project['data_sources']['processing_type']) : '-' }}</p>
                </div>

                <!-- AI/ML -->
                <div class="tab-pane fade" id="ai">
                    <h6><i class="fa fa-robot me-1"></i> AI/ML Details</h6>
                    <p><strong>Has AI/ML:</strong> {{ ($project['has_ai_ml'] ?? false) ? 'Yes' : 'No' }}</p>
                    <p><strong>Model Type:</strong> {{ $modelType }}</p>
                    <p><strong>Training Source:</strong> {{ $trainingSource }}</p>

                    <h6 class="mt-3">Governance</h6>
                    <div class="row row-cols-1 row-cols-md-2 g-2">
                        @forelse($governance as $key => $val)
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-center border rounded px-2 py-2">
                                    <span class="small text-muted">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                                    <span class="badge bg-{{ $val ? 'success' : 'secondary' }}">{{ $val ? 'Enabled' : 'Disabled' }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="col"><p class="mb-0">-</p></div>
                        @endforelse
                    </div>

                    <h6 class="mt-3">Bias Risk</h6>
                    <div class="alert alert-warning">{{ $biasRisk }}</div>
                </div>

                <!-- Features -->
                <div class="tab-pane fade" id="features">
                    <h6><i class="fa fa-puzzle-piece me-1"></i> Features</h6>
                    <div class="row row-cols-1 row-cols-md-2 g-2">
                        @forelse($features as $key => $val)
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-center border rounded px-2 py-2">
                                    <span class="small text-muted">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                                    <span>
                                        @if(is_bool($val))
                                            <span class="badge bg-{{ $val ? 'success' : 'secondary' }}">{{ $val ? 'Enabled' : 'Disabled' }}</span>
                                        @else
                                            {{ $val }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="col"><p class="mb-0">-</p></div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
    </div>
</div>
@endsection
