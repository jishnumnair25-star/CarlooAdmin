@extends('layouts.default')
<meta name="access-token" content="{{ session('access_token') }}">
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid">
	

<!-- -----------------------------------Creating the project --------------------------------------------------->
<script>
    const token = "{{ session('access_token') }}";
</script>

<!-- Modal -->
<div class="modal fade" id="addProjectSidebar" tabindex="-1" aria-labelledby="createProjectLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Create New Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
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
                  <textarea   name="project_description" class="form-control" required></textarea>
                </div>
             <div class="col-md-6">
    <label class="form-label">Subscription *</label>
    <select name="subscription_id" id="subscriptionSelect" class="form-select" required>
        <option value="">Loading...</option>
        @if (!empty($subscriptions) && count($subscriptions))
            @foreach ($subscriptions as $subscription)
                @php
                    $sid = $subscription['_id'] ?? $subscription['id'] ?? $subscription['subscription_id'] ?? '';
                    $label = ($subscription['pricing_tier'] ?? $subscription['plan_name'] ?? 'Subscription') . ' - ' . ($subscription['status'] ?? '');
                @endphp
                @if($sid)
                    <option value="{{ $sid }}">{{ $sid }} - {{ $label }}</option>
                @endif
            @endforeach
        @else
            <option value="" disabled>No subscriptions available</option>
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
                  <select name="industry_domain"  class="form-select" required>
                    <option value="">Select</option>
                   <option value="AI & Machine Learning">AI & Machine Learning</option>
                    <option value="Finance & Banking">Finance & Banking</option>
                    <option value="Healthcare & MedTech">Healthcare & MedTech</option>
                    <option value="Legal & Compliance">Legal & Compliance</option>
                    <option value="Retail & E-commerce">Retail & E-commerce</option>
                     <option value="Government & Public Sector">Government & Public Sector</option>
                      <option value="Other">Other</option>
                  </select>
                </div>
              </div>
<!-- ----------------------------Optionaly added ----------------------------------------------- -->

              <div class="mb-3">
    <label for="ai_models" class="form-label">AI Models Used</label>
    <input type="text" name="ai_models" class="form-control" placeholder="e.g. GPT-4, BERT" required>
</div>
<div class="mb-3">
    <label for="apis" class="form-label">APIs Used</label>
    <input type="text" name="apis" class="form-control" placeholder="e.g. OpenAI API, Google Maps API" required>
</div>
<!-- ------------------------------------------------------------------------------------------------------- -->

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
        <select  name="technology_stack[frontend][]" class="form-select" id="frontend-tech" multiple>
          <option value="React">React</option>
          <option value="NextJS">NextJS</option>
          <option value="Vue">Vue</option>
          <option value="Angular">Angular</option>
        </select>
      </div>
      
      <div class="col-md-6">
        <label>Database Technologies *</label>
        <select name="technology_stack[database][]" class="form-select" id="database-tech" multiple required>
          <option value="MySQL">MySQL</option>
          <option value="PostgreSQL">PostgreSQL</option>
          <option value="MongoDB">MongoDB</option>
          <option value="Redis">Redis</option>
        </select>
      </div>
      
      <div class="col-md-6">
        <label>AI Models *</label>
        <select name="technology_stack[ai_models][]" class="form-select" id="ai-models-tech" multiple required>
          <option value="GPT-4">GPT-4</option>
          <option value="BERT">BERT</option>
          <option value="Med-PaLM">Med-PaLM</option>
          <option value="Custom Model">Custom Model</option>
        </select>
      </div>
      
      <div class="col-md-6">
        <label>APIs *</label>
        <select name="technology_stack[apis][]" class="form-select" id="apis-tech" multiple required>
          <option value="OpenAI">OpenAI</option>
          <option value="Google Maps">Google Maps</option>
          <option value="Stripe">Stripe</option>
          <option value="Custom API">Custom API</option>
        </select>
      </div>
      
      <div class="col-md-6">
        <label>API Integrations</label>
        <select name="apis_integrations[]" class="form-select" multiple>
          <option value="REST API">REST API</option>
          <option value="GraphQL">GraphQL</option>
          <option value="WebSocket">WebSocket</option>
          <option value="gRPC">gRPC</option>
        </select>
      </div>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize multi-select dropdowns
    const backendTech = new Choices('#backend-tech', {
        removeItemButton: true,
        searchEnabled: true,
        placeholderValue: "Select backend technologies",
        shouldSort: false
    });
    
    const frontendTech = new Choices('#frontend-tech', {
        removeItemButton: true,
        searchEnabled: true,
        placeholderValue: "Select frontend technologies",
        shouldSort: false
    });
    
    const databaseTech = new Choices('#database-tech', {
        removeItemButton: true,
        searchEnabled: true,
        placeholderValue: "Select database technologies",
        shouldSort: false
    });
    
    const aiModelsTech = new Choices('#ai-models-tech', {
        removeItemButton: true,
        searchEnabled: true,
        placeholderValue: "Select AI models",
        shouldSort: false
    });
    
    const apisTech = new Choices('#apis-tech', {
        removeItemButton: true,
        searchEnabled: true,
        placeholderValue: "Select APIs",
        shouldSort: false
    });
    
    // Initialize other multi-selects similarly
    const otherMultiSelects = document.querySelectorAll('select[multiple]:not(#backend-tech):not(#frontend-tech):not(#database-tech):not(#ai-models-tech):not(#apis-tech)');
    otherMultiSelects.forEach(select => {
        new Choices(select, {
            removeItemButton: true,
            searchEnabled: true,
            shouldSort: false
        });
    });
    
    // Your existing tab navigation code
    const nextButtons = document.querySelectorAll('.next-btn');
    const prevButtons = document.querySelectorAll('.prev-btn');
    
    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            const currentTab = this.closest('.tab-pane');
            const nextTab = currentTab.nextElementSibling;
            
            if (nextTab) {
                const nextTabId = nextTab.id;
                const tabButton = document.querySelector(`.nav-tabs button[data-bs-target="#${nextTabId}"]`);
                if (tabButton) {
                    const tabInstance = new bootstrap.Tab(tabButton);
                    tabInstance.show();
                }
            }
        });
    });
    
    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            const currentTab = this.closest('.tab-pane');
            const prevTab = currentTab.previousElementSibling;
            
            if (prevTab) {
                const prevTabId = prevTab.id;
                const tabButton = document.querySelector(`.nav-tabs button[data-bs-target="#${prevTabId}"]`);
                if (tabButton) {
                    const tabInstance = new bootstrap.Tab(tabButton);
                    tabInstance.show();
                }
            }
        });
    });
});
</script>
                <div class="col-md-6">
                  <label>Frontend Technologies</label>
                  <select class="form-select" multiple>
                    <option>React</option>
                    <option>NextJS</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Database Technologies</label>
                  <select class="form-select" multiple>
                    <option>MongoDB</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>AI Models</label>
                  <select class="form-select" multiple>
                    <option>GPT-4</option>
                    <option>Med-PaLM</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>APIs</label>
                  <select class="form-select" multiple>
                    <option>OpenAI</option>
                  </select>
                </div>
                <div class="col-md-6">

                   <style>
                    
