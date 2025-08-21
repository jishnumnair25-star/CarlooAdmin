@extends('layouts.default')

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
                <h4>Hi, welcome back!</h4>
                <p class="mb-0">Your business dashboard </p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                
                <li class="breadcrumb-item active"><a href="javascript:void(0)">My Tickets</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">My Tickets</h4> 
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTicketModal">
    <i class="bi bi-plus-circle"></i> Create Ticket
</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>Ticket ID</strong></th>
                                <th><strong>Title</strong></th>
                                <th><strong>Date</strong></th>
                                <th><strong>Status</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                       <tbody id="ticketsTableBody">
                            @forelse ($tickets as $index => $ticket)
                                <tr>
                                    <td><strong>{{ str_pad($index+1, 2, '0', STR_PAD_LEFT) }}</strong></td>
                                    <td>{{ $ticket['id'] }}</td>
                                    <td>{{ $ticket['subject'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($ticket['created_at'])->format('d M Y') }}</td>
                                    <td>
                                        @php
                                            $statusLabels = [
                                                '1' => ['text' => 'Successful', 'class' => 'success'],
                                                '2' => ['text' => 'Canceled', 'class' => 'danger'],
                                                '3' => ['text' => 'Pending', 'class' => 'warning'],
                                            ];
                                            $status = $statusLabels[$ticket['status']] ?? ['text' => 'Unknown', 'class' => 'secondary'];
                                        @endphp
                                        <span class="badge light badge-{{ $status['class'] }}">{{ $status['text'] }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-{{ $status['class'] }} light sharp" data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" cx="5" cy="12" r="2"/>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"/>
                                                        <circle fill="#000000" cx="19" cy="12" r="2"/>
                                                    </g>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('tickets/'.$ticket['id']) }}">View</a>
                                                <!-- <a class="dropdown-item text-danger ticket-delete" data-id="{{ $ticket['id'] }}" href="javascript:void(0);">Delete</a> -->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No tickets found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- --------------------------------------------Ticket Model ------------------------------------------------------------- -->
<div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="createTicketModalLabel">Create New Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="createTicketForm" action="{{ route('tickets.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Subject *</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter ticket subject" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Department *</label>
                        <select name="department_id" id="ticketDepartmentSelect" class="form-select" required>
                            <option value="">Select Department</option>
                            <option value="1">Hosting Support</option>
                            <option value="2">SSL Support</option>
                            <option value="3">Domain Support</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Priority *</label>
                        <select name="priority" id="ticketPrioritySelect" class="form-select" required>
                            <option value="">Loading...</option>
                        </select>
                    </div>
                    <div class="mb-3">
    <label class="form-label">Description *</label>
    <textarea name="description" class="form-control" placeholder="Enter ticket details" rows="4" required></textarea>
</div>

                    <!-- <div class="mb-3">
                        <label class="form-label">Contents *</label>
                        <textarea name="contents" class="form-control" placeholder="Enter ticket details" rows="4" required></textarea>
                    </div> -->

                    <div class="mb-3">
                        <label class="form-label">Attachments</label>
                        <input type="file" name="attachments[]" class="form-control" multiple>
                        <small class="text-muted">You can upload multiple images or PDFs</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Ticket</button>
                </div>
            </form>

        </div>
    </div>  
</div>

<!-- --------------------------------------------Ticket Model ------------------------------------------------- -->

