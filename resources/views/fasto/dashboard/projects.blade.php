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
	<div class="project-nav">
		
		<div class="d-flex align-items-center">
		
			</ul>
			<!-- Add Order -->


<div class="modal fade" id="addProjectSidebar" >
			<!-- MODAL: Create New Project -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="createProjectLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="createProjectLabel">Create New Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
          <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#basicInfo">Basic Info</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#technology">Technology</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#dataSecurity">Data & Security</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#compliance">Compliance & AI/ML</button></li>
        </ul>

      
      </div>
    </div>
  </div>
</div>
</div>

		</div>
	</div>
<style>
    .filter-tab.active {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }
    /* Make cards more compact */
    .project-card .card-body { padding: 0.5rem; }
    .project-card .mb-2 { margin-bottom: 0.25rem !important; }
    .project-card { margin-bottom: 0.5rem; }
    /* Ensure edit modal content is scrollable and submit button stays visible */
    #editProjectModal .modal-body { max-height: calc(100vh - 200px); overflow-y: auto; }
    #editProjectModal .modal-dialog { margin-top: 1.25rem; margin-bottom: 1.25rem; }
    #editProjectModal .modal-content { max-height: calc(100vh - 2.5rem); display: flex; }
    #editProjectModal .modal-body { flex: 1 1 auto; }
</style>

	
	<div class="tab-content">	
		<div class="tab-pane fade active show" id="list">
			<div class="tab-content project-list-group" id="ListViewTabLink">	
				<div class="tab-pane fade active show" id="navpills-1">

<div class="d-flex flex-wrap gap-2 mb-4" id="statusFilterContainer">
   @php
    $statuses = ['All', 'Draft', 'Pending', 'Active', 'In Active', 'Archived'];
    $icons = [
        'all' => '🗂️',
        'draft' => '🟢',
        'pending' => '🟡',
        'active' => '🟢',
        'in active' => '🔴',
        'Archived' => '⚫'
    ];
    $badgeColors = [
        'all' => 'secondary',
        'draft' => 'success',
        'pending' => 'warning',
        'active' => 'primary',
        'in active' => 'danger',
        'Archived' => '	Archived'
    ];
@endphp

<ul class="nav nav-pills mb-3 gap-2" id="statusFilter">
    @foreach ($statuses as $status)
        @php
            $key = strtolower($status);
            $count = $statusCounts[$key] ?? 0;
            $icon = $icons[$key] ?? '';
            $badgeClass = $badgeColors[$key] ?? 'secondary';
        @endphp
        <li class="nav-item">
            <a href="#" class="nav-link d-flex align-items-center {{ $loop->first ? 'active' : '' }}" data-status="{{ $key }}">
                <span class="me-1">{{ $icon }}</span>
                {{ $status }}
                <span class="badge bg-{{ $badgeClass }} ms-2">{{ $count }}</span>
            </a>
        </li>
    @endforeach
</ul>
</div>


    <div id="projectList">
    @if(count($projects) === 0)
      <div id="emptyState" class="alert alert-info">No projects found.</div>
    @else
      @foreach($projects as $project)
        <div class="card mb-2 project-card" data-status="{{ strtolower($project['status'] ?? 'unknown') }}">
          <div class="card-body p-3">
            <div class="row align-items-center">
              <!-- Project ID + Name -->
              <div class="col-md-3 mb-2">
                <p class="text-primary mb-1 small">#{{ $project['subscription_id'] ?? 'N/A' }}</p>
                <h5 class="mb-0">
                  <a href="#" class="text-dark text-decoration-none">{{ $project['project_name'] ?? 'Unnamed Project' }}</a>
                </h5>
                <small class="text-muted">
                  <i class="far fa-calendar me-1"></i>
                  {{ \Carbon\Carbon::parse($project['created_at'] ?? now())->format('M d, Y') }}
                </small>
              </div>
              <!-- Industry -->
              <div class="col-md-3 mb-2">
                <div class="d-flex align-items-center">
                  <div>
                    <small>Industry</small>
                    <div class="fw-semibold">{{ $project['industry_domain'] ?? '-' }}</div>
                  </div>
                </div>
              </div>
              <!-- Tech Stack -->
              <div class="col-md-2 mb-2">
                <div class="d-flex align-items-center">
                  <div>
                    <small>Technology</small>
                    <div class="fw-semibold">{{ $project['technology_stack']['backend'][0] ?? '-' }}</div>
                  </div>
                </div>
              </div>
              <!-- Status -->
              <div class="col-md-2 mb-2">
                <div>
                  <small>Status</small>
                  <div class="fw-bold">{{ ucfirst($project['status'] ?? 'Unknown') }}</div>
                </div>
              </div>
              <!-- Actions -->
              <div class="col-md-2 mb-2">
                <div class="dropdown text-end">
                  <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Action
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('project.view', $project['subscription_id']) }}">View</a></li>
                  <li>
  <a class="dropdown-item edit-project" href="#" data-id="{{ $project['id'] }}">
      Edit
  </a>