.mt-100 {
    margin-top: 50px;
}

body {
    background: grey;
    color: #514B64;
    min-height: 100vh
}
h2 {
  color: darkgreen;
}

#css-dropdown
{
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    width: 300px;
    height: 42px;
    margin: 100px auto 0 auto;
}
                   </style>
<div class="row d-flex justify-content-center mt-100">
    <div class="col-md-6"> <select id="choices-multiple-remove-button" placeholder="Select up to 3 tags" multiple>
            <option value="Author" onclick="filterSelection('Author')">Author</option>
            <option value="MSelect">Multiselect Dropdown</option>
            <option value="Accordions" >Accordions</option>
            <option value="Radio Buttons">Radio Buttons</option>
            <option value="SearchBox">Search Boxes</option>
            <option value="Tables">Tables</option>
            <option value="Profiles">Profiles</option>
            <option value="Sliders">Sliders</option>
            <option value="Tabs">Tabs</option>
            <option value="NavMenu">Navigation Menu</option>
            <option value="Cities">Cities</option>
            <option value="Countries">Countries</option>
            <option value="Regions">Regions</option>
        </select>
  </div>
</div>
<br><br>
</section>

<script>
  $(document).ready(function(){

 var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
 removeItemButton: true,
 maxItemCount:3,
 searchResultLimit:5,
 renderChoiceLimit:5
 });


 });
</script>


                  <label>Programming Languages</label>
                  <select name="programming_languages[]" class="form-select" multiple>
                    <option value="Python">Python</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="Java">Java</option>
                    <option value="C++">C++</option>
                    <option value="Go">Go</option>
                  </select>
                </div>
              </div>
              <hr>
              <h6>Infrastructure</h6>
              <div class="row g-3">
                <div class="col-md-6">
                  <label>Deployment Type</label>
                  <select name="infrastructure[deployment_type]" class="form-select">
                    <option value="Cloud">Cloud</option>
                    <option value="On-Premises">On-Premises</option>
                    <option value="Hybrid">Hybrid</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Cloud Provider</label>
                  <select name="infrastructure[cloud_provider][]" class="form-select" multiple>
                    <option value="AWS">AWS</option>
                    <option value="Azure">Azure</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Containerization</label>
                  <select name="infrastructure[containerization][]" class="form-select" multiple>
                    <option value="Docker">Docker</option>
                    <option value="Kubernetes">Kubernetes</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
              </div>
            </div>

           
            <div class="tab-pane fade" id="dataSecurity">
              <h6>Data Sources</h6>
              <div class="row g-3">
                               <div class="col-md-4">
                <label for="structure_type" class="form-label">Structure Type</label>
                <select name="data_sources_structure_type" class="form-select" required>
                  <option value="">Select</option>
                  <option value="Structured">Structured</option>
                  <option value="Unstructured">Unstructured</option>
              </select>
              </div>
                <div class="col-md-4">
                  <label>Access Type</label>
                  <select name="data_sources_access_type[]" class="form-select" multiple>
                    <option value="Private">Private</option>
                    <option value="Public">Public</option>
                    <option value="Restricted">Restricted</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Processing Type</label>
                  <select name="data_sources_processing_type[]" class="form-select" multiple>
                    <option value="Real-time">Real-time</option>
                    <option value="Batch">Batch</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Data Storage Location *</label>
                  <select name="data_storage_location" class="form-select" required>
                    <option>Cloud-based</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Data Sensitivity</label>
                  <select name="data_sensitivity[]" class="form-select" multiple>
                    <option value="PHI">PHI</option>
                    <option value="PII">PII</option>
                  </select>
                </div>
              </div>

              <hr>
              <h6>Security</h6>
              <div class="row g-3 align-items-center">
                <div class="col-md-3">
                  <label>Data Encryption</label>
                  <input type="checkbox" name="data_encryption" class="form-check-input" id="dataEncryptionToggle">
                </div>
                <div class="col-md-3 conditional-field" id="encryptionTypeContainer" style="display:none;">
                  <label>Encryption Type</label>
                  <select  name="encryption_type" class="form-select">
                    <option>AES-256</option>
                    <option>RSA-2048</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Audit Logging</label>
                  <input type="checkbox" name="audit_logging" class="form-check-input" checked>
                </div>
                <div class="col-md-3">
                  <label>User Consent Mechanism</label>
                  <input type="checkbox" name="user_consent" class="form-check-input" checked>
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <label>Access Control</label>
                <select name="access_control[]" class="form-select" multiple>
                  <option value="Role-based">Role-based</option>
                  <option value="MFA">MFA</option>
                </select>
              </div>

              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
              </div>
            </div>

            
            <div class="tab-pane fade" id="compliance">
              <h6>Compliance</h6>
              <div class="mb-3">
                <label>Compliance Standards</label>
                <select name="compliance_standards[]" class="form-select" multiple>
                  <option value="HIPAA">HIPAA</option>
                  <option value="GDPR">GDPR</option>
                </select>
              </div>

              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox"  name="bias_identified" id="biasToggle">
                <label class="form-check-label">Bias Risk Factors Identified</label>
              </div>
              <div class="conditional-field mt-2" id="biasRiskDescriptionContainer" style="display:none;">
                <textarea name="bias_risk_description" class="form-control" placeholder="Describe bias risk factors"></textarea>
              </div>

              <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" name="fairness_practices" checked>
                <label class="form-check-label">Fairness & Transparency Practices</label>
              </div>

              <hr>
              <h6>AI & ML</h6>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="has_ai_ml" checked>
                <label class="form-check-label">Has AI/ML Components</label>
              </div>

              <div class="my-2">
                <label>AI Model Type</label>
                <select name="ai_model_type[]" class="form-select" multiple>
                  <option value="Supervised">Supervised</option>
                  <option value="Unsupervised">Unsupervised</option>
                  <option value="Reinforcement Learning">Reinforcement Learning</option>
                </select>
              </div>
              <div class="my-2">
                <label>Training Data Source</label>
                <select name="training_data_source[]" class="form-select" multiple>
                  <option value="Proprietary">Proprietary</option>
                  <option value="Open-source">Open-source</option>
                  <option value="Public Dataset">Public Dataset</option>
                  <option value="Synthetic">Synthetic</option>
                </select>
              </div>

              <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" name="model_monitoring" checked>
                <label class="form-check-label">Model Monitoring</label>
              </div>

              <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" name="bias_detection" checked>
                <label class="form-check-label">Bias Detection</label>
              </div>

              <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" name="automated_decision_making" checked>
                <label class="form-check-label">Automated Decision Making</label>
              </div>

              <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" name="webhooks_notifications" checked>
                <label class="form-check-label">Webhooks & Notifications</label>
              </div>

              <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" name="custom_rules" checked>
                <label class="form-check-label">Custom Rules</label>
              </div>

              <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" name="third_party_plugins" checked>
                <label class="form-check-label">Third Party Plugins</label>
              </div>

              <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" name="compliance_consultation" checked>
                <label class="form-check-label">Compliance Consultation</label>
              </div>

              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="submit" class="btn btn-success create-btn">Create Project</button>

              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>


