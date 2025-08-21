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

    // Re-initialize Choices.js for all multi-selects after setting values
    if (window.Choices) {
        const multiIds = ['#backend-tech', '#frontend-tech', '#database-tech', '#ai-models-tech', '#apis-tech'];
        multiIds.forEach(id => {
            const el = document.querySelector(id);
            if (el) {
                if (el.choicesInstance) { el.choicesInstance.destroy(); }
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
}
</script>
@extends('layouts.default')

@section('content')
<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectSidebar" tabindex="-1" aria-labelledby="editProjectLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editProjectLabel">Edit Project</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
<form method="POST" action="{{ route('projects.update', $project->id) }}">
    @csrf
    <!-- @method('GET') -->

        <div class="modal-body">
          <!-- Nav Tabs -->
          <ul class="nav nav-tabs" id="editProjectTabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#edit-basic" role="tab">Basic Info</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#edit-technology" role="tab">Technology</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#edit-data" role="tab">Data & Security</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#edit-compliance" role="tab">Compliance & AI/ML</a></li>
          </ul>

          <div class="tab-content mt-3">
            <!-- ================== BASIC INFO ================== -->
            <div class="tab-pane fade show active" id="edit-basic" role="tabpanel">
              <div class="mb-3">
                <label class="form-label">Project Name</label>
                <input type="text" name="project_name" class="form-control" value="{{ $project->project_name }}">
              </div>
              <div class="mb-3">
                <label class="form-label">Project Description</label>
                <textarea name="project_description" class="form-control">{{ $project->project_description }}</textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Industry Domain</label>
                <input type="text" name="industry_domain" class="form-control" value="{{ $project->industry_domain }}">
              </div>
              <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                  <option value="Active" {{ $project->status === 'Active' ? 'selected' : '' }}>Active</option>
                  <option value="Inactive" {{ $project->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                  <option value="Archived" {{ $project->status === 'Archived' ? 'selected' : '' }}>Archived</option>
                </select>
              </div>
            </div>

            <!-- ================== TECHNOLOGY ================== -->
            <div class="tab-pane fade" id="edit-technology" role="tabpanel">
              <div class="mb-3">
                <label class="form-label">Backend</label>
                <select name="technology_stack[backend][]" class="form-select" multiple>
                  <option value="Node.js" {{ in_array('Node.js', $project->technology_stack->backend ?? []) ? 'selected' : '' }}>Node.js</option>
                  <option value="Laravel" {{ in_array('Laravel', $project->technology_stack->backend ?? []) ? 'selected' : '' }}>Laravel</option>
                  <option value="Django" {{ in_array('Django', $project->technology_stack->backend ?? []) ? 'selected' : '' }}>Django</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Frontend</label>
                <select name="technology_stack[frontend][]" class="form-select" multiple>
                  <option value="React" {{ in_array('React', $project->technology_stack->frontend ?? []) ? 'selected' : '' }}>React</option>
                  <option value="Vue" {{ in_array('Vue', $project->technology_stack->frontend ?? []) ? 'selected' : '' }}>Vue</option>
                  <option value="Angular" {{ in_array('Angular', $project->technology_stack->frontend ?? []) ? 'selected' : '' }}>Angular</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Database</label>
                <select name="technology_stack[database][]" class="form-select" multiple>
                  <option value="MySQL" {{ in_array('MySQL', $project->technology_stack->database ?? []) ? 'selected' : '' }}>MySQL</option>
                  <option value="PostgreSQL" {{ in_array('PostgreSQL', $project->technology_stack->database ?? []) ? 'selected' : '' }}>PostgreSQL</option>
                  <option value="MongoDB" {{ in_array('MongoDB', $project->technology_stack->database ?? []) ? 'selected' : '' }}>MongoDB</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">AI Models</label>
                <input type="text" name="technology_stack[ai_models][]" class="form-control" value="{{ implode(',', $project->technology_stack->ai_models ?? []) }}">
              </div>

              <div class="mb-3">
                <label class="form-label">APIs</label>
                <input type="text" name="technology_stack[apis][]" class="form-control" value="{{ implode(',', $project->technology_stack->apis ?? []) }}">
              </div>
            </div>

            <!-- ================== DATA & SECURITY ================== -->
            <div class="tab-pane fade" id="edit-data" role="tabpanel">
              <div class="mb-3">
                <label class="form-label">Data Storage Location</label>
                <input type="text" name="data_storage_location" class="form-control" value="{{ $project->data_storage_location }}">
              </div>
              <div class="mb-3">
                <label class="form-label">Data Sensitivity</label>
                <select name="data_sensitivity[]" class="form-select" multiple>
                  <option value="PHI" {{ in_array('PHI', $project->data_sensitivity ?? []) ? 'selected' : '' }}>PHI</option>
                  <option value="PII" {{ in_array('PII', $project->data_sensitivity ?? []) ? 'selected' : '' }}>PII</option>
                  <option value="Confidential" {{ in_array('Confidential', $project->data_sensitivity ?? []) ? 'selected' : '' }}>Confidential</option>
                </select>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="audit_logging" {{ $project->audit_logging ? 'checked' : '' }}>
                <label class="form-check-label">Enable Audit Logging</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="user_consent_mechanism" {{ $project->user_consent_mechanism ? 'checked' : '' }}>
                <label class="form-check-label">Require User Consent</label>
              </div>
            </div>

            <!-- ================== COMPLIANCE & AI/ML ================== -->
            <div class="tab-pane fade" id="edit-compliance" role="tabpanel">
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="custom_rules" {{ $project->custom_rules ? 'checked' : '' }}>
                <label class="form-check-label">Custom Rules Applied</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="fairness_transparency_practices" {{ $project->fairness_transparency_practices ? 'checked' : '' }}>
                <label class="form-check-label">Fairness & Transparency Practices</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="has_ai_ml" {{ $project->has_ai_ml ? 'checked' : '' }}>
                <label class="form-check-label">This Project Uses AI/ML</label>
              </div>

              <div class="mb-3">
                <label class="form-label">AI Model Type</label>
                <select name="ai_model_type[]" class="form-select" multiple>
                  <option value="Supervised" {{ in_array('Supervised', $project->ai_model_type ?? []) ? 'selected' : '' }}>Supervised</option>
                  <option value="Unsupervised" {{ in_array('Unsupervised', $project->ai_model_type ?? []) ? 'selected' : '' }}>Unsupervised</option>
                  <option value="Reinforcement" {{ in_array('Reinforcement', $project->ai_model_type ?? []) ? 'selected' : '' }}>Reinforcement</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Training Data Source</label>
                <input type="text" name="training_data_source[]" class="form-control" value="{{ implode(',', $project->training_data_source ?? []) }}">
              </div>

              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="model_monitoring" {{ $project->model_monitoring ? 'checked' : '' }}>
                <label class="form-check-label">Enable Model Monitoring</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="bias_detection" {{ $project->bias_detection ? 'checked' : '' }}>
                <label class="form-check-label">Enable Bias Detection</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="automated_decision_making" {{ $project->automated_decision_making ? 'checked' : '' }}>
                <label class="form-check-label">Automated Decision Making</label>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Project</button>
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

@endpush
@endsection
