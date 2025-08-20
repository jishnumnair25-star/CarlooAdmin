<!-- resources/views/projects/create.blade.php -->
@extends('layouts.default')
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

    <title>@yield('title')</title>
</head>
<body>
    @yield('content')

    <!-- jQuery first, then Bootstrap JS, then Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    @yield('scripts')
</body>
</html>
@section('content')
<div class="container">
    <h1>Create New Project</h1>
    
  <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab">Basic Info</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="technology-tab" data-bs-toggle="tab" data-bs-target="#technology" type="button" role="tab">Technology</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="data-security-tab" data-bs-toggle="tab" data-bs-target="#data-security" type="button" role="tab">Data & Security</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="compliance-tab" data-bs-toggle="tab" data-bs-target="#compliance" type="button" role="tab">Compliance & AI/ML</button>
    </li>
</ul>

   <form method="POST" action="{{ route('projects.store') }}">
    @csrf

    <!-- Example for Basic Info tab -->
    <input type="text" name="project_name" required>
    <textarea name="project_description" required></textarea>
    <select name="subscription_id" required>
        <option value="">Select Subscription</option>
        @if (!empty($subscriptions))
            @foreach($subscriptions as $subscription)
                <option value="{{ $subscription['_id'] ?? $subscription['id'] ?? '' }}">
                    {{ $subscription['_id'] ?? $subscription['id'] ?? '' }} - {{ $subscription['pricing_tier'] ?? 'Subscription' }}
                </option>
            @endforeach
        @else
            <option disabled>No subscriptions available</option>
        @endif
    </select>
    <select name="status" required>
        <option value="draft">Draft</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
    <select name="industry_domain" required>
        <option value="Finance">Finance</option>
        <option value="Healthcare & MedTech">Healthcare & MedTech</option>
    </select>

    <!-- Technology Stack -->
    <select name="technology_stack[backend][]" multiple class="select2-multiple">
        <option value="Node.js">Node.js</option>
        <option value="Express">Express</option>
        <option value="MongoDB">MongoDB</option>
    </select>
    <select name="technology_stack[frontend][]" multiple class="select2-multiple">
        <option value="React">React</option>
        <option value="NextJS">NextJS</option>
    </select>
    <select name="technology_stack[database][]" multiple class="select2-multiple">
        <option value="MongoDB">MongoDB</option>
    </select>
    <select name="technology_stack[ai_models][]" multiple class="select2-multiple">
        <option value="GPT-4">GPT-4</option>
        <option value="Med-PaLM">Med-PaLM</option>
    </select>
    <select name="technology_stack[apis][]" multiple class="select2-multiple">
        <option value="OpenAI API">OpenAI API</option>
        <option value="Google Med-PaLM API">Google Med-PaLM API</option>
    </select>

    <!-- Programming Languages -->
    <select name="programming_languages[]" multiple class="select2-multiple">
        <option value="JavaScript">JavaScript</option>
        <option value="TypeScript">TypeScript</option>
        <option value="Python">Python</option>
    </select>

    <!-- Infrastructure -->
    <select name="infrastructure[deployment_type]">
        <option value="Cloud">Cloud</option>
    </select>
    <select name="infrastructure[cloud_provider][]" multiple class="select2-multiple">
        <option value="AWS">AWS</option>
        <option value="Azure">Azure</option>
    </select>
    <select name="infrastructure[containerization][]" multiple class="select2-multiple">
        <option value="Docker">Docker</option>
        <option value="Kubernetes">Kubernetes</option>
    </select>

    <select name="apis_integrations[]" multiple class="select2-multiple">
        <option value="OpenAI">OpenAI</option>
        <option value="Google Cloud Healthcare API">Google Cloud Healthcare API</option>
        <option value="EHR Integration">EHR Integration</option>
    </select>

    <!-- Data Sources -->
    <select name="data_sources[structure_type][]" multiple class="select2-multiple">
        <option value="Structured">Structured</option>
        <option value="Unstructured">Unstructured</option>
    </select>
    <select name="data_sources[access_type][]" multiple class="select2-multiple">
        <option value="Private">Private</option>
    </select>
    <select name="data_sources[processing_type][]" multiple class="select2-multiple">
        <option value="Real-time">Real-time</option>
        <option value="Batch">Batch</option>
    </select>

    <select name="data_storage_location">
        <option value="Cloud-based">Cloud-based</option>
    </select>

    <select name="data_sensitivity[]" multiple class="select2-multiple">
        <option value="PHI">PHI</option>
        <option value="PII">PII</option>
    </select>

    <!-- Security -->
    <input type="checkbox" name="data_encryption" value="1">
    <select name="encryption_type">
        <option value="AES-256">AES-256</option>
    </select>

    <select name="access_control[]" multiple class="select2-multiple">
        <option value="Role-based">Role-based</option>
        <option value="Multi-factor authentication">Multi-factor authentication</option>
    </select>

    <input type="checkbox" name="audit_logging" value="1">
    <input type="checkbox" name="user_consent" value="1">

    <!-- Compliance -->
    <select name="compliance_standards[]" multiple class="select2-multiple">
        <option value="HIPAA">HIPAA</option>
        <option value="GDPR">GDPR</option>
        <option value="EU AI Act">EU AI Act</option>
    </select>

    <input type="checkbox" name="bias_identified" value="1">
    <textarea name="bias_risk_description"></textarea>

    <input type="checkbox" name="fairness_practices" value="1">
    <input type="checkbox" name="compliance_consultation" value="1">

    <!-- AI/ML -->
    <input type="checkbox" name="has_ai_ml" value="1">
    <select name="ai_model_type[]" multiple class="select2-multiple">
        <option value="Supervised">Supervised</option>
        <option value="Reinforcement Learning">Reinforcement Learning</option>
    </select>
    <select name="training_data_source[]" multiple class="select2-multiple">
        <option value="Proprietary">Proprietary</option>
        <option value="Open-source">Open-source</option>
    </select>
    <input type="checkbox" name="model_monitoring" value="1">
    <input type="checkbox" name="bias_detection" value="1">
    <input type="checkbox" name="automated_decision_making" value="1">
    <input type="checkbox" name="webhooks_notifications" value="1">
    <input type="checkbox" name="custom_rules" value="1">
    <input type="checkbox" name="third_party_plugins" value="1">

    <button type="submit">Create Project</button>
</form>

</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 with Bootstrap 5 theme
    $('.select2-multiple').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: "Select options",
        allowClear: true
    });

    // Show/hide encryption type
    $('#data_encryption').change(function () {
        $('.encryption-type').toggle(this.checked);
    });

    // Validate fields before moving to next tab
    $('.next-tab').on('click', function () {
        var currentTabPane = $(this).closest('.tab-pane');
        var isValid = true;

        // Check required fields in current tab
        currentTabPane.find('input, select, textarea').each(function () {
            if ($(this).prop('required') && !$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            // Optionally scroll to first invalid input
            currentTabPane.find('.is-invalid').first().focus();
            return;
        }

        // Move to next tab
        var nextTabId = $(this).data('next');
        var nextTab = $('button[data-bs-target="' + nextTabId + '"]');
        var tabTrigger = new bootstrap.Tab(nextTab[0]);
        tabTrigger.show();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Move to previous tab
    $('.prev-tab').on('click', function () {
        var prevTabId = $(this).data('prev');
        var prevTab = $('button[data-bs-target="' + prevTabId + '"]');
        var tabTrigger = new bootstrap.Tab(prevTab[0]);
        tabTrigger.show();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
</script>

@endsection