<!-- JavaScript Logic -->
<script>
  // Tab Switching
  function nextTab(tabId) {
    const tabTrigger = document.querySelector(`button[data-bs-target="#${tabId}"]`);
    if (tabTrigger) new bootstrap.Tab(tabTrigger).show();
  }

  // Show/hide encryption and AI fields
  function toggleField(id, checkbox) {
    const el = document.getElementById(id);
    if (el) {
      el.style.display = checkbox.checked ? 'block' : 'none';
    }
  }

  // Helpers
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

  // Submit Logic
  document.getElementById("createProjectForm").addEventListener("submit", async function (e) {
    e.preventDefault();
    
    // Validate required fields
    const structureType = getSingleValue("data_sources_structure_type");
    if (!structureType) {
      alert("Please select a Structure Type");
      return;
    }
    
    const biasIdentified = getToggle("bias_identified");
    const biasDescription = document.querySelector('[name="bias_risk_description"]')?.value || "";
    if (biasIdentified && !biasDescription.trim()) {
      alert("Please provide a description for bias risk factors when bias is identified");
      return;
    }

    // Create FormData object to collect all form data
    const formData = new FormData(this);
    
    // Add additional form fields that might not be captured by FormData
    const additionalData = {
      technology_stack: {
        backend: getMultiValues("technology_stack[backend][]"),
        frontend: getMultiValues("technology_stack[frontend][]"),
        database: getMultiValues("technology_stack[database][]"),
        ai_models: getMultiValues("technology_stack[ai_models][]"),
        apis: getMultiValues("technology_stack[apis][]")
      },
      programming_languages: getMultiValues("programming_languages[]"),
      infrastructure: {
        deployment_type: getSingleValue("infrastructure[deployment_type]"),
        cloud_provider: getMultiValues("infrastructure[cloud_provider][]"),
        containerization: getMultiValues("infrastructure[containerization][]")
      },
      apis_integrations: getMultiValues("apis_integrations[]"),
      data_sources: {
        structure_type: [getSingleValue("data_sources_structure_type")], // Convert to array
        access_type: getMultiValues("data_sources_access_type[]"),
        processing_type: getMultiValues("data_sources_processing_type[]")
      },
      data_sensitivity: getMultiValues("data_sensitivity[]"),
      data_encryption: {
        enabled: getToggle("data_encryption"),
        type: getSingleValue("encryption_type") || "AES-256"
      },
      access_control: getMultiValues("access_control[]"),
      audit_logging: getToggle("audit_logging"),
      user_consent_mechanism: getToggle("user_consent"),
      compliance_standards: getMultiValues("compliance_standards[]"),
      bias_risk_factors: {
        identified: getToggle("bias_identified"),
        description: document.querySelector('[name="bias_risk_description"]')?.value || (getToggle("bias_identified") ? "Bias risk factors identified" : "")
      },
      fairness_transparency_practices: getToggle("fairness_practices"),
      has_ai_ml: getToggle("has_ai_ml"),
      ai_model_type: getMultiValues("ai_model_type[]"),
      training_data_source: getMultiValues("training_data_source[]"),
      model_monitoring: getToggle("model_monitoring"),
      bias_detection: getToggle("bias_detection"),
      automated_decision_making: getToggle("automated_decision_making"),
      webhooks_notifications: getToggle("webhooks_notifications"),
      custom_rules: getToggle("custom_rules"),
      third_party_plugins: getToggle("third_party_plugins"),
      compliance_consultation: getToggle("compliance_consultation")
    };

    // Append additional data to FormData
    Object.keys(additionalData).forEach(key => {
      if (typeof additionalData[key] === 'object') {
        formData.append(key, JSON.stringify(additionalData[key]));
      } else {
        formData.append(key, additionalData[key]);
      }
    });

    // Remove simple arrays from FormData and append them directly
    // This prevents arrays from being stringified
    const simpleArrays = ['programming_languages', 'apis_integrations', 'data_sensitivity', 'access_control', 'compliance_standards', 'ai_model_type', 'training_data_source'];
    
    simpleArrays.forEach(fieldName => {
      formData.delete(fieldName);
      const values = getMultiValues(fieldName + '[]');
      values.forEach(value => {
        formData.append(fieldName + '[]', value);
      });
    });

    // Log the form data for debugging
    console.log('Form data being sent:', Object.fromEntries(formData));
    console.log('Additional data:', additionalData);

    try {
      const response = await fetch("{{ route('projects.store') }}", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
          "Accept": "application/json"
        },
        body: formData
      });

      const result = await response.json();

      if (response.ok) {
        alert("✅Project created successfully!");
        // Close modal and reload
        const modal = bootstrap.Modal.getInstance(document.getElementById('addProjectSidebar'));
        if (modal) modal.hide();
        location.reload();
      } else {
        alert("Failed to create project: " + (result.message || "Unknown error"));
        console.error(result);
      }
    } catch (err) {
      alert("Network or system error occurred.");
      console.error(err);
    }
  });
  window.addEventListener('DOMContentLoaded', function () {
    toggleField('encryptionTypeContainer', document.querySelector('[name="data_encryption"]'));
    toggleField('aiFields', document.querySelector('[name="has_ai_ml"]'));
    toggleField('biasRiskDescriptionContainer', document.querySelector('[name="bias_identified"]'));
  });
  
  document.addEventListener('DOMContentLoaded', function() {
    const biasToggle = document.querySelector('[name="bias_identified"]');
    if (biasToggle) {
      biasToggle.addEventListener('change', function() {
        toggleField('biasRiskDescriptionContainer', this);
      });
    }
  });