@push('scripts')
<script>
(function() {
    const form = document.getElementById('createTicketForm');
    if (!form) return;

    const modalEl = document.getElementById('createTicketModal');
    const deptSelect = document.getElementById('ticketDepartmentSelect');
    const prioSelect = document.getElementById('ticketPrioritySelect');

    // Choices.js safe initialization helper
    function safeInitChoices(selectEl, key) {
        if (!window.choicesInstances) window.choicesInstances = {};
        if (window.choicesInstances[key]) {
            try { window.choicesInstances[key].destroy(); } catch(e) {}
            window.choicesInstances[key] = null;
        }
        window.choicesInstances[key] = new Choices(selectEl, { removeItemButton: true, shouldSort: false });
    }

    async function populateSelect(selectEl, url, mapFn, preserveOnEmpty = false, choicesKey = null) {
        if (!selectEl) return;
        const original = selectEl.innerHTML;
        try {
            const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();
            const items = (json && json.data) || [];
            if (!Array.isArray(items) || items.length === 0) {
                if (!preserveOnEmpty) {
                    selectEl.innerHTML = '<option value="">No options</option>';
                }
                return;
            }
            selectEl.innerHTML = '<option value="">Select</option>' + items.map(mapFn).join('');
            if (choicesKey) safeInitChoices(selectEl, choicesKey);
        } catch (_) {
            if (!preserveOnEmpty) {
                selectEl.innerHTML = original;
            }
        }
    }

    // Load options when modal is shown
    if (modalEl && window.bootstrap) {
        modalEl.addEventListener('show.bs.modal', function() {
            // Keep manual options if API returns nothing
            populateSelect(
                deptSelect,
                '{{ route('tickets.departments') }}',
                (d) => `<option value="${d.id}">${d.name || d.title || ('Department #' + d.id)}</option>`,
                true,
                'departmentChoices'
            );
            populateSelect(
                prioSelect,
                '{{ route('tickets.priorities') }}',
                (p) => `<option value="${p.id}">${p.name || p.title || ('Priority #' + p.id)}</option>`,
                false,
                'priorityChoices'
            );
        });
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn ? submitBtn.innerHTML : '';
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerText = 'Creating...';
        }

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: formData
            });
            const data = await response.json().catch(() => ({}));

            if (response.ok && (data.success === true || data.status === 'success')) {
                // Try to update table without reload if we have the ticket payload
                const tbody = document.getElementById('ticketsTableBody');
                const ticket = (data.data && (data.data.ticket || data.data)) || null;
                if (tbody && ticket && ticket.id && ticket.subject) {
                    const newIndex = tbody.querySelectorAll('tr').length + 1;
                    const createdAt = ticket.created_at ? new Date(ticket.created_at) : new Date();
                    const dateString = createdAt.toLocaleDateString(undefined, { day: '2-digit', month: 'short', year: 'numeric' });
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td><strong>${String(newIndex).padStart(2,'0')}</strong></td>
                        <td>${ticket.id}</td>
                        <td>${ticket.subject}</td>
                        <td>${dateString}</td>
                        <td><span class="badge light badge-success">Opened</span></td>
                        <td>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
                            </div>
                        </td>`;
                    tbody.prepend(tr);
                } else {
                    // Fallback to reload to reflect new data
                    window.location.reload();
                }

                // Reset and close modal
                form.reset();
                const modalEl = document.getElementById('createTicketModal');
                if (window.bootstrap && modalEl) {
                    const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modalInstance.hide();
                }
            } else {
                // Show basic error
                const message = (data && (data.error || data.message)) || 'Failed to create ticket';
                alert(message);
            }
        } catch (err) {
            alert('An error occurred while creating the ticket.');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        }
    });

    // Delete ticket handler
    document.addEventListener('click', async function(e) {
        const btn = e.target.closest('.ticket-delete');
        if (!btn) return;
        const id = btn.getAttribute('data-id');
        if (!id) return;
        if (!confirm('Are you sure you want to delete this ticket?')) return;

        try {
            // Try DELETE first; if blocked (405), retry as POST to /delete fallback
            let res = await fetch(`{{ url('/tickets') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            let data = await res.json().catch(() => ({}));
            if (res.status === 405) {
                res = await fetch(`{{ url('/tickets') }}/${id}/delete`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                data = await res.json().catch(() => ({}));
            }
            if (res.ok && (data.success === true || (data.message && data.message.toLowerCase().includes('deleted')))) {
                const row = btn.closest('tr');
                if (row) row.remove();
            } else {
                alert(data.error || data.message || 'Failed to delete ticket');
            }
        } catch (err) {
            alert('Network error while deleting ticket');
        }
    });
})();
</script>
@endpush










        <!-- <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Basic Alerts</h4>
                    <p class="subtitle mb-0">Bootstrap default style</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                        <strong>Welcome!</strong> Message has been sent.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-secondary alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                        <strong>Done!</strong> Your profile photo updated.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>	
                        <strong>Success!</strong> Message has been sent.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <strong>Info!</strong> You have got 5 new email.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        <strong>Warning!</strong> Something went wrong. Please check.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> Message sending failed.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-dark alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> You successfully read this important alert message.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-light alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> You successfully read this message..
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Solid color alerts</h4>
                    <p class="subtitle mb-0">add <code>.solid</code> class to change the solid color.</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                        <strong>Welcome!</strong> Message has been sent.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-secondary solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                        <strong>Done!</strong> Your profile photo updated.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <strong>Success!</strong> Message has been sent.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-info solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <strong>Info!</strong> You have got 5 new email.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-warning solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        <strong>Warning!</strong> Something went wrong. Please check.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> Message sending failed.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-dark solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> You successfully read this important alert message.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="alert alert-light solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> You successfully read this message..
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Square alerts</h4>
                    <p class="mb-0 subtitle">add <code>.alert-square</code> class to change the solid color.
                    </p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary solid alert-square"><strong>Welcome!</strong> Message has been sent.</div>
                    <div class="alert alert-secondary solid alert-square"><strong>Done!</strong> Your profile photo updated.</div>
                    <div class="alert alert-success solid alert-square "><strong>Success!</strong> Message has been sent.</div>
                    <div class="alert alert-info solid alert-square "><strong>Info!</strong> You have got 5 new email.</div>
                    <div class="alert alert-warning solid alert-square "><strong>Warning!</strong> Something went wrong. Please check.</div>
                    <div class="alert alert-danger solid alert-square "><strong>Error!</strong> Message sending failed.</div>
                    <div class="alert alert-dark solid alert-square"><strong>Error!</strong> You successfully read this important alert message.</div>
                    <div class="alert alert-light solid alert-square"><strong>Error!</strong> You successfully read this message..</div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Rounded alerts</h4>
                    <p class="mb-0 subtitle">add <code>.alert-rounded</code> class to change the solid color.
                    </p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary solid alert-rounded"><strong>Welcome!</strong> Message has been sent.</div>
                    <div class="alert alert-secondary solid alert-rounded"><strong>Done!</strong> Your profile photo updated.</div>
                    <div class="alert alert-success solid alert-rounded "><strong>Success!</strong> Message has been sent.</div>
                    <div class="alert alert-info solid alert-rounded "><strong>Info!</strong> You have got 5 new email.</div>
                    <div class="alert alert-warning solid alert-rounded "><strong>Warning!</strong> Something went wrong. Please check.</div>
                    <div class="alert alert-danger solid alert-rounded "><strong>Error!</strong> Message sending failed.</div>
                    <div class="alert alert-dark solid alert-rounded"><strong>Error!</strong> You successfully read this important alert message.</div>
                    <div class="alert alert-light solid alert-rounded"><strong>Error!</strong> You successfully read this message..</div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Dismissable Alerts</h4>
                    <p class="subtitle mb-0">Bootstrap default style</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-secondary alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-info alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Info!</strong> You have got 5 new email.
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Warning!</strong> Something went wrong. Please check.
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-dark alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-light alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Alerts alt</h4>
                    <p class="mb-0 subtitle">add <code>.alert-alt</code> class to change the solid color.
                    </p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary alert-dismissible alert-alt fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-secondary alert-dismissible alert-alt fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-success alert-dismissible alert-alt fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-info alert-dismissible alert-alt fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Info!</strong> You have got 5 new email.
                    </div>
                    <div class="alert alert-warning alert-dismissible alert-alt fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Warning!</strong> Something went wrong. Please check.
                    </div>
                    <div class="alert alert-danger alert-dismissible alert-alt fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-dark alert-dismissible alert-alt fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-light alert-dismissible alert-alt fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Solid Alt</h4>
                    <p class="mb-0 subtitle">add <code>.alert-alt.solid</code> class to change the solid color.
                    </p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary alert-dismissible alert-alt solid fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-secondary alert-dismissible alert-alt solid fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-success alert-dismissible alert-alt solid fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-info alert-dismissible alert-alt solid fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Info!</strong> You have got 5 new email.
                    </div>
                    <div class="alert alert-warning alert-dismissible alert-alt solid fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Warning!</strong> Something went wrong. Please check.
                    </div>
                    <div class="alert alert-danger alert-dismissible alert-alt solid fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-dark alert-dismissible alert-alt solid fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-light alert-dismissible alert-alt solid fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Dismissable with solid</h4>
                    <p class="mb-0 subtitle">add <code>.solid</code> class to change the solid color.</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-secondary solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Success!</strong> Message has been sent.
                    </div>
                    <div class="alert alert-info solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Info!</strong> You have got 5 new email.
                    </div>
                    <div class="alert alert-warning solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Warning!</strong> Something went wrong. Please check.
                    </div>
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-dark solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-light solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Alert with Link</h4>
                    <p class="mb-0 subtitle">Bootstrap default style</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>WOW! Eveything looks OK.</strong> <a href="javascript:void(0);">Please check this one as
                            well</a>
                    </div>

                    <div class="alert alert-secondary alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>WOW! Eveything looks OK.</strong> <a href="javascript:void(0);">Please check this one as
                            well</a>
                    </div>

                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>WOW! Eveything looks OK.</strong> <a href="javascript:void(0);">Please check this one as
                            well</a>
                    </div>

                    <div class="alert alert-info alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Hey! Take a quick look.</strong> <a href="javascript:void(0);">My birthday party</a>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Warning!</strong> Why you did it to me! <a href="javascript:void(0);">Check this out</a>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Something Went wrong <a href="javascript:void(0);">Click here for details.</a>
                    </div>
                    <div class="alert alert-dark alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Something Went wrong <a href="javascript:void(0);">Click here for details.</a>
                    </div>
                    <div class="alert alert-light alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Something Went wrong <a href="javascript:void(0);">Click here for details.</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Alert with Link and solid color</h4>
                    <p class="mb-0 subtitle">add <code>.solid</code> class to change the solid color.</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> WOW! Eveything looks OK. <a href="javascript:void(0);" class="badge badge-sm light badge-primary ms-1">upgrade</a>
                    </div>
                    <div class="alert alert-secondary solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> WOW! Eveything looks OK. <a href="javascript:void(0);" class="badge badge-sm light badge-secondary ms-1">upgrade</a>
                    </div>
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> WOW! Eveything looks OK. <a href="javascript:void(0);" class="badge badge-sm light badge-success ms-1">upgrade</a>
                    </div>

                    <div class="alert alert-info solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Hey! Take a quick look. <a href="javascript:void(0);" class="badge badge-sm light badge-info ms-1">upgrade</a>
                    </div>
                    <div class="alert alert-warning solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Warning!</strong> Why you did it to me! <a href="javascript:void(0);" class="badge badge-sm light badge-warning ms-1">upgrade</a>
                    </div>
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Something Went wrong <a href="javascript:void(0);" class="badge badge-sm light badge-danger ms-1">upgrade</a>
                    </div>
                    <div class="alert alert-dark solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Something Went wrong <a href="javascript:void(0);" class="badge badge-sm light badge-dark ms-1">upgrade</a>
                    </div>
                    <div class="alert alert-light solid alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Something Went wrong <a href="javascript:void(0);" class="badge badge-sm light badge-light ms-1">upgrade</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Inline Notifications</h4>
                    <p class="mb-0 subtitle">Default inline notification</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="alert alert-primary notification">
                                <p class="notificaiton-title mb-2"><strong>Success!</strong> Vampires The Romantic Ideology Behind Them</p>
                                <p>The following article covers a topic that has recently moved to center stage-at lease it seems that way.</p>
                                <button class="btn btn-primary btn-sm">Confirm</button>
                                <button class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-secondary notification">
                                <p class="notificaiton-title mb-2"><strong>Success!</strong> Vampires The Romantic Ideology Behind Them</p>
                                <p>The following article covers a topic that has recently moved to center stage-at lease it seems that way.</p>
                                <button class="btn btn-secondary btn-sm">Confirm</button>
                                <button class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-success notification">
                                <p class="notificaiton-title mb-2"><strong>Success!</strong> Vampires The Romantic Ideology Behind Them</p>
                                <p>The following article covers a topic that has recently moved to center stage-at lease it seems that way.</p>
                                <button class="btn btn-success btn-sm">Confirm</button>
                                <button class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-info notification">
                                <p class="notificaiton-title mb-2"><strong>Success!</strong> Vampires The Romantic Ideology Behind Them</p>
                                <p>The following article covers a topic that has recently moved to center stage-at lease it seems that way.</p>
                                <button class="btn btn-info btn-sm">Confirm</button>
                                <button class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-warning notification">
                                <p class="notificaiton-title mb-2"><strong>Success!</strong> Vampires The Romantic Ideology Behind Them</p>
                                <p>The following article covers a topic that has recently moved to center stage-at lease it seems that way.</p>
                                <button class="btn btn-warning btn-sm">Confirm</button>
                                <button class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-danger notification">
                                <p class="notificaiton-title mb-2"><strong>Danger! </strong> Religion And Science
                                </p>
                                <p>What is the loop of Creation? How is there something from nothing? In spite of the fact.. </p>
                                <button class="btn btn-danger btn-sm">Confirm</button>
                                <button class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-dark notification">
                                <p class="notificaiton-title mb-2"><strong>Danger! </strong> Religion And Science
                                </p>
                                <p>What is the loop of Creation? How is there something from nothing? In spite of the fact.. </p>
                                <button class="btn btn-dark btn-sm">Confirm</button>
                                <button class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-light notification">
                                <p class="notificaiton-title mb-2"><strong>Danger! </strong> Religion And Science
                                </p>
                                <p>What is the loop of Creation? How is there something from nothing? In spite of the fact.. </p>
                                <button class="btn btn-dark btn-sm">Confirm</button>
                                <button class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Alert Icon Left</h4>
                    <p class="mb-0 subtitle">add <code>.alert-end-icon</code> to change the style</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary solid alert-end-icon alert-dismissible fade show">
                        <span><i class="mdi mdi-account-search"></i></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Success! Message has been sent.
                    </div>
                    <div class="alert alert-secondary solid alert-end-icon alert-dismissible fade show">
                        <span><i class="icon icon-bell-53"></i></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Success! Message has been sent.
                    </div>
                    <div class="alert alert-success solid alert-end-icon alert-dismissible fade show">
                        <span><i class="mdi mdi-check"></i></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Success! Message has been sent.
                    </div>
                    <div class="alert alert-info solid alert-end-icon alert-dismissible fade show">
                        <span><i class="mdi mdi-email"></i></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Info! You have got 5 new email.
                    </div>
                    <div class="alert alert-warning solid alert-end-icon alert-dismissible fade show">
                        <span><i class="mdi mdi-alert"></i></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Warning!</strong> Something went wrong. Please check.
                    </div>
                    <div class="alert alert-danger solid alert-end-icon alert-dismissible fade show">
                        <span><i class="mdi mdi-help"></i></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-dark solid alert-end-icon alert-dismissible fade show">
                        <span><i class="mdi mdi-settings"></i></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-light solid alert-end-icon alert-dismissible fade show">
                        <span><i class="mdi mdi-cogs"></i></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Alert outline</h4>
                    <p class="mb-0 subtitle">add <code>.alert-outline-primary,secondary,success...</code> to change the style</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-outline-primary alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Success! Message has been sent.
                    </div>
                    <div class="alert alert-outline-secondary alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Success! Message has been sent.
                    </div>
                    <div class="alert alert-outline-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Success! Message has been sent.
                    </div>
                    <div class="alert alert-outline-info alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button> Info! You have got 5 new email.
                    </div>
                    <div class="alert alert-outline-warning alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Warning!</strong> Something went wrong. Please check.
                    </div>
                    <div class="alert alert-outline-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-outline-dark alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                    <div class="alert alert-outline-light alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                        <strong>Error!</strong> Message Sending failed.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Alert Social</h4>
                    <p class="mb-0 subtitle">add <code>.alert-social
                            .facebook,.twitter,.linkedin,.google-plus</code> to change the style</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="alert alert-social facebook alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-social-icon">
                                        <span><i class="mdi mdi-facebook"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Facebook</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-social twitter alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-social-icon">
                                        <span><i class="mdi mdi-twitter"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Twitter</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-social linkedin alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-social-icon">
                                        <span><i class="mdi mdi-linkedin"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Linkedin</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-social google-plus alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-social-icon">
                                        <span><i class="mdi mdi-google-plus"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Google Plus</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Message Alert</h4>
                    <p class="subtitle mb-0">Bootstrap default style</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="alert alert-primary alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-1">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-secondary alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-1">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-1">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-info alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-1">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-1">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-1">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-dark alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-1">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-light alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-1">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Message Alert with Solid color</h4>
                    <p class="mb-0 subtitle">add <code>.solid</code> to change the style</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="alert alert-primary solid alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-secondary solid alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-success solid alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-info solid alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-warning solid alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-danger solid alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-dark solid alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2 text-white">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-light solid alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2">Notifications</h5>
                                        <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Alert left icon big </h4>
                    <p class="mb-0 subtitle">add <code>.left-icon-big</code> to change the style</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="alert alert-primary left-icon-big alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-left-icon-big">
                                        <span><i class="mdi mdi-email-alert"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-1 mb-2">Welcome to your account, Dear user!</h6>
                                        <p class="mb-0">Please confirm your email address: email@example.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-warning left-icon-big alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-left-icon-big">
                                        <span><i class="mdi mdi-help-circle-outline"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2">Pending!</h5>
                                        <p class="mb-0">You message sending failed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-success left-icon-big alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-left-icon-big">
                                        <span><i class="mdi mdi-check-circle-outline"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2">Congratulations!</h5>
                                        <p class="mb-0">You have successfully created a account.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="alert alert-danger left-icon-big alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-left-icon-big">
                                        <span><i class="mdi mdi-alert"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2">Loading failed!</h5>
                                        <p class="mb-0">Again upload your server</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection