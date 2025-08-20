@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<!-- Add Project -->
	<div class="modal fade" id="addProjectSidebar">
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
	</div>
	<div class="project-nav">
		
		<div class="d-flex align-items-center">
			<!-- <a class="add-project-sidebar btn btn-primary" href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#addProjectSidebar" >+ 
         Project</a>
			
			<ul class="grid-tabs nav nav-tabs ms-4">
				<li class="nav-item">
					<a href="#list" class="nav-link active" data-bs-toggle="tab">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.99976 7H19.9998C20.7954 7 21.5585 6.68393 22.1211 6.12132C22.6837 5.55871 22.9998 4.79565 22.9998 4C22.9998 3.20435 22.6837 2.44129 22.1211 1.87868C21.5585 1.31607 20.7954 1 19.9998 1H3.99976C3.20411 1 2.44104 1.31607 1.87844 1.87868C1.31583 2.44129 0.999756 3.20435 0.999756 4C0.999756 4.79565 1.31583 5.55871 1.87844 6.12132C2.44104 6.68393 3.20411 7 3.99976 7Z" fill="#CBCBCB"></path>
						<path d="M19.9998 9H3.99976C3.20411 9 2.44104 9.31607 1.87844 9.87868C1.31583 10.4413 0.999756 11.2044 0.999756 12C0.999756 12.7956 1.31583 13.5587 1.87844 14.1213C2.44104 14.6839 3.20411 15 3.99976 15H19.9998C20.7954 15 21.5585 14.6839 22.1211 14.1213C22.6837 13.5587 22.9998 12.7956 22.9998 12C22.9998 11.2044 22.6837 10.4413 22.1211 9.87868C21.5585 9.31607 20.7954 9 19.9998 9Z" fill="#CBCBCB"></path>
						<path d="M19.9998 17H3.99976C3.20411 17 2.44104 17.3161 1.87844 17.8787C1.31583 18.4413 0.999756 19.2044 0.999756 20C0.999756 20.7956 1.31583 21.5587 1.87844 22.1213C2.44104 22.6839 3.20411 23 3.99976 23H19.9998C20.7954 23 21.5585 22.6839 22.1211 22.1213C22.6837 21.5587 22.9998 20.7956 22.9998 20C22.9998 19.2044 22.6837 18.4413 22.1211 17.8787C21.5585 17.3161 20.7954 17 19.9998 17Z" fill="#CBCBCB"></path>
						</svg>
					</a>
				</li> -->
				<!-- <li class="nav-item">
					<a href="#boxed" class="nav-link" data-bs-toggle="tab">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7.99976 0.999939H3.99976C2.3429 0.999939 0.999756 2.34308 0.999756 3.99994V7.99994C0.999756 9.65679 2.3429 10.9999 3.99976 10.9999H7.99976C9.65661 10.9999 10.9998 9.65679 10.9998 7.99994V3.99994C10.9998 2.34308 9.65661 0.999939 7.99976 0.999939Z" fill="#CBCBCB"></path>
						<path d="M19.9998 0.999939H15.9998C14.3429 0.999939 12.9998 2.34308 12.9998 3.99994V7.99994C12.9998 9.65679 14.3429 10.9999 15.9998 10.9999H19.9998C21.6566 10.9999 22.9998 9.65679 22.9998 7.99994V3.99994C22.9998 2.34308 21.6566 0.999939 19.9998 0.999939Z" fill="#CBCBCB"></path>
						<path d="M7.99976 13H3.99976C2.3429 13 0.999756 14.3431 0.999756 16V20C0.999756 21.6569 2.3429 23 3.99976 23H7.99976C9.65661 23 10.9998 21.6569 10.9998 20V16C10.9998 14.3431 9.65661 13 7.99976 13Z" fill="#CBCBCB"></path>
						<path d="M19.9998 13H15.9998C14.3429 13 12.9998 14.3431 12.9998 16V20C12.9998 21.6569 14.3429 23 15.9998 23H19.9998C21.6566 23 22.9998 21.6569 22.9998 20V16C22.9998 14.3431 21.6566 13 19.9998 13Z" fill="#CBCBCB"></path>
						</svg>
					</a>
				</li> -->
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
                    <li><a class="dropdown-item edit-project" href="#" data-id="{{ $project['id'] }}">Edit</a></li>
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