</script>




<!-- -------------------------------------------------End Model--------------------------------------------------------------------- -->

<!-- Add Project Button -->
<div class="row mb-4">
  <div class="col-12">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectSidebar">
      <i class="fas fa-plus"></i> Create New Project
    </button>
  </div>
</div>








	<!-- <div class="modal fade" id="addProjectSidebar">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create Project</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form>
                        @csrf
						<div class="form-group">
							<label class="text-black font-w500">Project Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
									<label class="text-black font-w500">Dadeline</label>
									<div class="cal-icon"><input type="date" class="form-control"><i class="far fa-calendar-alt"></i></div>
								</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary">CREATE</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
<div class="row">
		<div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
			<div class="card card-bd">
				<div class="bg-secondary card-border"></div>
				<div class="card-body box-style">
					<div class="media align-items-center">
						<div class="media-body me-3">
    <h2 id="project-count" class="num-text text-black font-w700" style="font-size:28px;">0</h2>
    <span class="fs-14">Total Projects</span>


</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('https://carlo.algorethics.ai/api/project/my-projects', {
        headers: {
            'Authorization': 'Bearer {{ session('access_token') }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('API request failed: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        // Check response structure
        const projectCount = Array.isArray(data) ? data.length : (data?.data?.length ?? 0);
        document.getElementById('project-count').textContent = projectCount;
    })
    .catch(error => {
        console.error('Error fetching project count:', error);
    });
});
</script>
						<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M34.422 13.9831C34.3341 13.721 34.1756 13.4884 33.9638 13.3108C33.7521 13.1332 33.4954 13.0175 33.222 12.9766L23.649 11.5141L19.353 2.36408C19.2319 2.10638 19.0399 1.88849 18.7995 1.73587C18.5591 1.58325 18.2803 1.5022 17.9955 1.5022C17.7108 1.5022 17.4319 1.58325 17.1915 1.73587C16.9511 1.88849 16.7592 2.10638 16.638 2.36408L12.342 11.5141L2.76902 12.9766C2.49635 13.0181 2.24042 13.1341 2.02937 13.3117C1.81831 13.4892 1.6603 13.7215 1.57271 13.9831C1.48511 14.2446 1.47133 14.5253 1.53287 14.7941C1.59441 15.063 1.72889 15.3097 1.92152 15.5071L8.89802 22.6501L7.24802 32.7571C7.20299 33.0345 7.23679 33.3189 7.34555 33.578C7.45431 33.8371 7.63367 34.0605 7.86319 34.2226C8.09271 34.3847 8.36315 34.4791 8.64371 34.495C8.92426 34.5109 9.20365 34.4477 9.45002 34.3126L18 29.5906L26.55 34.3126C26.7964 34.4489 27.0761 34.5131 27.3573 34.4978C27.6384 34.4826 27.9096 34.3885 28.1398 34.2264C28.37 34.0643 28.5499 33.8406 28.659 33.5811C28.768 33.3215 28.8018 33.0365 28.7565 32.7586L27.1065 22.6516L34.0785 15.5071C34.2703 15.3091 34.4037 15.0622 34.4643 14.7933C34.5249 14.5245 34.5103 14.2441 34.422 13.9831Z" fill="#864AD1"/>
						</svg>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
			<div class="card card-bd">
			<div class="bg-warning card-border"></div>
				<div class="card-body box-style">
					<div class="media align-items-center">
						<div class="media-body me-3">
    <h2 id="compliance-requests" class="num-text text-black font-w700" style="font-size:28px;">0</h2>
    <span class="fs-14">Compliance Requests</span>
</div>
						<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17.8935 22.5C23.6925 22.5 28.3935 17.799 28.3935 12C28.3935 6.20101 23.6925 1.5 17.8935 1.5C12.0945 1.5 7.39351 6.20101 7.39351 12C7.39351 17.799 12.0945 22.5 17.8935 22.5Z" fill="#FFB930"/>
							<path d="M29.5605 21.3344C29.217 20.9909 28.851 20.6699 28.476 20.3564C27.2159 21.96 25.6078 23.2562 23.7733 24.1472C21.9388 25.0382 19.9259 25.5007 17.8864 25.4996C15.847 25.4986 13.8345 25.0342 12.0009 24.1414C10.1673 23.2486 8.56051 21.9507 7.30199 20.3459C5.447 21.8906 3.95577 23.8256 2.9347 26.013C1.91364 28.2003 1.3879 30.586 1.39499 32.9999C1.39499 33.3978 1.55303 33.7793 1.83433 34.0606C2.11564 34.3419 2.49717 34.4999 2.89499 34.4999H32.895C33.2928 34.4999 33.6743 34.3419 33.9557 34.0606C34.237 33.7793 34.395 33.3978 34.395 32.9999C34.4004 30.8324 33.9759 28.6854 33.146 26.683C32.3162 24.6807 31.0975 22.8627 29.5605 21.3344Z" fill="#FFB930"/>
						</svg>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
			<div class="card card-bd">
			<div class="bg-primary card-border"></div>
				<div class="card-body box-style">
					<div class="media align-items-center">
						<div class="media-body me-3">
    <h2 id="average-score" class="num-text text-black font-w700" style="font-size:28px;">0</h2>
    <span class="fs-14">Average Score</span>
</div>

						<svg class="primary-icon" width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M11.9999 1.5H5.99994C3.51466 1.5 1.49994 3.51472 1.49994 6V29.8125C1.49994 32.2977 3.51466 34.3125 5.99994 34.3125H11.9999C14.4852 34.3125 16.4999 32.2977 16.4999 29.8125V6C16.4999 3.51472 14.4852 1.5 11.9999 1.5Z" fill="#20F174"/>
							<path d="M30 1.5H24C21.5147 1.5 19.5 3.51472 19.5 6V12C19.5 14.4853 21.5147 16.5 24 16.5H30C32.4853 16.5 34.5 14.4853 34.5 12V6C34.5 3.51472 32.4853 1.5 30 1.5Z" fill="#20F174"/>
							<path d="M30 19.5H24C21.5147 19.5 19.5 21.5147 19.5 24V30C19.5 32.4853 21.5147 34.5 24 34.5H30C32.4853 34.5 34.5 32.4853 34.5 30V24C34.5 21.5147 32.4853 19.5 30 19.5Z" fill="#20F174"/>
						</svg>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
			<div class="card card-bd">
				<div class="bg-info card-border"></div>
				<div class="card-body box-style">
					<div class="media align-items-center">
						<div class="media-body me-3">
    <h2 id="risk-score" class="num-text text-black font-w700" style="font-size:28px;">0</h2>
    <span class="fs-14">Risk Score</span>
