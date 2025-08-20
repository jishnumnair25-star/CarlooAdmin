@extends('layouts.default')
<meta name="access-token" content="{{ session('access_token') }}">
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Project</h4>
                </div>
                <div class="card-body">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#basicInfo" type="button">Basic Info</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#technology" type="button">Technology</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#dataSecurity" type="button">Data & Security</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#compliance" type="button">Compliance & AI/ML</button></li>
                    </ul>

                    <form id="createProjectForm" method="POST" action="{{ route('projects.store') }}">
                        @csrf
                        <div class="tab-content">
                            <!-- BASIC INFO -->
                            <div class="tab-pane fade show active" id="basicInfo">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Project Name *</label>
                                        <input name="project_name" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Project Description *</label>
                                        <textarea name="project_description" class="form-control" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Subscription ID *</label>
                                        <select name="subscription_id" class="form-select" required>
                                            <option value="">Select Subscription</option>
                                            @if (!empty($subscriptions))
                                                @foreach ($subscriptions as $subscription)
                                                    <option value="{{ $subscription['_id'] ?? $subscription['id'] ?? '' }}">
                                                        {{ $subscription['_id'] ?? $subscription['id'] ?? '' }} - {{ $subscription['pricing_tier'] ?? 'Subscription' }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option disabled>No subscriptions available</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status *</label>
                                        <select name="status" class="form-select" required>
                                            <option value="">Select</option>
                                            <option>Draft</option>
                                            <option>Pending</option>
                                            <option>Active</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Industry Domain *</label>
                                        <select name="industry_domain" class="form-select" required>
                                            <option value="">Select</option>
                                            <option value="Healthcare & MedTech">Healthcare & MedTech</option>
                                            <option>Finance</option>
                                            <option>Education</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button class="btn btn-secondary prev-btn" disabled>Previous</button>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- TECHNOLOGY -->
                            <div class="tab-pane fade" id="technology">
                                <h6>Technology Stack</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Backend Technologies *</label>
                                        <select name="technology_stack[backend][]" class="form-select" id="backend-tech" multiple required>
                                            <option value="Node.js">Node.js</option>
                                            <option value="Express">Express</option>
                                            <option value="Python">Python</option>
                                            <option value="Django">Django</option>
                                            <option value="Laravel">Laravel</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>Frontend Technologies</label>
                                        <select name="technology_stack[frontend][]" class="form-select" id="frontend-tech" multiple>
                                            <option value="React">React</option>
                                            <option value="NextJS">NextJS</option>
                                            <option value="Vue">Vue</option>
                                            <option value="Angular">Angular</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- DATA SECURITY -->
                            <div class="tab-pane fade" id="dataSecurity">
                                <h6>Data & Security</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Data Storage Location *</label>
                                        <select name="data_storage_location" class="form-select" required>
                                            <option value="">Select</option>
                                            <option value="Cloud-based">Cloud-based</option>
                                            <option value="On-premise">On-premise</option>
                                            <option value="Hybrid">Hybrid</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>Data Sensitivity</label>
                                        <select name="data_sensitivity[]" class="form-select" multiple>
                                            <option value="PHI">PHI</option>
                                            <option value="PII">PII</option>
                                            <option value="Financial">Financial</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- COMPLIANCE -->
                            <div class="tab-pane fade" id="compliance">
                                <h6>Compliance & AI/ML</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Has AI/ML</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_ai_ml" value="1">
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>Compliance Standards</label>
                                        <select name="compliance_standards[]" class="form-select" multiple>
                                            <option value="HIPAA">HIPAA</option>
                                            <option value="GDPR">GDPR</option>
                                            <option value="SOX">SOX</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="submit" class="btn btn-success">Create Project</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');
    const nextButtons = document.querySelectorAll('.next-btn');
    const prevButtons = document.querySelectorAll('.prev-btn');

    // Next button functionality
    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            const currentTab = this.closest('.tab-pane');
            const currentTabId = currentTab.id;
            
            let nextTabId = '';
            switch(currentTabId) {
                case 'basicInfo':
                    nextTabId = 'technology';
                    break;
                case 'technology':
                    nextTabId = 'dataSecurity';
                    break;
                case 'dataSecurity':
                    nextTabId = 'compliance';
                    break;
            }
            
            if (nextTabId) {
                // Hide current tab
                currentTab.classList.remove('show', 'active');
                document.querySelector(`[data-bs-target="#${currentTabId}"]`).click();
            }
        });
    });

    // Previous button functionality
    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            const currentTab = this.closest('.tab-pane');
            const currentTabId = currentTab.id;
            
            let prevTabId = '';
            switch(currentTabId) {
                case 'technology':
                    prevTabId = 'basicInfo';
                    break;
                case 'dataSecurity':
                    prevTabId = 'technology';
                    break;
                case 'compliance':
                    prevTabId = 'dataSecurity';
                    break;
            }
            
            if (prevTabId) {
                document.querySelector(`[data-bs-target="#${prevTabId}"]`).click();
            }
        });
    });
});
</script>
@endsection
