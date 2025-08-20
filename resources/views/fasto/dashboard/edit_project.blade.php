<script>
// Prefill form fields from AJAX project data
function prefillEditProjectForm(project) {
    if (!project) return;
    const form = document.getElementById('editProjectForm');
    if (!form) return;
    // Simple fields
    form.project_name.value = project.project_name || '';
    form.project_description.value = project.project_description || '';
    form.data_storage_location.value = project.data_storage_location || '';
    if (form.subscription_id) form.subscription_id.value = project.subscription_id || '';
    if (form.status) form.status.value = project.status || '';
    if (form.industry_domain) form.industry_domain.value = project.industry_domain || '';

    // Multi-selects for technology stack
    function setMultiSelect(name, values) {
        const select = form.querySelector(`[name="${name}"]`);
        if (select && Array.isArray(values)) {
            Array.from(select.options).forEach(opt => {
                opt.selected = values.includes(opt.value);
            });
        }
    }
    const ts = project.technology_stack || {};
    setMultiSelect('technology_stack[backend][]', ts.backend || []);
    setMultiSelect('technology_stack[frontend][]', ts.frontend || []);
    setMultiSelect('technology_stack[database][]', ts.database || []);
    setMultiSelect('technology_stack[ai_models][]', ts.ai_models || []);
    setMultiSelect('technology_stack[apis][]', ts.apis || []);

    setMultiSelect('apis_integrations[]', project.apis_integrations || []);
    setMultiSelect('programming_languages[]', project.programming_languages || []);

    // Infrastructure
    if (project.infrastructure) {
        if (form.querySelector('[name="infrastructure[deployment_type]"]'))
            form.querySelector('[name="infrastructure[deployment_type]"]').value = project.infrastructure.deployment_type || '';
        setMultiSelect('infrastructure[cloud_provider][]', project.infrastructure.cloud_provider || []);
        setMultiSelect('infrastructure[containerization][]', project.infrastructure.containerization || []);
    }

    // Data sources
    if (project.data_sources) {
        if (form.querySelector('[name="data_sources_structure_type"]'))
            form.querySelector('[name="data_sources_structure_type"]').value = (project.data_sources.structure_type && project.data_sources.structure_type[0]) || '';
        setMultiSelect('data_sources_access_type[]', project.data_sources.access_type || []);
        setMultiSelect('data_sources_processing_type[]', project.data_sources.processing_type || []);
    }

    setMultiSelect('data_sensitivity[]', project.data_sensitivity || []);
    setMultiSelect('access_control[]', project.access_control || []);
    setMultiSelect('compliance_standards[]', project.compliance_standards || []);
    setMultiSelect('ai_model_type[]', project.ai_model_type || []);
    setMultiSelect('training_data_source[]', project.training_data_source || []);

    // Checkboxes
    function setCheckbox(name, checked) {
        const el = form.querySelector(`[name="${name}"]`);
        if (el) el.checked = !!checked;
    }
    setCheckbox('audit_logging', project.audit_logging);
    setCheckbox('user_consent', project.user_consent_mechanism);
    setCheckbox('fairness_practices', project.fairness_transparency_practices);
    setCheckbox('has_ai_ml', project.has_ai_ml);
    setCheckbox('model_monitoring', project.model_monitoring);
    setCheckbox('bias_detection', project.bias_detection);
    setCheckbox('automated_decision_making', project.automated_decision_making);
    setCheckbox('webhooks_notifications', project.webhooks_notifications);
    setCheckbox('custom_rules', project.custom_rules);
    setCheckbox('third_party_plugins', project.third_party_plugins);
    setCheckbox('compliance_consultation', project.compliance_consultation);
    setCheckbox('bias_identified', project.bias_risk_factors && project.bias_risk_factors.identified);
    if (form.querySelector('[name="bias_risk_description"]') && project.bias_risk_factors)
        form.querySelector('[name="bias_risk_description"]').value = project.bias_risk_factors.description || '';
    if (form.querySelector('[name="data_encryption"]') && project.data_encryption)
        form.querySelector('[name="data_encryption"]').checked = !!project.data_encryption.enabled;
    if (form.querySelector('[name="encryption_type"]') && project.data_encryption)
        form.querySelector('[name="encryption_type"]').value = project.data_encryption.type || '';
}
</script>
@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Project</h4>
                </div>
                <div class="card-body">
                    <form id="editProjectForm" method="POST" action="{{ route('projects.update', $project['id'] ?? $project['_id'] ?? '') }}">
                        @csrf
                        @method('PUT')
                        
                        <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
                            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#basicInfo" type="button">Basic Info</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#technology" type="button">Technology</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#dataSecurity" type="button">Data & Security</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#compliance" type="button">Compliance & AI/ML</button></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="basicInfo">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Project Name *</label>
                                        <input name="project_name" type="text" class="form-control" value="{{ $project['project_name'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Project Description *</label>
                                        <textarea name="project_description" class="form-control" required>{{ $project['project_description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Subscription *</label>
                                        <select name="subscription_id" id="subscriptionSelect" class="form-select" required>
                                            <option value="">Select Subscription</option>
                                            @if (!empty($subscriptions) && count($subscriptions))
                                                @foreach ($subscriptions as $subscription)
                                                    @php
                                                        $sid = $subscription['_id'] ?? $subscription['id'] ?? $subscription['subscription_id'] ?? '';
                                                        $label = ($subscription['pricing_tier'] ?? $subscription['plan_name'] ?? 'Subscription') . ' - ' . ($subscription['status'] ?? '');
                                                    @endphp
                                                    @if($sid)
                                                        <option value="{{ $sid }}" {{ ($project['subscription_id'] ?? '') == $sid ? 'selected' : '' }}>{{ $sid }} - {{ $label }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="" disabled>No subscriptions available</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status *</label>
                                        @php $statusVal = $project['status'] ?? ''; @endphp
                                        <select name="status" class="form-select" required>
                                            <option value="">Select</option>
                                            <option value="Draft" {{ $statusVal === 'Draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="Pending" {{ $statusVal === 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Active" {{ $statusVal === 'Active' ? 'selected' : '' }}>Active</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Industry Domain *</label>
                                        @php $indVal = $project['industry_domain'] ?? ''; @endphp
                                        <select name="industry_domain" class="form-select" required>
                                            <option value="">Select</option>
                                            <option value="Healthcare & MedTech" {{ $indVal === 'Healthcare & MedTech' ? 'selected' : '' }}>Healthcare & MedTech</option>
                                            <option value="Finance" {{ $indVal === 'Finance' ? 'selected' : '' }}>Finance</option>
                                            <option value="Education" {{ $indVal === 'Education' ? 'selected' : '' }}>Education</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Data Storage Location *</label>
                                        @php $storageVal = $project['data_storage_location'] ?? ''; @endphp
                                        <input name="data_storage_location" type="text" class="form-control" value="{{ $storageVal }}" required placeholder="e.g. AWS, Azure, On-premise">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label">AI Models Used</label>
                                    @php $aiModelsText = isset($project['ai_models']) && is_array($project['ai_models']) ? implode(', ', $project['ai_models']) : ($project['ai_models'] ?? ''); @endphp
                                    <input type="text" name="ai_models" class="form-control" placeholder="e.g. GPT-4, BERT" value="{{ $aiModelsText }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">APIs Used</label>
                                    @php $apisText = isset($project['apis']) && is_array($project['apis']) ? implode(', ', $project['apis']) : ($project['apis'] ?? ''); @endphp
                                    <input type="text" name="apis" class="form-control" placeholder="e.g. OpenAI API, Google Maps API" value="{{ $apisText }}">
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button class="btn btn-secondary prev-btn" disabled>Previous</button>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="technology">
                                @php
                                    $ts = $project['technology_stack'] ?? [];
                                    if (is_string($ts)) {
                                        $ts = json_decode($ts, true) ?: [];
                                    }
                                @endphp
                                <h6>Technology Stack</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Backend Technologies *</label>
                                        @php $selBackend = $ts['backend'] ?? []; @endphp
                                        <select name="technology_stack[backend][]" class="form-select" id="backend-tech" multiple required>
                                            <option value="Node.js" {{ in_array('Node.js', $selBackend) ? 'selected' : '' }}>Node.js</option>
                                            <option value="Express" {{ in_array('Express', $selBackend) ? 'selected' : '' }}>Express</option>
                                            <option value="Python" {{ in_array('Python', $selBackend) ? 'selected' : '' }}>Python</option>
                                            <option value="Django" {{ in_array('Django', $selBackend) ? 'selected' : '' }}>Django</option>
                                            <option value="Laravel" {{ in_array('Laravel', $selBackend) ? 'selected' : '' }}>Laravel</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Frontend Technologies</label>
                                        @php $selFrontend = $ts['frontend'] ?? []; @endphp
                                        <select name="technology_stack[frontend][]" class="form-select" id="frontend-tech" multiple>
                                            <option value="React" {{ in_array('React', $selFrontend) ? 'selected' : '' }}>React</option>
                                            <option value="NextJS" {{ in_array('NextJS', $selFrontend) ? 'selected' : '' }}>NextJS</option>
                                            <option value="Vue" {{ in_array('Vue', $selFrontend) ? 'selected' : '' }}>Vue</option>
                                            <option value="Angular" {{ in_array('Angular', $selFrontend) ? 'selected' : '' }}>Angular</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Database Technologies *</label>
                                        @php $selDb = $ts['database'] ?? []; @endphp
                                        <select name="technology_stack[database][]" class="form-select" id="database-tech" multiple required>
                                            <option value="MySQL" {{ in_array('MySQL', $selDb) ? 'selected' : '' }}>MySQL</option>
                                            <option value="PostgreSQL" {{ in_array('PostgreSQL', $selDb) ? 'selected' : '' }}>PostgreSQL</option>
                                            <option value="MongoDB" {{ in_array('MongoDB', $selDb) ? 'selected' : '' }}>MongoDB</option>
                                            <option value="Redis" {{ in_array('Redis', $selDb) ? 'selected' : '' }}>Redis</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>AI Models *</label>
                                        @php $selAI = $ts['ai_models'] ?? []; @endphp
                                        <select name="technology_stack[ai_models][]" class="form-select" id="ai-models-tech" multiple required>
                                            <option value="GPT-4" {{ in_array('GPT-4', $selAI) ? 'selected' : '' }}>GPT-4</option>
                                            <option value="BERT" {{ in_array('BERT', $selAI) ? 'selected' : '' }}>BERT</option>
                                            <option value="Med-PaLM" {{ in_array('Med-PaLM', $selAI) ? 'selected' : '' }}>Med-PaLM</option>
                                            <option value="Custom Model" {{ in_array('Custom Model', $selAI) ? 'selected' : '' }}>Custom Model</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>APIs *</label>
                                        @php $selApis = $ts['apis'] ?? []; @endphp
                                        <select name="technology_stack[apis][]" class="form-select" id="apis-tech" multiple required>
                                            <option value="OpenAI" {{ in_array('OpenAI', $selApis) ? 'selected' : '' }}>OpenAI</option>
                                            <option value="Google Maps" {{ in_array('Google Maps', $selApis) ? 'selected' : '' }}>Google Maps</option>
                                            <option value="Stripe" {{ in_array('Stripe', $selApis) ? 'selected' : '' }}>Stripe</option>
                                            <option value="Custom API" {{ in_array('Custom API', $selApis) ? 'selected' : '' }}>Custom API</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>API Integrations</label>
                                        @php $selApiInt = $project['apis_integrations'] ?? []; @endphp
                                        <select name="apis_integrations[]" class="form-select" multiple>
                                            <option value="REST API" {{ in_array('REST API', $selApiInt) ? 'selected' : '' }}>REST API</option>
                                            <option value="GraphQL" {{ in_array('GraphQL', $selApiInt) ? 'selected' : '' }}>GraphQL</option>
                                            <option value="WebSocket" {{ in_array('WebSocket', $selApiInt) ? 'selected' : '' }}>WebSocket</option>
                                            <option value="gRPC" {{ in_array('gRPC', $selApiInt) ? 'selected' : '' }}>gRPC</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Programming Languages</label>
                                        @php $selLangs = $project['programming_languages'] ?? []; @endphp
                                        <select name="programming_languages[]" class="form-select" multiple>
                                            <option value="Python" {{ in_array('Python', $selLangs) ? 'selected' : '' }}>Python</option>
                                            <option value="JavaScript" {{ in_array('JavaScript', $selLangs) ? 'selected' : '' }}>JavaScript</option>
                                            <option value="Java" {{ in_array('Java', $selLangs) ? 'selected' : '' }}>Java</option>
                                            <option value="C++" {{ in_array('C++', $selLangs) ? 'selected' : '' }}>C++</option>
                                            <option value="Go" {{ in_array('Go', $selLangs) ? 'selected' : '' }}>Go</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <h6>Infrastructure</h6>
                                @php $infra = $project['infrastructure'] ?? []; @endphp
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Deployment Type</label>
                                        <select name="infrastructure[deployment_type]" class="form-select">
                                            @foreach(['Cloud','On-Premises','Hybrid'] as $opt)
                                                <option value="{{ $opt }}" {{ ($infra['deployment_type'] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Cloud Provider</label>
                                        @php $selCloud = $infra['cloud_provider'] ?? []; @endphp
                                        <select name="infrastructure[cloud_provider][]" class="form-select" multiple>
                                            @foreach(['AWS','Azure'] as $opt)
                                                <option value="{{ $opt }}" {{ in_array($opt, $selCloud ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Containerization</label>
                                        @php $selCont = $infra['containerization'] ?? []; @endphp
                                        <select name="infrastructure[containerization][]" class="form-select" multiple>
                                            @foreach(['Docker','Kubernetes'] as $opt)
                                                <option value="{{ $opt }}" {{ in_array($opt, $selCont ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="dataSecurity">
                                @php $ds = $project['data_sources'] ?? []; @endphp
                                <h6>Data Sources</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Structure Type</label>
                                        @php $structure = is_array($ds['structure_type'] ?? null) ? ($ds['structure_type'][0] ?? '') : ($ds['structure_type'] ?? ''); @endphp
                                        <select name="data_sources_structure_type" class="form-select" required>
                                            <option value="">Select</option>
                                            <option value="Structured" {{ $structure === 'Structured' ? 'selected' : '' }}>Structured</option>
                                            <option value="Unstructured" {{ $structure === 'Unstructured' ? 'selected' : '' }}>Unstructured</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Access Type</label>
                                        @php $selAccess = $ds['access_type'] ?? []; @endphp
                                        <select name="data_sources_access_type[]" class="form-select" multiple>
                                            @foreach(['Private','Public','Restricted'] as $opt)
                                                <option value="{{ $opt }}" {{ in_array($opt, $selAccess ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Processing Type</label>
                                        @php $selProcessing = $ds['processing_type'] ?? []; @endphp
                                        <select name="data_sources_processing_type[]" class="form-select" multiple>
                                            @foreach(['Real-time','Batch'] as $opt)
                                                <option value="{{ $opt }}" {{ in_array($opt, $selProcessing ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Data Storage Location *</label>
                                        @php $dsl = $project['data_storage_location'] ?? ''; @endphp
                                        <select name="data_storage_location" class="form-select" required>
                                            <option value="Cloud-based" {{ $dsl === 'Cloud-based' ? 'selected' : '' }}>Cloud-based</option>
                                            <option value="On-Premises" {{ $dsl === 'On-Premises' ? 'selected' : '' }}>On-Premises</option>
                                        </select>
                            </div>
                            <div class="col-md-6">
                                        <label>Data Sensitivity</label>
                                        @php $selSensitivity = $project['data_sensitivity'] ?? []; @endphp
                                        <select name="data_sensitivity[]" class="form-select" multiple>
                                            @foreach(['PHI','PII'] as $opt)
                                                <option value="{{ $opt }}" {{ in_array($opt, $selSensitivity ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <h6>Security</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-3">
                                        <label>Data Encryption</label>
                                        @php $enc = $project['data_encryption'] ?? []; @endphp
                                        <input type="checkbox" name="data_encryption" class="form-check-input" id="dataEncryptionToggle" {{ ($enc['enabled'] ?? false) ? 'checked' : '' }}>
                                    </div>
                                    <div class="col-md-3 conditional-field" id="encryptionTypeContainer" style="display:none;">
                                        <label>Encryption Type</label>
                                        @php $encType = $enc['type'] ?? 'AES-256'; @endphp
                                        <select name="encryption_type" class="form-select">
                                            <option {{ $encType === 'AES-256' ? 'selected' : '' }}>AES-256</option>
                                            <option {{ $encType === 'RSA-2048' ? 'selected' : '' }}>RSA-2048</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Audit Logging</label>
                                        <input type="checkbox" name="audit_logging" class="form-check-input" {{ ($project['audit_logging'] ?? true) ? 'checked' : '' }}>
                                    </div>
                                    <div class="col-md-3">
                                        <label>User Consent Mechanism</label>
                                        <input type="checkbox" name="user_consent" class="form-check-input" {{ ($project['user_consent_mechanism'] ?? true) ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Access Control</label>
                                    @php $selAccessCtrl = $project['access_control'] ?? []; @endphp
                                    <select name="access_control[]" class="form-select" multiple>
                                        @foreach(['Role-based','MFA'] as $opt)
                                            <option value="{{ $opt }}" {{ in_array($opt, $selAccessCtrl ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="compliance">
                                <h6>Compliance</h6>
                                @php $selComp = $project['compliance_standards'] ?? []; @endphp
                                <div class="mb-3">
                                    <label>Compliance Standards</label>
                                    <select name="compliance_standards[]" class="form-select" multiple>
                                        @foreach(['HIPAA','GDPR'] as $opt)
                                            <option value="{{ $opt }}" {{ in_array($opt, $selComp ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @php $brf = $project['bias_risk_factors'] ?? []; @endphp
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="bias_identified" id="biasToggle" {{ ($brf['identified'] ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label">Bias Risk Factors Identified</label>
                            </div>
                                <div class="conditional-field mt-2" id="biasRiskDescriptionContainer" style="display:none;">
                                    <textarea name="bias_risk_description" class="form-control" placeholder="Describe bias risk factors">{{ $brf['description'] ?? '' }}</textarea>
                        </div>

                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="fairness_practices" {{ ($project['fairness_transparency_practices'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Fairness & Transparency Practices</label>
                        </div>

                                <hr>
                                <h6>AI & ML</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="has_ai_ml" {{ ($project['has_ai_ml'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Has AI/ML Components</label>
                                </div>

                                @php $selModelType = $project['ai_model_type'] ?? []; @endphp
                                <div class="my-2">
                                    <label>AI Model Type</label>
                                    <select name="ai_model_type[]" class="form-select" multiple>
                                        @foreach(['Supervised','Unsupervised','Reinforcement Learning'] as $opt)
                                            <option value="{{ $opt }}" {{ in_array($opt, $selModelType ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                        @endforeach
                                    </select>
                            </div>

                                @php $selTrainSrc = $project['training_data_source'] ?? []; @endphp
                                <div class="my-2">
                                    <label>Training Data Source</label>
                                    <select name="training_data_source[]" class="form-select" multiple>
                                        @foreach(['Proprietary','Open-source','Public Dataset','Synthetic'] as $opt)
                                            <option value="{{ $opt }}" {{ in_array($opt, $selTrainSrc ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="model_monitoring" {{ ($project['model_monitoring'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Model Monitoring</label>
                                </div>

                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="bias_detection" {{ ($project['bias_detection'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Bias Detection</label>
                                </div>

                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="automated_decision_making" {{ ($project['automated_decision_making'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Automated Decision Making</label>
                                </div>

                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="webhooks_notifications" {{ ($project['webhooks_notifications'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Webhooks & Notifications</label>
                                </div>

                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="custom_rules" {{ ($project['custom_rules'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Custom Rules</label>
                            </div>

                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="third_party_plugins" {{ ($project['third_party_plugins'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Third Party Plugins</label>
                        </div>

                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="compliance_consultation" {{ ($project['compliance_consultation'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label">Compliance Consultation</label>
                        </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('projects.list') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Project</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Choices.js: re-initialize every time the modal is shown
    function initChoicesWithDebug() {
        const multiIds = ['#backend-tech', '#frontend-tech', '#database-tech', '#ai-models-tech', '#apis-tech'];
        multiIds.forEach(id => {
            const el = document.querySelector(id);
            if (el) {
                if (el.choicesInstance) { el.choicesInstance.destroy(); }
                // Debug: log selected values
                const selected = Array.from(el.options).filter(o => o.selected).map(o => o.value);
                console.log('Choices prefill for', id, selected);
                el.choicesInstance = new Choices(el, { removeItemButton: true, searchEnabled: true, shouldSort: false });
            }
        });
        document.querySelectorAll('select[multiple]').forEach(select => {
            if (!multiIds.includes('#' + (select.id || ''))) {
                if (select.choicesInstance) { select.choicesInstance.destroy(); }
                select.choicesInstance = new Choices(select, { removeItemButton: true, searchEnabled: true, shouldSort: false });
            }
        });
    }
    // If using a modal, re-init Choices every time it's shown
    const modal = document.querySelector('.modal.show,#editProjectModal,#addProjectSidebar');
    if (modal && window.bootstrap) {
        modal.addEventListener('shown.bs.modal', function() {
            setTimeout(initChoicesWithDebug, 100);
        });
    } else {
        // fallback: run after DOM and after a short delay
        setTimeout(initChoicesWithDebug, 200);
    }

    // Tab nav
    const nextButtons = document.querySelectorAll('.next-btn');
    const prevButtons = document.querySelectorAll('.prev-btn');
    nextButtons.forEach(btn => btn.addEventListener('click', function() {
        const current = this.closest('.tab-pane');
        const next = current && current.nextElementSibling;
        if (next) {
            const tabBtn = document.querySelector(`.nav-tabs button[data-bs-target="#${next.id}"]`);
            if (tabBtn) new bootstrap.Tab(tabBtn).show();
        }
    }));
    prevButtons.forEach(btn => btn.addEventListener('click', function() {
        const current = this.closest('.tab-pane');
        const prev = current && current.previousElementSibling;
        if (prev) {
            const tabBtn = document.querySelector(`.nav-tabs button[data-bs-target="#${prev.id}"]`);
            if (tabBtn) new bootstrap.Tab(tabBtn).show();
        }
    }));

    // Show/hide encryption type and bias description
    function toggleField(id, checked) {
        const el = document.getElementById(id);
        if (el) el.style.display = checked ? 'block' : 'none';
    }
    const encToggle = document.querySelector('[name="data_encryption"]');
    if (encToggle) {
        toggleField('encryptionTypeContainer', encToggle.checked);
        encToggle.addEventListener('change', e => toggleField('encryptionTypeContainer', e.target.checked));
    }
    const biasToggle = document.querySelector('[name="bias_identified"]');
    if (biasToggle) {
        toggleField('biasRiskDescriptionContainer', biasToggle.checked);
        biasToggle.addEventListener('change', e => toggleField('biasRiskDescriptionContainer', e.target.checked));
    }

    // Helpers to gather values
    function getMultiValues(name) {
        const select = document.querySelector(`[name="${name}"]`);
        return select ? Array.from(select.selectedOptions).map(opt => opt.value) : [];
    }
    function getSingleValue(name) {
        const select = document.querySelector(`[name="${name}"]`);
        return select ? select.value : '';
    }
    function getToggle(name) {
        const input = document.querySelector(`[name="${name}"]`);
        return input ? input.checked : false;
    }

    // Submit update
    document.getElementById('editProjectForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        // Helper functions
        const form = this;
        const getMulti = name => Array.from(form.querySelectorAll(`[name='${name}'] option:checked`)).map(o => o.value);
        const getMultiBracket = name => Array.from(form.querySelectorAll(`[name^='${name}']`)).flatMap(sel => Array.from(sel.selectedOptions).map(o => o.value));
        const getSingle = name => form.querySelector(`[name='${name}']`)?.value || '';
        const getToggle = name => form.querySelector(`[name='${name}']`)?.checked || false;

        // Client-side validation for required fields
        const requiredFields = [
            ['subscription_id', 'Subscription'],
            ['project_name', 'Project Name'],
            ['project_description', 'Project Description'],
            ['industry_domain', 'Industry Domain'],
            ['status', 'Status'],
            ['data_storage_location', 'Data Storage Location']
        ];
        for (const [name, label] of requiredFields) {
            const el = form.querySelector(`[name="${name}"]`);
            const value = el ? (el.value || '').trim() : '';
            if (!value) {
                alert(`${label} is required`);
                el && el.focus();
                return;
            }
        }
        // Ensure at least one backend tech selected
        const backendSelected = Array.from(document.querySelectorAll('#backend-tech option:checked')).map(o => o.value);
        if (backendSelected.length === 0) {
            alert('Please select at least one Backend Technology');
            document.getElementById('backend-tech').focus();
            return;
        }

        // Always send valid objects for bias_risk_factors and data_encryption
        let biasIdentified = getToggle('bias_identified');
        let biasDescription = form.querySelector('[name="bias_risk_description"]')?.value || (biasIdentified ? 'Bias risk factors identified' : '');
        let biasRiskFactors = { identified: !!biasIdentified, description: biasDescription };
        let dataEncryption = { enabled: getToggle('data_encryption'), type: getSingle('encryption_type') || 'AES-256' };

        // Helper to deduplicate arrays
        const unique = arr => Array.isArray(arr) ? Array.from(new Set(arr)) : [];

        // Build payload with deduplication
            const payload = {
                subscription_id: getSingle('subscription_id'),
                project_name: getSingle('project_name'),
                project_description: getSingle('project_description'),
                industry_domain: getSingle('industry_domain'),
                status: getSingle('status'),
                technology_stack: {
                    backend: unique(getMultiBracket('technology_stack[backend]')),
                    frontend: unique(getMultiBracket('technology_stack[frontend]')),
                    database: unique(getMultiBracket('technology_stack[database]')),
                    ai_models: unique(getMultiBracket('technology_stack[ai_models]')),
                    apis: unique(getMultiBracket('technology_stack[apis]'))
                },
                programming_languages: unique(getMultiBracket('programming_languages')),
                infrastructure: {
                    deployment_type: getSingle('infrastructure[deployment_type]'),
                    cloud_provider: unique(getMultiBracket('infrastructure[cloud_provider]')),
                    containerization: unique(getMultiBracket('infrastructure[containerization]'))
                },
                apis_integrations: unique(getMultiBracket('apis_integrations')),
                data_sources: {
                    structure_type: [getSingle('data_sources_structure_type')],
                    access_type: unique(getMultiBracket('data_sources_access_type')),
                    processing_type: unique(getMultiBracket('data_sources_processing_type'))
                },
                data_storage_location: getSingle('data_storage_location'),
                data_sensitivity: unique(getMultiBracket('data_sensitivity')),
                data_encryption: {
                    enabled: Boolean(getToggle('data_encryption')),
                    type: getSingle('encryption_type') || 'AES-256'
                },
                access_control: unique(getMultiBracket('access_control')),
                audit_logging: Boolean(getToggle('audit_logging')),
                user_consent_mechanism: Boolean(getToggle('user_consent')),
                compliance_standards: unique(getMultiBracket('compliance_standards')),
                bias_risk_factors: {
                    identified: Boolean(biasIdentified),
                    description: biasDescription
                },
                fairness_transparency_practices: Boolean(getToggle('fairness_practices')),
                has_ai_ml: Boolean(getToggle('has_ai_ml')),
                ai_model_type: unique(getMultiBracket('ai_model_type')),
                training_data_source: unique(getMultiBracket('training_data_source')),
                model_monitoring: Boolean(getToggle('model_monitoring')),
                bias_detection: Boolean(getToggle('bias_detection')),
                automated_decision_making: Boolean(getToggle('automated_decision_making')),
                webhooks_notifications: Boolean(getToggle('webhooks_notifications')),
                custom_rules: Boolean(getToggle('custom_rules')),
                third_party_plugins: Boolean(getToggle('third_party_plugins')),
                compliance_consultation: Boolean(getToggle('compliance_consultation'))
            };

        try {
            const response = await fetch(this.action, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });
            const result = await response.json();
            if (response.ok && result.success) {
                alert('✅ Project updated successfully!');
                window.location.href = "{{ route('projects.list') }}";
            } else {
                alert('❌ Failed to update project: ' + (result.message || 'Unknown error'));
                console.error(result);
            }
        } catch (err) {
            alert('❌ An error occurred while updating the project');
            console.error(err);
        }
    });
});
</script>
@endpush
@endsection
