

@extends('layouts.default')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')
<div class="container-fluid">
   
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

  // Utility: initialize Choices only once per element
  function initChoicesOnce(selector, options = {}) {
    document.querySelectorAll(selector).forEach(el => {
      if (!el.classList.contains('choices__input') && !el.choicesInstance) {
        el.choicesInstance = new Choices(el, options);
      }
    });
  }

  // Initialize all multi-selects safely
  initChoicesOnce('#backend-tech', {
    removeItemButton: true,
    searchEnabled: true,
    placeholderValue: "Select backend technologies",
    shouldSort: false
  });
  initChoicesOnce('#frontend-tech', {
    removeItemButton: true,
    searchEnabled: true,
    placeholderValue: "Select frontend technologies",
    shouldSort: false
  });
  initChoicesOnce('#database-tech', {
    removeItemButton: true,
    searchEnabled: true,
    placeholderValue: "Select database technologies",
    shouldSort: false
  });
  initChoicesOnce('#ai-models-tech', {
    removeItemButton: true,
    searchEnabled: true,
    placeholderValue: "Select AI models",
    shouldSort: false
  });
  initChoicesOnce('#apis-tech', {
    removeItemButton: true,
    searchEnabled: true,
    placeholderValue: "Select APIs",
    shouldSort: false
  });
  // All other multi-selects
  initChoicesOnce('select[multiple]:not(#backend-tech):not(#frontend-tech):not(#database-tech):not(#ai-models-tech):not(#apis-tech)', {
    removeItemButton: true,
    searchEnabled: true,
    shouldSort: false
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
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>User Frameworks</h4>
                <!-- <span>Datatable</span> -->
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li> -->
                <!-- <li class="breadcrumb-item active"><a href="javascript:void(0)" data-bs-target="#userFrameworkModal">Datatable</a></li> -->
            </ol>


            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userFrameworkModal">
    Create User Framework
</button>

           <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userFrameworkModal" width="50px" fdprocessedid="6ufqo" style="
    width: 260px;
    height: 50px;
    font-size: -12px;
">
    Create User Framework
</button> -->
        </div>
    </div>
    <!-- row -->
    <div class="row">
       

        






       <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Frameworks</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example5" class="display table table-bordered" style="min-width: 1000px;">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <div class="form-check custom-checkbox ms-2">
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Version</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Active</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 <tbody>
    @foreach ($frameworks as $index => $framework)
    <tr>
        <td>
            <div class="form-check custom-checkbox ms-2">
                <input type="checkbox" class="form-check-input" id="checkbox_{{ $index }}">
                <label class="form-check-label" for="checkbox_{{ $index }}"></label>
            </div>
        </td>
        <td>#{{ $framework['id'] }}</td>
        <td>{{ $framework['name'] }}</td>
        <td>{{ $framework['description'] }}</td>
        <td>{{ $framework['version'] }}</td>
        <td>{{ $framework['user_username'] }}</td>
        <td>
            <span class="badge light badge-danger">
                <i class="fa fa-circle text-danger me-1"></i> {{ $framework['status'] }}
            </span>
        </td>
        <td>
            <span class="badge light {{ $framework['is_active'] ? 'badge-success' : 'badge-danger' }}">
                <i class="fa fa-circle me-1 {{ $framework['is_active'] ? 'text-success' : 'text-danger' }}"></i>
                {{ $framework['is_active'] ? 'Yes' : 'No' }}
            </span>
        </td>
        <td>{{ \Carbon\Carbon::parse($framework['created_at'])->format('d/m/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($framework['updated_at'])->format('d/m/Y') }}</td>
        <td>
            <div class="dropdown ms-auto text-end">
                <div class="btn-link" data-bs-toggle="dropdown">
                    <svg width="24px" height="24px" viewBox="0 0 24 24">
                        <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                        <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                    </svg>
                </div>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item edit-framework-btn" href="#" data-id="{{ $framework['id'] }}">Edit</a>
                   <!-- <li>
  <a class="dropdown-item delete-framework-btn" href="#" data-id="{{ $framework['id'] }}">
    Delete
  </a> </li> -->
   <li>
  <a href="#" class="dropdown-item text-danger delete-framework" data-id="{{ $framework['id'] }}">
    Delete
  </a>
</li>

<script>
$(document).on('click', '.delete-framework', function(e) {
    e.preventDefault();
    let id = $(this).data('id');

    if (!confirm('Are you sure you want to delete this framework?')) return;

    $.ajax({
        url: '/frameworks/' + id,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            alert(response.message);
            location.reload(); // or remove row dynamically
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert('Failed to delete framework.');
        }
    });
});
</script>
                    <!-- <a class="dropdown-item" href="#">View Details</a> -->
<!-- <a class="dropdown-item view-framework-btn" href="#" data-id="{{ $framework['id'] }}">View Details</a> -->
                </div>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>


                </table>
            </div>
        </div>
    </div>
</div>



    </div>
</div>

<div class="modal fade" id="frameworkModal" tabindex="-1" aria-labelledby="frameworkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Framework</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="frameworkModalBody">
        <!-- AJAX loaded content will appear here -->
        <div id="frameworkDetailsContent"></div>
      </div>
    </div>
  </div>
</div>

        <!-- Dynamic content will be loaded here -->
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function () {
  $('.view-framework-btn').on('click', function () {
    var frameworkId = $(this).data('id');
    $('#frameworkModalBody').html('<div class="text-center"><div class="spinner-border" role="status"></div></div>');
    $.ajax({
      url: '/framework/' + frameworkId,
      method: 'GET',
      success: function (response) {
        if (response.framework) {
          renderFrameworkDetails(response.framework);
        } else if (response.html) {
          $('#frameworkModalBody').html(response.html);
        } else {
          $('#frameworkModalBody').html('<p class="text-danger">No details available.</p>');
        }
        var modal = new bootstrap.Modal(document.getElementById('frameworkModal'));
        modal.show();
      },
      error: function () {
        $('#frameworkModalBody').html('<p class="text-danger">Error loading details.</p>');
      }
    });
  });

  // Render framework details in modal
  function renderFrameworkDetails(framework) {
    let statusBadge = '';
    if (framework.status) {
      let badgeClass = 'bg-secondary';
      if (framework.status === 'Draft') badgeClass = 'bg-purple';
      if (framework.status === 'Active') badgeClass = 'bg-success';
      if (framework.status === 'Archived') badgeClass = 'bg-dark';
      statusBadge = `<span class="badge ${badgeClass}" style="float:right;font-size:1rem;">${framework.status}</span>`;
    }

    let html = `<div class="container-fluid">
      <div class="mb-2">
        <a href="#" class="fw-bold text-primary">View Framework</a>
      </div>
      <h4 class="fw-bold">${framework.name || ''}</h4>
      ${statusBadge}
      <div class="row mt-3">
        <div class="col-md-6 mb-3">
          <div class="card p-3">
            <h6 class="fw-bold">Description</h6>
            <div>${framework.description || ''}</div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="card p-3">
            <h6 class="fw-bold"><i class="fa fa-info-circle me-1"></i>Framework Details</h6>
            <div>Version<br><span class="fw-bold"><i class="fa fa-code-fork me-1"></i>${framework.version || ''}</span></div>
            <div class="mt-2">Created By<br><span class="fw-bold"><i class="fa fa-user me-1"></i>${framework.user_username || ''}</span></div>
          </div>
        </div>
      </div>
      <div class="card p-3 mb-3">
        <h6 class="fw-bold"><i class="fa fa-sitemap me-1"></i>Governance Frameworks</h6>
        ${(framework.selected_governance_frameworks || []).map(gf => `<span class="badge bg-primary me-2 mb-2">${gf.name || gf}</span>`).join('')}
      </div>
      <div class="mb-2">
        <h6 class="fw-bold"><i class="fa fa-shield-alt me-1"></i>Custom Rules</h6>
        ${(framework.custom_rules && framework.custom_rules.length) ? framework.custom_rules.map(rule => `
          <div class="card p-3 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="fw-bold">${rule.rule_name || ''}</span>
              <span class="badge bg-warning text-dark"><i class="fa fa-exclamation-triangle me-1"></i>${rule.severity || ''}</span>
            </div>
            <div>${rule.rule_description || ''}</div>
            <div class="mt-2"><i class="fa fa-folder me-1"></i>Category<br>${rule.compliance_category || ''}</div>
            <div class="mt-2">Keywords:<br>${(rule.keywords || []).map(k => `<span class="badge bg-light text-dark border me-1">${k}</span>`).join('')}</div>
          </div>
        `).join('') : '<div class="text-muted">No custom rules.</div>'}
      </div>
    </div>`;
    $('#frameworkModalBody').html(`<div id="frameworkDetailsContent">${html}</div>`);
  }
});
<script>
$(document).ready(function () {
  // DELETE FRAMEWORK LOGIC
  $(document).on('click', '.delete-framework-btn', function (e) {
    e.preventDefault();
    var $btn = $(this);
    var frameworkId = $btn.data('id');
    if (!frameworkId) {
      alert('Framework ID not found.');
      return;
    }
    if (!confirm('Are you sure you want to delete this framework?')) return;
    const token = "{{ session('access_token') }}";
    if (!token) {
      alert('No access token found. Please log in again.');
      return;
    }
    const $row = $btn.closest('tr');
    $btn.prop('disabled', true).text('Deleting...');
    console.log('Attempting to delete framework ID:', frameworkId);
    $.ajax({
      url: 'https://carlo.algorethics.ai/api/user-frameworks/' + frameworkId,
      type: 'DELETE',
      headers: {
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json'
      },
      success: function (res) {
        console.log('Delete success:', res);
        alert(res.message || 'Framework deleted successfully!');
        $row.fadeOut(300, function() {
          $(this).remove();
          // Fallback: if row is not removed, reload the page
          if ($('tr', $row.closest('tbody')).length === 0) {
            location.reload();
          }
        });
      },
      error: function (xhr) {
        let msg = 'Error deleting framework: ';
        if (xhr.status === 401) {
          msg += 'Unauthorized. Please log in again.';
        } else if (xhr.status === 404) {
          msg += 'Framework not found.';
        } else if (xhr.responseJSON && xhr.responseJSON.message) {
          msg += xhr.responseJSON.message;
        } else if (xhr.responseText) {
          msg += xhr.responseText;
        } else {
          msg += 'Unknown error.';
        }
        console.error('Delete error:', xhr);
        alert(msg);
        // Fallback: reload page if error is not clear
        setTimeout(function() { location.reload(); }, 1500);
      },
      complete: function() {
        $btn.prop('disabled', false).text('Delete');
      }
    });
  });
});
</script>

<script>
$(document).ready(function () {
  // --- EDIT FRAMEWORK LOGIC ---
  let editingFrameworkId = null;

  // Open edit modal and load data
  $(document).on('click', '.edit-framework-btn', function (e) {
    e.preventDefault();
    editingFrameworkId = $(this).data('id');
    // Reset form and UI
    const $form = $('#userFrameworkForm');
    $form[0].reset();
    $('#custom-rules-container').empty();
    $('#custom-rules-section').addClass('d-none');
    $('#userFrameworkModal .modal-title').text('Edit User Framework');
    $('#userFrameworkModal button[type="submit"]').text('Update Framework');

    // Fetch framework data
    $.ajax({
      url: '/framework/' + editingFrameworkId,
      method: 'GET',
      success: function (response) {
        if (response.framework) {
          fillFrameworkForm(response.framework);
          var modal = new bootstrap.Modal(document.getElementById('userFrameworkModal'));
          modal.show();
        } else {
          alert('Could not load framework data.');
        }
      },
      error: function () {
        alert('Error loading framework data.');
      }
    });
  });

  // Fill the form with framework data
  function fillFrameworkForm(framework) {
    const $form = $('#userFrameworkForm');
    $form.find('[name="name"]').val(framework.name || '');
    $form.find('[name="version"]').val(framework.version || '');
    $form.find('[name="description"]').val(framework.description || '');
    $form.find('[name="status"]').val(framework.status || 'Draft');
    $form.find('[name="is_active"]').prop('checked', !!framework.is_active);

    // Governance frameworks (multi-select)
    if (framework.selected_governance_frameworks) {
      $form.find('[name="selected_governance_frameworks[]"] option').each(function () {
        const val = $(this).val();
        $(this).prop('selected', framework.selected_governance_frameworks.includes(val) || framework.selected_governance_frameworks.some(f => f.id == val));
      });
      $form.find('[name="selected_governance_frameworks[]"]').trigger('change');
    }

    // Custom rules
    $('#custom-rules-container').empty();
    if (framework.custom_rules && framework.custom_rules.length) {
      $('#custom-rules-section').removeClass('d-none');
      framework.custom_rules.forEach((rule, idx) => {
        const ruleFields = `
          <div class="rule-group border p-3 mt-3 rounded" data-index="${idx}" style="background-color: #f9f9f9;">
            <div class="row mb-2">
              <div class="col-md-6">
                <label class="form-label">Rule Name</label>
                <input type="text" name="custom_rules[${idx}][name]" class="form-control" value="${rule.rule_name || ''}">
              </div>
              <div class="col-md-6">
                <label class="form-label">Severity</label>
                <select name="custom_rules[${idx}][severity]" class="form-select">
                  <option value="Low" ${rule.severity === 'Low' ? 'selected' : ''}>Low</option>
                  <option value="Medium" ${rule.severity === 'Medium' ? 'selected' : ''}>Medium</option>
                  <option value="High" ${rule.severity === 'High' ? 'selected' : ''}>High</option>
                  <option value="Critical" ${rule.severity === 'Critical' ? 'selected' : ''}>Critical</option>
                </select>
              </div>
            </div>
            <div class="mb-2">
              <label class="form-label">Rule Description</label>
              <textarea name="custom_rules[${idx}][description]" class="form-control">${rule.rule_description || ''}</textarea>
            </div>
            <div class="mb-2">
              <label class="form-label">Compliance Category</label>
              <input type="text" name="custom_rules[${idx}][compliance_category]" class="form-control" value="${rule.compliance_category || ''}">
            </div>
            <div class="mb-2">
              <label class="form-label">Keywords (comma-separated)</label>
              <input type="text" name="custom_rules[${idx}][keywords]" class="form-control" value="${(rule.keywords || []).join(', ')}">
            </div>
            <button type="button" class="btn btn-danger mt-2 remove-rule-btn">Remove Rule</button>
          </div>
        `;
        $('#custom-rules-container').append(ruleFields);
      });
    }
  }

  // Intercept form submit for edit
  $('#userFrameworkForm').off('submit').on('submit', function (e) {
    e.preventDefault();
    // Build custom_rules array with correct keys and types
    let customRules = [];
    $('#custom-rules-container .rule-group').each(function () {
      const index = $(this).data('index');
      customRules.push({
        rule_name: $(`[name="custom_rules[${index}][name]"]`).val(),
        rule_description: $(`[name="custom_rules[${index}][description]"]`).val(),
        severity: $(`[name="custom_rules[${index}][severity]"]`).val(),
        compliance_category: $(`[name="custom_rules[${index}][compliance_category]"]`).val(),
        keywords: $(`[name="custom_rules[${index}][keywords]"]`).val().split(',').map(k => k.trim()).filter(Boolean)
      });
    });

    // Build selected_governance_frameworks array
    let selectedFrameworks = [];
    $("[name='selected_governance_frameworks[]'] option:selected").each(function () {
      selectedFrameworks.push($(this).val());
    });

    // Get and trim all required fields
    const name = ($('[name="name"]').val() || '').trim();
    const version = ($('[name="version"]').val() || '').trim();
    const description = ($('textarea[name="description"]').val() || '').trim();
    const status = ($('#userFrameworkForm select[name="status"]').val() || '').trim();
    const is_active = $('#isActive').is(':checked');

    // Validate required fields before sending
    if (!name) {
      alert('The name field is required.');
      return;
    }
    if (!version) {
      alert('The version field is required.');
      return;
    }
    if (!description) {
      alert('The description field is required.');
      return;
    }
    if (!status) {
      alert('The status field is required.');
      return;
    }
    if (!selectedFrameworks.length) {
      alert('Please select at least one Governance Framework.');
      return;
    }

    const payload = {
      name: name,
      version: version,
      description: description,
      status: status,
      is_active: is_active,
      selected_governance_frameworks: selectedFrameworks,
      custom_rules: customRules
    };

    // CSRF token
    const csrfToken = $("input[name='_token']").val();

    // If editing, use PUT and API endpoint
    if (editingFrameworkId) {
      $.ajax({
        url: 'https://carlo.algorethics.ai/api/user-frameworks/' + editingFrameworkId,
        type: 'PUT',
        data: JSON.stringify(payload),
        contentType: 'application/json',
        headers: {
          'Authorization': 'Bearer ' + token,
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        success: function (res) {
          alert(res.message || 'Framework updated successfully!');
          $('#userFrameworkModal').modal('hide');
          location.reload();
        },
        error: function (xhr) {
          let msg = 'Error: ';
          if (xhr.responseJSON && xhr.responseJSON.message) {
            msg += xhr.responseJSON.message;
          } else {
            msg += xhr.responseText;
          }
          alert(msg);
        }
      });
    } else {
      // Otherwise, create as before (POST)
      $.ajax({
        url: this.action,
        type: 'POST',
        data: JSON.stringify(payload),
        contentType: 'application/json',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        success: function (res) {
          alert(res.message || 'Framework created successfully!');
          $('#userFrameworkModal').modal('hide');
          location.reload();
        },
        error: function (xhr) {
          let msg = 'Error: ';
          if (xhr.responseJSON && xhr.responseJSON.message) {
            msg += xhr.responseJSON.message;
          } else {
            msg += xhr.responseText;
          }
          alert(msg);
        }
      });
    }
  });

  // Reset editing state when modal closes
  $('#userFrameworkModal').on('hidden.bs.modal', function () {
    editingFrameworkId = null;
    $('#userFrameworkModal .modal-title').text('Create User Framework');
    $('#userFrameworkModal button[type="submit"]').text('Save Framework');
    $('#custom-rules-container').empty();
    $('#custom-rules-section').addClass('d-none');
    $('#userFrameworkForm')[0].reset();
  });
});
</script>


<!-- --------------------------------------------------------------------------------models --------------------------------------------------->


<div class="modal fade" id="userFrameworkModal" tabindex="-1" aria-labelledby="userFrameworkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <form id="userFrameworkForm" method="POST" action="{{ route('user-frameworks.store') }}">
    @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User Framework</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Name & Version -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Version *</label>
                            <input type="text" name="version" class="form-control" required>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>

                    <!-- Status & Active -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Status *</label>
              <select name="status" class="form-select" required>
                <option value="Draft">Draft</option>
                <option value="Active">Active</option>
                <option value="Archived">Archived</option>
              </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                                <label class="form-check-label" for="isActive">Is Active</label>
                            </div>
                        </div>
                    </div>

                    <!-- Governance Frameworks -->
                    <div class="mb-3">
                        <label class="form-label">Governance Frameworks *</label>
                        <select name="selected_governance_frameworks[]" class="form-select" multiple required>
                            @if(isset($governanceFrameworks) && is_array($governanceFrameworks))
                                @foreach($governanceFrameworks as $gf)
                                    <option value="{{ $gf['id'] ?? '' }}">{{ $gf['name'] ?? ('Framework #' . ($gf['id'] ?? '')) }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Custom Rules Section -->
                    <div id="custom-rules-section" class="d-none">
                        <h5 class="mt-4">Custom Rules</h5>
                        <div id="custom-rules-container"></div>
                    </div>

                    <button type="button" class="btn btn-dark mt-3" id="addRuleBtn">Add Custom Rule</button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Framework</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
$(document).ready(function () {
  $('#userFrameworkForm').on('submit', function (e) {
    e.preventDefault();

    // Build custom_rules array with correct keys and types
    let customRules = [];
    $('#custom-rules-container .rule-group').each(function () {
      const index = $(this).data('index');
      customRules.push({
        rule_name: $(`[name="custom_rules[${index}][name]"]`).val(),
        rule_description: $(`[name="custom_rules[${index}][description]"]`).val(),
        severity: $(`[name="custom_rules[${index}][severity]"]`).val(),
        compliance_category: $(`[name="custom_rules[${index}][compliance_category]"]`).val(),
        keywords: $(`[name="custom_rules[${index}][keywords]"]`).val().split(',').map(k => k.trim()).filter(Boolean)
      });
    });

    // Build selected_governance_frameworks array
    let selectedFrameworks = [];
    $("[name='selected_governance_frameworks[]'] option:selected").each(function () {
      selectedFrameworks.push($(this).val());
    });



    // Get and trim all required fields
    const name = ($('[name="name"]').val() || '').trim();
    const version = ($('[name="version"]').val() || '').trim();
    const description = ($('textarea[name="description"]').val() || '').trim();
  const status = ($('#userFrameworkForm select[name="status"]').val() || '').trim();
    const is_active = $('#isActive').is(':checked');

    // Debug log all values
    console.log('Form debug:', {
      name,
      version,
      description,
      status,
      is_active,
      selectedFrameworks,
      customRules
    });

    // Validate required fields before sending
    if (!name) {
      alert('The name field is required.');
      return;
    }
    if (!version) {
      alert('The version field is required.');
      return;
    }
    if (!description) {
      alert('The description field is required.');
      return;
    }
    if (!status) {
      alert('The status field is required.');
      return;
    }
    if (!selectedFrameworks.length) {
      alert('Please select at least one Governance Framework.');
      return;
    }

    const payload = {
      name: name,
      version: version,
      description: description,
      status: status,
      is_active: is_active,
      selected_governance_frameworks: selectedFrameworks,
      custom_rules: customRules
    };

    // CSRF token
    const csrfToken = $("input[name='_token']").val();

    $.ajax({
      url: this.action,
      type: 'POST',
      data: JSON.stringify(payload),
      contentType: 'application/json',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      success: function (res) {
        alert(res.message || 'Framework created successfully!');
        $('#userFrameworkModal').modal('hide');
        location.reload();
      },
      error: function (xhr) {
        let msg = 'Error: ';
        if (xhr.responseJSON && xhr.responseJSON.message) {
          msg += xhr.responseJSON.message;
        } else {
          msg += xhr.responseText;
        }
        alert(msg);
      }
    });
  });
});
</script>
<!-- Script -->
<script>
let ruleIndex = 0;

document.getElementById('addRuleBtn').addEventListener('click', function () {
    document.getElementById('custom-rules-section').classList.remove('d-none');

  const ruleFields = `
    <div class="rule-group border p-3 mt-3 rounded" data-index="${ruleIndex}" style="background-color: #f9f9f9;">
      <div class="row mb-2">
        <div class="col-md-6">
          <label class="form-label">Rule Name</label>
          <input type="text" name="custom_rules[${ruleIndex}][name]" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Severity</label>
          <select name="custom_rules[${ruleIndex}][severity]" class="form-select">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
            <option value="Critical">Critical</option>
          </select>
        </div>
      </div>
      <div class="mb-2">
        <label class="form-label">Rule Description</label>
        <textarea name="custom_rules[${ruleIndex}][description]" class="form-control"></textarea>
      </div>
      <div class="mb-2">
        <label class="form-label">Compliance Category</label>
        <input type="text" name="custom_rules[${ruleIndex}][compliance_category]" class="form-control">
      </div>
      <div class="mb-2">
        <label class="form-label">Keywords (comma-separated)</label>
        <input type="text" name="custom_rules[${ruleIndex}][keywords]" class="form-control">
      </div>
      <button type="button" class="btn btn-danger mt-2 remove-rule-btn">Remove Rule</button>
    </div>
  `;

    document.getElementById('custom-rules-container').insertAdjacentHTML('beforeend', ruleFields);
    ruleIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-rule-btn')) {
        e.target.closest('.rule-group').remove();
        if (document.querySelectorAll('#custom-rules-container .rule-group').length === 0) {
            document.getElementById('custom-rules-section').classList.add('d-none');
        }
    }
});
</script>


<!-- ------------------------------------------------------- ----------------------------------------------------------- -->
@endsection
<!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
$(document).ready(function () {
    let ruleIndex = 0;

   
    $('#addRuleBtn').on('click', function () {
        $('#custom-rules-section').removeClass('d-none');

        const ruleFields = `
            <div class="rule-group border p-3 mt-3 rounded" data-index="${ruleIndex}" style="background-color: #f9f9f9;">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Rule Name</label>
                        <input type="text" name="custom_rules[${ruleIndex}][name]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Severity</label>
                        <input type="text" name="custom_rules[${ruleIndex}][severity]" class="form-control" value="Low" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">Rule Description</label>
                    <textarea name="custom_rules[${ruleIndex}][description]" class="form-control" required></textarea>
                </div>

                <div class="mb-2">
                    <label class="form-label">Compliance Category</label>
                    <input type="text" name="custom_rules[${ruleIndex}][compliance_category]" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Keywords (comma-separated)</label>
                    <input type="text" name="custom_rules[${ruleIndex}][keywords]" class="form-control" required>
                </div>

                <button type="button" class="btn btn-danger mt-2 remove-rule-btn">Remove Rule</button>
            </div>
        `;
        $('#custom-rules-container').append(ruleFields);
        ruleIndex++;
    });

    
    $(document).on('click', '.remove-rule-btn', function () {
        $(this).closest('.rule-group').remove();
        if ($('#custom-rules-container .rule-group').length === 0) {
            $('#custom-rules-section').addClass('d-none');
        }
    });

   
    $('#userFrameworkForm').on('submit', function (e) {
        e.preventDefault();

      
        let customRules = [];

        $('#custom-rules-container .rule-group').each(function () {
            const index = $(this).data('index');
            customRules.push({
                rule_name: $(`[name="custom_rules[${index}][name]"]`).val(),
                rule_description: $(`[name="custom_rules[${index}][description]"]`).val(),
                severity: $(`[name="custom_rules[${index}][severity]"]`).val(),
                compliance_category: $(`[name="custom_rules[${index}][compliance_category]"]`).val(),
                keywords: $(`[name="custom_rules[${index}][keywords]"]`).val().split(',').map(k => k.trim())
            });
        });

        
        const payload = {
            name: $('[name="name"]').val(),
            version: $('[name="version"]').val(),
            description: $('[name="description"]').val(),
            status: $('[name="status"]').val(),
            is_active: $('#isActive').is(':checked'),
            selected_governance_frameworks: [
                $('[name="governance_framework"]').val()
            ],
            custom_rules: customRules
        };

        console.log("Submitting: ", payload); 

        axios.post('https://carlo.algorethics.ai/api/user-frameworks', payload)
            .then(res => {
                alert('User Framework created successfully!');
                $('#userFrameworkModal').modal('hide');
                $('#userFrameworkForm')[0].reset();
                $('#custom-rules-container').empty();
                $('#custom-rules-section').addClass('d-none');
            })
            .catch(err => {
                console.error(err);
                alert('Error: Could not create framework.');
            });
    });
});
</script> -->