</li>
                   <li><a href="#" class="dropdown-item text-danger delete-project" data-id="{{ $project['id'] }}">Delete</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endif
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.delete-project').forEach(function (button) {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.dataset.id;
      if (!confirm(id + ' Are you sure you want to delete this project?')) return;
      fetch(`/project/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    alert('Project deleted successfully.');
                    location.reload(); // Refresh list
                } else {
                    alert('Failed to delete project.');
                }
            })
            .catch(error => {
                console.error('Delete error:', error);
                alert('Error occurred while deleting.');
            });
        });
    });
});
</script>
















		<div class="modal fade" id="projectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <form id="projectForm" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="modalTitle">Create Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <!-- BASIC INFO -->
          <input type="hidden" name="_method" id="_method" value="POST">
          <div class="mb-3">
            <label>Project Name</label>
            <input type="text" name="project_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Description</label>
            <textarea name="project_description" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label>Subscription</label>
          
          </div>

          <!-- TECH STACK -->
          <div class="mb-3">
            <label>Backend</label>
            <select name="backend[]" class="form-select" multiple>
              <option value="Node.js">Node.js</option>
              <option value="Python">Python</option>
              <option value="Express">Express</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Frontend</label>
            <select name="frontend[]" class="form-select" multiple>
              <option value="React">React</option>
              <option value="NextJS">NextJS</option>
            </select>
          </div>

          <!-- INFRASTRUCTURE -->
          <div class="mb-3">
            <label>Storage Location</label>
            <select name="data_storage_location" class="form-select">
              <option value="Cloud-based">Cloud-based</option>
              <option value="On-Premises">On-Premises</option>
              <option value="Hybrid">Hybrid</option>
            </select>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="data_encryption" id="dataEncryptionToggle">
            <label class="form-check-label">Enable Encryption</label>
          </div>
          <div class="mb-3">
            <label>Encryption Type</label>
            <input type="text" name="encryption_type" class="form-control">
          </div>

          <!-- AI/BIAS -->
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="bias_risk_factors" id="biasToggle">
            <label class="form-check-label">Bias Risk Identified</label>
          </div>
          <div class="mb-3">
            <label>Bias Description</label>
            <textarea name="bias_risk_description" class="form-control"></textarea>
          </div>

          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="has_ai_ml" id="aiToggle">
            <label class="form-check-label">AI/ML Used</label>
          </div>
          <div class="mb-3">
            <label>AI Model Type</label>
            <select name="ai_model_type[]" class="form-select" multiple>
              <option value="Supervised">Supervised</option>
              <option value="Reinforcement Learning">Reinforcement Learning</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Training Data Source</label>
            <select name="training_data_source[]" class="form-select" multiple>
              <option value="Proprietary">Proprietary</option>
              <option value="Open-source">Open-source</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <form id="editProjectForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Edit Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
        <div class="modal-body">
          <input type="hidden" name="project_id" id="edit_project_id">
          <input type="hidden" name="subscription_id" id="edit_subscription_id">

          <ul class="nav nav-tabs mb-4" id="editProjectTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#edit_basicInfo" type="button">Basic Info</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit_technology" type="button">Technology</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit_dataSecurity" type="button">Data & Security</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit_compliance" type="button">Compliance & AI/ML</button></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane fade show active" id="edit_basicInfo">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Project Name *</label>
                  <input name="project_name" id="edit_project_name" type="text" class="form-control" required>
                </div>
                <div class="col-md-12">
                  <label class="form-label">Project Description *</label>
                  <textarea name="project_description" id="edit_project_description" class="form-control" required></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Subscription *</label>
                  <select name="subscription_id" id="edit_subscription_select" class="form-select" required>
                    <option value="">Loading...</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Status *</nlabel>
                  <select name="status" id="edit_status" class="form-select" required>
                    <option value="">Select</option>
                    <option>Draft</option>
                    <option>Pending</option>
                    <option>Active</option>
                    <option>In Active</option>
                    <option>Archived</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Industry Domain *</label>
                  <select name="industry_domain" id="edit_industry_domain" class="form-select" required>
                    <option value="">Select</option>
                    <option value="Healthcare & MedTech">Healthcare & MedTech</option>
                    <option>Finance</option>
                    <option>Education</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-secondary prev-btn" disabled>Previous</button>
                <button type="button" class="btn btn-primary next-btn" data-next="#edit_technology">Next</button>
              </div>
            </div>

            <div class="tab-pane fade" id="edit_technology">
              <h6>Technology Stack</h6>
              <div class="row g-3">
                <div class="col-md-6">
                  <label>Backend Technologies *</label>
                  <select name="technology_stack_backend[]" id="edit_backend" class="form-select" multiple required>
                    <option value="Node.js">Node.js</option>
                    <option value="Express">Express</option>
                    <option value="Python">Python</option>
                    <option value="Django">Django</option>
                    <option value="Laravel">Laravel</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Frontend Technologies</label>
                  <select name="technology_stack_frontend[]" id="edit_frontend" class="form-select" multiple>
                    <option value="React">React</option>
                    <option value="NextJS">NextJS</option>
                    <option value="Vue">Vue</option>
                    <option value="Angular">Angular</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Database Technologies *</label>
                  <select name="technology_stack_database[]" id="edit_database" class="form-select" multiple required>
                    <option value="MySQL">MySQL</option>
                    <option value="PostgreSQL">PostgreSQL</option>
                    <option value="MongoDB">MongoDB</option>
                    <option value="Redis">Redis</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>AI Models *</label>
                  <select name="technology_stack_ai_models[]" id="edit_ai_models" class="form-select" multiple required>
                    <option value="GPT-4">GPT-4</option>
                    <option value="BERT">BERT</option>
                    <option value="Med-PaLM">Med-PaLM</option>
                    <option value="Custom Model">Custom Model</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>APIs *</label>
                  <select name="technology_stack_apis[]" id="edit_apis" class="form-select" multiple required>
                    <option value="OpenAI">OpenAI</option>
                    <option value="Google Maps">Google Maps</option>
                    <option value="Stripe">Stripe</option>
                    <option value="Custom API">Custom API</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>API Integrations</label>
                  <select name="apis_integrations[]" id="edit_apis_integrations" class="form-select" multiple>
                    <option value="REST API">REST API</option>
                    <option value="GraphQL">GraphQL</option>
                    <option value="WebSocket">WebSocket</option>
                    <option value="gRPC">gRPC</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Programming Languages</label>
                  <select name="programming_languages[]" id="edit_programming_languages" class="form-select" multiple>
                    <option value="Python">Python</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="Java">Java</option>
                    <option value="C++">C++</option>
                    <option value="Go">Go</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary prev-btn" data-prev="#edit_basicInfo">Previous</button>
                <button type="button" class="btn btn-primary next-btn" data-next="#edit_dataSecurity">Next</button>
              </div>
            </div>

            <div class="tab-pane fade" id="edit_dataSecurity">
              <h6>Data Sources</h6>
              <div class="row g-3">
                <div class="col-md-6">
                  <label>Data Storage Location *</label>
                  <select name="data_storage_location" id="edit_data_storage_location" class="form-select" required>
                    <option>Cloud-based</option>
                    <option>On-Premises</option>
                    <option>Hybrid</option>
                  </select>
                </div>
              </div>
              <hr>
              <h6>Security</h6>
              <div class="row g-3 align-items-center">
                <div class="col-md-3">
                  <label>Data Encryption</label>
                  <input type="checkbox" name="data_encryption" id="edit_data_encryption" class="form-check-input">
                </div>
                <div class="col-md-3">
                  <label>Encryption Type</label>
                  <select name="encryption_type" id="edit_encryption_type" class="form-select">
                    <option>AES-256</option>
                    <option>RSA-2048</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary prev-btn" data-prev="#edit_technology">Previous</button>
                <button type="button" class="btn btn-primary next-btn" data-next="#edit_compliance">Next</button>
              </div>
            </div>

            <div class="tab-pane fade" id="edit_compliance">
              <h6>Compliance & AI/ML</h6>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="bias_risk_factors" id="edit_bias_risk_factors">
                <label class="form-check-label">Bias Risk Identified</label>
              </div>
              <div class="mb-3">
                <label>Bias Description</label>
                <textarea name="bias_risk_description" id="edit_bias_risk_description" class="form-control"></textarea>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="has_ai_ml" id="edit_has_ai_ml">
                <label class="form-check-label">AI/ML Used</label>
              </div>
              <div class="mb-3">
                <label>AI Model Type</label>
                <select name="ai_model_type[]" id="edit_ai_model_type" class="form-select" multiple>
                  <option value="Supervised">Supervised</option>
                  <option value="Unsupervised">Unsupervised</option>
                  <option value="Reinforcement Learning">Reinforcement Learning</option>
                  <option value="Deep Learning">Deep Learning</option>
                </select>
              </div>
              <div class="mb-3">
                <label>Training Data Source</label>
                <select name="training_data_source[]" id="edit_training_data_source" class="form-select" multiple>
                  <option value="Proprietary">Proprietary</option>
                  <option value="Open-source">Open-source</option>
                  <option value="Public datasets">Public datasets</option>
                  <option value="User-generated">User-generated</option>
                </select>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary prev-btn" data-prev="#edit_dataSecurity">Previous</button>
                <button type="submit" class="btn btn-primary">Update Project</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Project</button>
        </div>
      </form>
    </div>
  </div>
</div>

 </div>
  </div>
</div> 
</div>
</div>
</div>

<!-- JavaScript to Handle Edit -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Status filter handling
  const filterTabs = document.querySelectorAll('#statusFilter .nav-link');
  const projectCards = document.querySelectorAll('.project-card');
  const emptyStateEl = document.getElementById('emptyState');

  const updateEmptyState = () => {
    const anyVisible = Array.from(projectCards).some(card => !card.classList.contains('d-none'));
    if (emptyStateEl) emptyStateEl.classList.toggle('d-none', anyVisible);
  };

  filterTabs.forEach(tab => {
    tab.addEventListener('click', function(e) {
      e.preventDefault();
      // toggle active state
      filterTabs.forEach(t => t.classList.remove('active'));
      this.classList.add('active');

      const selectedStatus = this.dataset.status; // already lowercase
      projectCards.forEach(card => {
        const cardStatus = (card.dataset.status || '').toLowerCase();
        if (selectedStatus === 'all' || cardStatus === selectedStatus) {
          card.classList.remove('d-none');
        } else {
          card.classList.add('d-none');
        }
      });

      updateEmptyState();
    });
  });

  // Initialize empty state for default selection
  updateEmptyState();

  // Handle edit project clicks
  document.querySelectorAll('.edit-project').forEach(btn => {
    btn.addEventListener('click', async function(e) {
      e.preventDefault();
      const projectId = this.dataset.id;
      
      try {
        // Show loading state
        this.innerHTML = 'Loading...';
        this.disabled = true;
        
        // Fetch project data from API
        const response = await fetch(`/projects/${projectId}/edit`, {
          headers: {
            'Accept': 'application/json'
          }
        });
        
        if (!response.ok) {
          const errorText = await response.text();
          console.error('Response not OK:', response.status, errorText);
          throw new Error(`Failed to fetch project data: ${response.status} ${errorText}`);
        }
        
        const projectData = await response.json();
        console.log('Project data received:', projectData);
        
        if (projectData.error) {
          throw new Error(projectData.error);
        }
        
        const project = projectData.project || projectData;
        
        if (!project) {
          throw new Error('No project data received');
        }
 
        // Helpers for multi-select population
        const toArray = (val) => {
          if (!val) return [];
          if (Array.isArray(val)) return val;
          if (typeof val === 'string') return val.split(',').map(s => s.trim()).filter(Boolean);
          return [];
        };
        const selectMulti = (selectEl, values) => {
          const set = new Set(values.map(v => String(v).toLowerCase().trim()));
          Array.from(selectEl.options).forEach(opt => {
            opt.selected = set.has(String(opt.value).toLowerCase().trim())
              || set.has(String(opt.text).toLowerCase().trim());
          });
        };

        // Populate subscriptions into the edit select (mirror create form)
        const subs = projectData.subscriptions || [];
        const subSelect = document.getElementById('edit_subscription_select');
        if (subSelect) {
          subSelect.innerHTML = '';
          if (Array.isArray(subs) && subs.length > 0) {
            subSelect.appendChild(new Option('Select', ''));
            subs.forEach(s => {
              const sid = s._id || s.id || s.subscription_id || '';
              const label = `${sid} - ${(s.pricing_tier || s.plan_name || 'Subscription')} - ${(s.status || '')}`;
              if (sid) subSelect.appendChild(new Option(label, sid));
            });
          } else {
            subSelect.appendChild(new Option('No subscriptions available', ''));
          }
        }
        
        // Populate the edit form
        document.getElementById('edit_project_id').value = projectId;
        document.getElementById('edit_project_name').value = project.project_name || '';
        document.getElementById('edit_project_description').value = project.project_description || '';
        // Industry (case-insensitive)
        (function() {
          const sel = document.getElementById('edit_industry_domain');
          const target = (project.industry_domain || '').toString().toLowerCase();
          const match = Array.from(sel.options).find(o => o.value.toLowerCase() === target || o.text.toLowerCase() === target);
          sel.value = match ? match.value : '';
        })();
        // Status (case-insensitive)
        (function() {
          const sel = document.getElementById('edit_status');
          const target = (project.status || 'Draft').toString().toLowerCase();
          const match = Array.from(sel.options).find(o => o.value.toLowerCase() === target || o.text.toLowerCase() === target);
          sel.value = match ? match.value : 'Draft';
        })();
        // Subscription
        document.getElementById('edit_subscription_id').value = project.subscription_id || '';
        if (subSelect) {
          const desired = (project.subscription_id || '').toString();
          const opt = Array.from(subSelect.options).find(o => o.value === desired);
          if (opt) subSelect.value = desired;
        }
        // Storage location (support both top-level and nested)
        document.getElementById('edit_data_storage_location').value = (project.data_storage_location || project.infrastructure?.data_storage_location || 'Cloud-based');
        // Encryption
        const de = project.data_encryption || project.infrastructure?.data_encryption || {};
        document.getElementById('edit_encryption_type').value = de.type || '';
        document.getElementById('edit_bias_risk_description').value = project.bias_risk_factors?.description || '';
        
        // Handle checkboxes
        document.getElementById('edit_data_encryption').checked = !!de.enabled;
        document.getElementById('edit_bias_risk_factors').checked = !!(project.bias_risk_factors?.identified);
        document.getElementById('edit_has_ai_ml').checked = !!project.has_ai_ml;
        
        // Handle multi-selects
        const backendSelect = document.getElementById('edit_backend');
        const frontendSelect = document.getElementById('edit_frontend');
        const databaseSelect = document.getElementById('edit_database');
        const aiModelsSelect = document.getElementById('edit_ai_models');
        const apisSelect = document.getElementById('edit_apis');
        const apiIntegrationsSelect = document.getElementById('edit_apis_integrations');
        const programmingSelect = document.getElementById('edit_programming_languages');
        const aiModelTypeSelect = document.getElementById('edit_ai_model_type');
        const trainingDataSelect = document.getElementById('edit_training_data_source');
        
        // Reset selections
        [backendSelect, frontendSelect, databaseSelect, aiModelsSelect, apisSelect, apiIntegrationsSelect, programmingSelect, aiModelTypeSelect, trainingDataSelect].forEach(sel => {
          Array.from(sel.options).forEach(opt => (opt.selected = false));
        });
        // Set selected values (case-insensitive, accept comma strings)
        const ts = project.technology_stack || {};
        const backendVals = toArray(ts.backend);
        const frontendVals = toArray(ts.frontend);
        const databaseVals = toArray(ts.database);
        const aiModelsVals = toArray(ts.ai_models);
        const apisVals = toArray(ts.apis);
        const apiIntegrationVals = toArray(project.apis_integrations);
        const programmingVals = toArray(project.programming_languages);
        const aiModelVals = toArray(project.ai_model_type);
        const trainingVals = toArray(project.training_data_source);
        selectMulti(backendSelect, backendVals);
        selectMulti(frontendSelect, frontendVals);
        selectMulti(databaseSelect, databaseVals);
        selectMulti(aiModelsSelect, aiModelsVals);
        selectMulti(apisSelect, apisVals);
        selectMulti(apiIntegrationsSelect, apiIntegrationVals);
        selectMulti(programmingSelect, programmingVals);
        selectMulti(aiModelTypeSelect, aiModelVals);
        selectMulti(trainingDataSelect, trainingVals);

        // If Choices.js already enhanced these selects (by global initializer), update selections via instance
        const syncChoicesInstance = (selectEl, values) => {
          const instance = selectEl._choices || selectEl.choices || null;
          if (!instance) return; // do not create a new instance to avoid duplicates
          try {
            instance.removeActiveItems();
            const normalized = (values || []).map(v => String(v));
            normalized.forEach(v => instance.setChoiceByValue(v));
          } catch (e) {
            console.warn('Choices sync warning:', e);
          }
        };

        syncChoicesInstance(backendSelect, backendVals);
        syncChoicesInstance(frontendSelect, frontendVals);
        syncChoicesInstance(databaseSelect, databaseVals);
        syncChoicesInstance(aiModelsSelect, aiModelsVals);
        syncChoicesInstance(apisSelect, apisVals);
        syncChoicesInstance(apiIntegrationsSelect, apiIntegrationVals);
        syncChoicesInstance(programmingSelect, programmingVals);
        syncChoicesInstance(aiModelTypeSelect, aiModelVals);
        syncChoicesInstance(trainingDataSelect, trainingVals);

        // Show the modal
        const editModal = new bootstrap.Modal(document.getElementById('editProjectModal'));
        editModal.show();
        
      } catch (error) {
        console.error('Error fetching project:', error);
        alert('Failed to load project data. ' + (error?.message || 'Please try again.'));
      } finally {
        // Reset button state
        this.innerHTML = 'Edit';
        this.disabled = false;
      }
    });
  });
  
  // Handle edit form submission
  document.getElementById('editProjectForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const projectId = formData.get('project_id');
    const selectedSubscriptionId = document.getElementById('edit_subscription_select')?.value || formData.get('subscription_id');
    
    // Prepare the payload
    const payload = {
      subscription_id: selectedSubscriptionId,
      project_name: formData.get('project_name'),
      project_description: formData.get('project_description'),
      industry_domain: formData.get('industry_domain'),
      status: formData.get('status'),
      technology_stack: {
        backend: Array.from(document.getElementById('edit_backend').selectedOptions).map(opt => opt.value),
        frontend: Array.from(document.getElementById('edit_frontend').selectedOptions).map(opt => opt.value),
        database: Array.from(document.getElementById('edit_database').selectedOptions).map(opt => opt.value),
        ai_models: Array.from(document.getElementById('edit_ai_models').selectedOptions).map(opt => opt.value),
        apis: Array.from(document.getElementById('edit_apis').selectedOptions).map(opt => opt.value)
      },
      programming_languages: Array.from(document.getElementById('edit_programming_languages').selectedOptions).map(opt => opt.value),
      apis_integrations: Array.from(document.getElementById('edit_apis_integrations').selectedOptions).map(opt => opt.value),
      data_storage_location: formData.get('data_storage_location'),
      data_encryption: {
        enabled: formData.get('data_encryption') === 'on',
        type: formData.get('encryption_type')
      },
      bias_risk_factors: {
        identified: formData.get('bias_risk_factors') === 'on',
        description: formData.get('bias_risk_description')
      },
      has_ai_ml: formData.get('has_ai_ml') === 'on',
      ai_model_type: Array.from(document.getElementById('edit_ai_model_type').selectedOptions).map(opt => opt.value),
      training_data_source: Array.from(document.getElementById('edit_training_data_source').selectedOptions).map(opt => opt.value)
    };
    
    try {
      const response = await fetch(`/projects/${projectId}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
      });
      
      if (response.ok) {
        alert('Project updated successfully!');
        // Close modal and refresh page
        const editModal = bootstrap.Modal.getInstance(document.getElementById('editProjectModal'));
        editModal.hide();
        location.reload();
      } else {
        const errorData = await response.json().catch(() => ({}));
        const detail = errorData.message || errorData.error || JSON.stringify(errorData) || 'Failed to update project';
        throw new Error(detail);
      }
    } catch (error) {
      console.error('Error updating project:', error);
      alert('Failed to update project: ' + error.message);
    }
  });
});
</script>
    </div>
</div>

@endsection