</div>

						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield text-danger" aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
					</div>
				</div>
			</div>
		</div>
	</div>



  <script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('https://carlo.algorethics.ai/api/dashboard/stats', {
        headers: {
            'Authorization': 'Bearer {{ session('access_token') }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('API request failed: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        const stats = data?.data;

        if (stats) {
            document.getElementById('compliance-requests').textContent = stats.total_compliance_requests ?? 0;
            document.getElementById('average-score').textContent = stats.average_compliance_score ?? 0;
            document.getElementById('risk-score').textContent = stats.risk_score ?? 0;
        }
    })
    .catch(error => {
        console.error('Error fetching dashboard stats:', error);
    });
});
</script>
	
	<style>
    body {
      background-color: #f8fafc;
      color: #0f172a;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      background-color: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      margin-bottom: 20px;
      color: #0f172a;
    }
    .btn-primary {
      background-color: #2563eb;
      border: none;
    }
    .status-badge {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 12px;
      color: white;
    }
    .status-done { background: #10b981; }
    .status-tomorrow { background: #facc15; color: #000; }
    .status-expired { background: #ef4444; }
    .in-progress { background: #f59e0b; }
    canvas {
      height: 220px !important;
    }
  </style>

<div class="container-fluid p-4">
  <div class="row">
    <div class="col-md-8">
      <div class="card p-3">
        <h5>Subscriptions</h5>
        <canvas id="lineChart"></canvas>
      </div>
      <div class="card p-3">
        <div class="d-flex justify-content-between">
          <h5>Market Overview</h5>
          <!-- <button class="btn btn-outline-dark btn-sm">This Month</button> -->
        </div>
        <h3 id="avg-compliance-score">0</h3>
        <canvas id="barChart"></canvas>
      </div>
      <div class="card p-3 text-center">
        <h5>Enhance your <strong>Campaign</strong> for better outreach</h5>
       <a href="{{ url('ui-card')}}"> <button class="btn btn-primary mt-3">Upgrade Account</button></a>
      </div>
     <div class="card p-3">
  <h5>Recent Compliance Activity</h5>
  <div class="d-flex justify-content-end mb-2">
    <button class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#addProjectSidebar">+ Add new Project</button>
  </div>
  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Project Name</th>
        <th>Request ID</th>
        <th>Score</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="recent-projects-table">
      <!-- Rows will be injected here -->
    </tbody>
  </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  fetch('https://carlo.algorethics.ai/api/dashboard/stats', {
    headers: {
      'Authorization': 'Bearer {{ session('access_token') }}',
      'Accept': 'application/json'
    }
  })
  .then(response => {
    if (!response.ok) throw new Error("Failed to fetch dashboard stats.");
    return response.json();
  })
  .then(data => {
    const recent = data?.data?.recent_compliance_activity ?? [];
    const tableBody = document.getElementById('recent-projects-table');
    
    if (recent.length === 0) {
      tableBody.innerHTML = `<tr><td colspan="4" class="text-center">No recent activity.</td></tr>`;
      return;
    }

    // Generate rows
    let rows = '';
    recent.forEach(activity => {
      const statusText = activity.is_compliant ? 'Compliant' : 'In progress';
      const statusClass = activity.is_compliant ? 'bg-success text-white' : 'bg-warning text-dark';
      
      rows += `
        <tr>
          <td>${activity.project_name}</td>
          <td>${activity.request_id}</td>
          <td>${activity.compliance_score * 100}%</td>
          <td><span class="badge ${statusClass}">${statusText}</span></td>
        </tr>
      `;
    });

    tableBody.innerHTML = rows;
  })
  .catch(error => {
    console.error('Error:', error);
    document.getElementById('recent-projects-table').innerHTML =
      `<tr><td colspan="4" class="text-danger text-center">Error loading data.</td></tr>`;
  });
});
</script>
</div>

    <div class="col-md-4">
      <div class="card p-3">
        <h5>Status Summary</h5>
        <p>Closed Value: <strong>357</strong></p>
        <p>Total Visitors: 26.80%</p>
        <p>Visits per Day: 9065</p>
      </div>

      <!-- <div class="card p-3">
        <h5>Todo List</h5>
        <ul class="list-unstyled">
          <li>📌 Lorem ipsum (24 June 2022) <span class="status-badge status-tomorrow">Due Tomorrow</span></li>
          <li>📌 Lorem ipsum (24 June 2022) <span class="status-badge status-done">Done</span></li>
          <li>📌 Lorem ipsum (24 June 2022) <span class="status-badge status-done">Done</span></li>
          <li>📌 Lorem ipsum (24 June 2022) <span class="status-badge status-expired">Expired</span></li>
        </ul>
      </div> -->

      <div class="card p-3">
        <h5>Dashboard Analyze</h5>
        <canvas id="donutChart"></canvas>
      </div>
    </div>
  </div>
</div>

@php
$chartDateToPending = [];
$chartDateToCanceled = [];
$chartLabels = [];
$chartPending = [];
$chartCanceled = [];

if (!empty($subscriptions)) {
  foreach ($subscriptions as $item) {
    $sub = $item['subscription'] ?? [];
    $status = strtolower($sub['status'] ?? '');
    $amount = isset($sub['amount']) ? (float) $sub['amount'] : null;
    $dateStr = $sub['start_date'] ?? $sub['created_at'] ?? null;

    if ($amount === null || !$dateStr) {
      continue;
    }

    try {
      $dateKey = \Carbon\Carbon::parse($dateStr)->format('Y-m-d');
    } catch (Exception $e) {
      continue;
    }

    if ($status === 'pending') {
      $chartDateToPending[$dateKey] = ($chartDateToPending[$dateKey] ?? 0) + $amount;
    } elseif ($status === 'canceled' || $status === 'cancelled') {
      $chartDateToCanceled[$dateKey] = ($chartDateToCanceled[$dateKey] ?? 0) + $amount;
    }
  }

  $allDates = array_unique(array_merge(array_keys($chartDateToPending), array_keys($chartDateToCanceled)));
  sort($allDates);

  foreach ($allDates as $d) {
    $chartLabels[] = $d;
    $chartPending[] = (float) ($chartDateToPending[$d] ?? 0);
    $chartCanceled[] = (float) ($chartDateToCanceled[$d] ?? 0);
  }
}
@endphp

<script>
document.addEventListener("DOMContentLoaded", function () {
  // Line Chart
  const labels = @json($chartLabels ?? []);
  const pendingSeries = @json($chartPending ?? []);
  const canceledSeries = @json($chartCanceled ?? []);

  const lineChartData = (labels.length > 0)
    ? {
        labels,
        datasets: [
          {
            label: 'Pending',
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37, 99, 235, 0.10)',
            data: pendingSeries,
            fill: false,
            tension: 0.3
          },
          {
            label: 'Canceled',
            borderColor: '#ef4444',
            backgroundColor: 'rgba(239, 68, 68, 0.10)',
            data: canceledSeries,
            fill: false,
            tension: 0.3
          }
        ]
      }
    : {
        labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
        datasets: [
          {
            label: 'Pending',
            borderColor: '#2563eb',
            data: [60, 80, 70, 90, 65, 85, 78],
            fill: false
          },
          {
            label: 'Canceled',
            borderColor: '#ef4444',
            data: [40, 60, 50, 70, 55, 65, 60],
            fill: false
          }
        ]
      };

  new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: lineChartData,
    options: {
      responsive: true,
      plugins: { legend: { labels: { color: '#0f172a' } } },
      scales: {
        x: {
          ticks: { color: '#0f172a' },
          title: { display: true, text: 'Subscription Date', color: '#0f172a' }
        },
        y: {
          ticks: { color: '#0f172a' },
          title: { display: true, text: 'Total Amount (USD)', color: '#0f172a' }
        }
      }
    }
  });

  // Bar Chart - Compliance score by Project ID (single blue dataset)
  (function renderComplianceBarChart() {
    const ctx = document.getElementById('barChart');
    if (!ctx) return;

    const headers = {
      'Authorization': 'Bearer {{ session('access_token') }}',
      'Accept': 'application/json'
    };

    fetch('https://carlo.algorethics.ai/api/dashboard/stats', { headers })
      .then(r => { if (!r.ok) throw new Error('Failed to fetch stats'); return r.json(); })
      .then(json => {
        // Update the average compliance score header
        try {
          const avg = Number(json?.data?.average_compliance_score ?? 0);
          const el = document.getElementById('avg-compliance-score');
          if (el) el.textContent = `Average Compliance Score: ${avg.toFixed(2)}`;
        } catch (_) {}

        const activity = (json?.data?.recent_compliance_activity || []).slice(0, 20);
        // One bar per activity entry; label with request_id; value is raw compliance_score (0..1)
        const labels = activity.map(item => item.request_id || 'Unknown');
        const scores = activity.map(item => {
          const score = (typeof item.compliance_score === 'number') ? item.compliance_score : 0;
          return Number(score.toFixed(2));
        });

        new Chart(ctx, {
          type: 'bar',
          data: {
            labels,
            datasets: [
              {
                label: 'Compliance Score',
                backgroundColor: '#2563eb',
                borderColor: '#2563eb',
                data: scores
              }
            ]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { labels: { color: '#0f172a' } },
              tooltip: {
                callbacks: {
                  label: ctx => `${ctx.parsed.y}`
                }
              }
            },
            scales: {
              x: {
                ticks: { color: '#0f172a' },
                title: { display: true, text: 'Request ID', color: '#0f172a' }
              },
              y: {
                ticks: {
                  color: '#0f172a',
                  callback: value => `${value}`
                },
                title: { display: true, text: 'Compliance Score', color: '#0f172a' },
                suggestedMin: 0,
                suggestedMax: 1
              }
            }
          }
        });
      })
      .catch(err => {
        console.error('Error loading bar chart data', err);
      });
  })();

  // Donut Chart (uses same values as KPI cards)
  const donutCtx = document.getElementById('donutChart');
  const donutChart = new Chart(donutCtx, {
    type: 'doughnut',
    data: {
      labels: ['Total Projects', 'Compliance Requests', 'Average Score', 'Risk Score'],
      datasets: [{
        backgroundColor: ['#2563eb', '#ef4444', '#10b981', '#f59e0b'],
        data: [0, 0, 0, 0]
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { labels: { color: '#0f172a' } } }
    }
  });

  // Fetch the same values shown in the KPI cards and update the donut
  const headers = {
    'Authorization': 'Bearer {{ session('access_token') }}',
    'Accept': 'application/json'
  };

  const fetchProjectCount = fetch('https://carlo.algorethics.ai/api/project/my-projects', { headers })
    .then(r => { if (!r.ok) throw new Error('projects'); return r.json(); })
    .then(json => Array.isArray(json) ? json.length : (json?.data?.length ?? 0))
    .catch(() => 0);

  const fetchStats = fetch('https://carlo.algorethics.ai/api/dashboard/stats', { headers })
    .then(r => { if (!r.ok) throw new Error('stats'); return r.json(); })
    .then(json => json?.data ?? {})
    .catch(() => ({}));

  Promise.all([fetchProjectCount, fetchStats]).then(([projectCount, stats]) => {
    const complianceRequests = Number(stats.total_compliance_requests ?? 0);
    const averageScore = Number(stats.average_compliance_score ?? 0);
    const riskScore = Number(stats.risk_score ?? 0);

    donutChart.data.datasets[0].data = [
      Number(projectCount) || 0,
      complianceRequests,
      averageScore,
      riskScore
    ];
    donutChart.update();
  });
});
</script>
</div>
@endsection

@push('scripts')
	
@endpush