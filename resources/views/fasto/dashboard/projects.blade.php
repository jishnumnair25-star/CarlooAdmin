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
			<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addOrderModal"  class="btn btn-primary rounded text-white">+ New Project</a>
			<ul class="grid-tabs nav nav-tabs ms-4">
				<li class="nav-item">
					<a href="#list" class="nav-link active" data-bs-toggle="tab">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.99976 7H19.9998C20.7954 7 21.5585 6.68393 22.1211 6.12132C22.6837 5.55871 22.9998 4.79565 22.9998 4C22.9998 3.20435 22.6837 2.44129 22.1211 1.87868C21.5585 1.31607 20.7954 1 19.9998 1H3.99976C3.20411 1 2.44104 1.31607 1.87844 1.87868C1.31583 2.44129 0.999756 3.20435 0.999756 4C0.999756 4.79565 1.31583 5.55871 1.87844 6.12132C2.44104 6.68393 3.20411 7 3.99976 7Z" fill="#CBCBCB"></path>
						<path d="M19.9998 9H3.99976C3.20411 9 2.44104 9.31607 1.87844 9.87868C1.31583 10.4413 0.999756 11.2044 0.999756 12C0.999756 12.7956 1.31583 13.5587 1.87844 14.1213C2.44104 14.6839 3.20411 15 3.99976 15H19.9998C20.7954 15 21.5585 14.6839 22.1211 14.1213C22.6837 13.5587 22.9998 12.7956 22.9998 12C22.9998 11.2044 22.6837 10.4413 22.1211 9.87868C21.5585 9.31607 20.7954 9 19.9998 9Z" fill="#CBCBCB"></path>
						<path d="M19.9998 17H3.99976C3.20411 17 2.44104 17.3161 1.87844 17.8787C1.31583 18.4413 0.999756 19.2044 0.999756 20C0.999756 20.7956 1.31583 21.5587 1.87844 22.1213C2.44104 22.6839 3.20411 23 3.99976 23H19.9998C20.7954 23 21.5585 22.6839 22.1211 22.1213C22.6837 21.5587 22.9998 20.7956 22.9998 20C22.9998 19.2044 22.6837 18.4413 22.1211 17.8787C21.5585 17.3161 20.7954 17 19.9998 17Z" fill="#CBCBCB"></path>
						</svg>
					</a>
				</li>
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


<div class="modal fade" id="addProjectSidebar">
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

        <form method="POST" action="https://carlo.algorethics.ai/api/project/create">
          @csrf
          <div class="tab-content">
            <!-- Basic Info -->
            <div class="tab-pane fade show active" id="basicInfo">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Project Name *</label>
                  <input type="text" name="project_name" class="form-control" value="Healthcare Chatbot Assistant" required>
                </div>
                <div class="col-md-12">
                  <label class="form-label">Project Description *</label>
                  <textarea name="project_description" class="form-control" rows="3" required>An AI assistant specialized in providing healthcare information to medical professionals with HIPAA compliance</textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Subscription ID *</label>
                  <input type="text" name="subscription_id" class="form-control" value="68808950dd13863478ed43b4" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Status *</label>
                  <select name="status" class="form-select" required>
                    <option value="Draft" selected>Draft</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Industry Domain *</label>
                  <select name="industry_domain" class="form-select" required>
                    <option value="Healthcare & MedTech" selected>Healthcare & MedTech</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-primary" type="button" data-bs-target="#technology" data-bs-toggle="tab">Next</button>
              </div>
            </div>

            <!-- Technology -->
            <div class="tab-pane fade" id="technology">
              <h6>Technology Stack</h6>
              <div class="row g-3">
                <div class="col-md-6">
                  <label>Backend Technologies *</label>
                  <select name="backend[]" class="form-select" multiple>
                    <option selected>Node.js</option>
                    <option selected>Express</option>
                    <option selected>MongoDB</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Frontend Technologies</label>
                  <select name="frontend[]" class="form-select" multiple>
                    <option selected>React</option>
                    <option selected>NextJS</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Database Technologies</label>
                  <select name="database[]" class="form-select" multiple>
                    <option selected>MongoDB</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>AI Models</label>
                  <select name="ai_models[]" class="form-select" multiple>
                    <option selected>GPT-4</option>
                    <option selected>Med-PaLM</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>APIs</label>
                  <select name="apis[]" class="form-select" multiple>
                    <option selected>OpenAI API</option>
                    <option selected>Google Med-PaLM API</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Programming Languages</label>
                  <select name="programming_languages[]" class="form-select" multiple>
                    <option selected>JavaScript</option>
                    <option selected>TypeScript</option>
                    <option selected>Python</option>
                  </select>
                </div>
              </div>
              <hr>
              <h6>Infrastructure</h6>
              <div class="row g-3">
                <div class="col-md-6">
                  <label>Deployment Type</label>
                  <input type="text" name="deployment_type" class="form-control" value="Cloud">
                </div>
                <div class="col-md-6">
                  <label>Cloud Provider</label>
                  <select name="cloud_provider[]" class="form-select" multiple>
                    <option selected>AWS</option>
                    <option selected>Azure</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Containerization</label>
                  <select name="containerization[]" class="form-select" multiple>
                    <option selected>Docker</option>
                    <option selected>Kubernetes</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>APIs & Integrations</label>
                  <select name="apis_integrations[]" class="form-select" multiple>
                    <option selected>OpenAI</option>
                    <option selected>Google Cloud Healthcare API</option>
                    <option selected>EHR Integration</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-secondary" type="button" data-bs-target="#basicInfo" data-bs-toggle="tab">Prev</button>
                <button class="btn btn-primary" type="button" data-bs-target="#dataSecurity" data-bs-toggle="tab">Next</button>
              </div>
            </div>

            <!-- Data & Security -->
            <div class="tab-pane fade" id="dataSecurity">
              <h6>Data Sources</h6>
              <div class="row g-3">
                <div class="col-md-4">
                  <label>Structure Type</label>
                  <select name="structure_type[]" class="form-select" multiple>
                    <option selected>Structured</option>
                    <option selected>Unstructured</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Access Type</label>
                  <select name="access_type[]" class="form-select" multiple>
                    <option selected>Private</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Processing Type</label>
                  <select name="processing_type[]" class="form-select" multiple>
                    <option selected>Real-time</option>
                    <option selected>Batch</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Data Storage Location *</label>
                  <input type="text" name="data_storage_location" class="form-control" value="Cloud-based" required>
                </div>
                <div class="col-md-6">
                  <label>Data Sensitivity</label>
                  <select name="data_sensitivity[]" class="form-select" multiple>
                    <option selected>PHI</option>
                    <option selected>PII</option>
                  </select>
                </div>
              </div>
              <hr>
              <h6>Security</h6>
              <div class="row g-3">
                <div class="col-md-3">
                  <label>Data Encryption</label>
                  <input type="checkbox" name="data_encryption" class="form-check-input" checked>
                </div>
                <div class="col-md-6">
                  <label>Access Control</label>
                  <select name="access_control[]" class="form-select" multiple>
                    <option selected>Role-based</option>
                    <option selected>Multi-factor authentication</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Audit Logging</label>
                  <input type="checkbox" name="audit_logging" class="form-check-input" checked>
                </div>
                <div class="col-md-6">
                  <label>User Consent Mechanism</label>
                  <input type="checkbox" name="user_consent_mechanism" class="form-check-input" checked>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-secondary" type="button" data-bs-target="#technology" data-bs-toggle="tab">Prev</button>
                <button class="btn btn-primary" type="button" data-bs-target="#compliance" data-bs-toggle="tab">Next</button>
              </div>
            </div>

            <!-- Compliance & AI/ML -->
            <div class="tab-pane fade" id="compliance">
              <h6>Compliance</h6>
              <div class="mb-3">
                <label>Compliance Standards</label>
                <select name="compliance_standards[]" class="form-select" multiple>
                  <option selected>HIPAA</option>
                  <option selected>GDPR</option>
                  <option selected>EU AI Act</option>
                </select>
              </div>
              <div class="form-check form-switch">
                <input name="bias_risk_factors" class="form-check-input" type="checkbox" checked>
                <label class="form-check-label">Bias Risk Factors Identified</label>
              </div>
              <div class="form-check form-switch">
                <input name="fairness_transparency_practices" class="form-check-input" type="checkbox" checked>
                <label class="form-check-label">Fairness & Transparency Practices</label>
              </div>
              <div class="form-check form-switch">
                <input name="compliance_consultation" class="form-check-input" type="checkbox" checked>
                <label class="form-check-label">Compliance Consultation</label>
              </div>
              <hr>
              <h6>AI & ML</h6>
              <div class="form-check form-switch">
                <input name="has_ai_ml" class="form-check-input" type="checkbox" checked>
                <label class="form-check-label">Has AI/ML Components</label>
              </div>
              <div class="form-check form-switch">
                <input name="webhooks_notifications" class="form-check-input" type="checkbox" checked>
                <label class="form-check-label">Webhooks & Notifications</label>
              </div>
              <div class="form-check form-switch">
                <input name="custom_rules" class="form-check-input" type="checkbox" checked>
                <label class="form-check-label">Custom Rules</label>
              </div>
              <div class="form-check form-switch">
                <input name="third_party_plugins" class="form-check-input" type="checkbox">
                <label class="form-check-label">Third Party Plugins</label>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-secondary" type="button" data-bs-target="#dataSecurity" data-bs-toggle="tab">Prev</button>
                <button class="btn btn-success" type="submit">Create Project</button>
              </div>
            </div>
          </div>
        </form>
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
</style>

	
	<div class="tab-content">	
		<div class="tab-pane fade active show" id="list">
			<div class="tab-content project-list-group" id="ListViewTabLink">	
				<div class="tab-pane fade active show" id="navpills-1">

@section('content')
<div class="d-flex flex-wrap gap-2 mb-4" id="projectTabs">
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

<ul class="nav nav-pills mb-3 gap-2" id="projectTabs">
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
        @foreach($projects as $project)
            <div class="card mb-3 project-card" data-status="{{ strtolower($project['status'] ?? 'unknown') }}">
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
                                <img src="{{ asset('images/projects/Untitled-1.jpg') }}" alt="" class="me-2" width="40">
                                <div>
                                    <small>Industry</small>
                                    <div class="fw-semibold">{{ $project['industry_domain'] ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Tech Stack -->
                        <div class="col-md-2 mb-2">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/projects/Untitled-2.jpg') }}" alt="" class="me-2" width="40">
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
                                    <li><a class="dropdown-item" href="#">Edit</a></li>
                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#projectTabs .nav-link');
    const cards = document.querySelectorAll('.project-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const selectedStatus = this.getAttribute('data-status');

            cards.forEach(card => {
                if (selectedStatus === 'all' || card.dataset.status === selectedStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

</script>
@endpush
  





					<!-- <div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<p class="text-primary mb-2">#P-000441425</p>
								<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Redesign Kripton Mobile App</a></h4>
								<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-1.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Alex Noer</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-2.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Yoast Esec</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-warning light status-btn">Pending</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">View</a>
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- <div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<div>
									<p class="text-primary mb-2">#P-000441425</p>
									<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Build Branding Persona for Etza.id</a></h4>
									<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-3.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Kevin Sigh</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-4.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Yuri Hanako</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-info light status-btn">ON PRORESS</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<p class="text-primary mb-2">#P-000441425</p>
								<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Reduce Website Page Size Omah</a></h4>
								<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-5.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Endge Aes</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-6.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Peter Parkur</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-danger light status-btn">CLOSED</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<p class="text-primary mb-2">#P-000441425</p>
								<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Manage SEO for Eclan Company P..</a></h4>
								<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-7.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Angela Moss</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-8.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Olivia Jonson</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-info light status-btn">ON PROGERSS</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<div>
									<p class="text-primary mb-2">#P-000441425</p>
									<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Redesign Kripton Mobile App</a></h4>
									<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-9.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Tiffany</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-10.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Bella Sirait</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-warning light status-btn">Pending</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
				<!-- <div class="tab-pane fade" id="navpills-2">
					<div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<div>
									<p class="text-primary mb-2">#P-000441425</p>
									<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Manage SEO for Eclan Company P..</a></h4>
									<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-7.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Angela Moss</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-8.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Olivia Jonson</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-info light status-btn">ON PROGERSS</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<div>
									<p class="text-primary mb-2">#P-000441425</p>
									<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Build Branding Persona for Etza.id</a></h4>
									<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-3.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Kevin Sigh</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-4.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Yuri Hanako</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-info light status-btn">ON PRORESS</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="navpills-3">
					<div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<div>
									<p class="text-primary mb-2">#P-000441425</p>
									<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Redesign Kripton Mobile App</a></h4>
									<div class="text-dark"><i class="fa fa-calendar-o me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-9.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Tiffany</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-10.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Bella Sirait</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-warning light status-btn">Pending</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<div>
									<p class="text-primary mb-2">#P-000441425</p>
									<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Redesign Kripton Mobile App</a></h4>
									<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-1.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Alex Noer</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-2.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Yoast Esec</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-warning light status-btn">Pending</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="navpills-4">
					<div class="card">
						<div class="project-info">
							<div class="col-xl-3 col-xxl-3 my-2 col-lg-4 col-sm-6">
								<div>
									<p class="text-primary mb-2">#P-000441425</p>
									<h4 class="title font-w600 mb-3"><a href="{{ url('post-details')}}" class="text-black">Reduce Website Page Size Omah</a></h4>
									<div class="text-dark"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-5.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Client</span>
										<h5 class="mb-0 pt-1 fs-18 font-w50 text-black">Endge Aes</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-4 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="project-media">
										<img src="{{ asset('images/projects/Untitled-6.jpg')}}" alt="">
									</div>
									<div class="ms-3">
										<span>Person in charge</span>
										<h5 class="mb-0 pt-1 fs-18 font-w500 text-black">Peter Parkur</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-3 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex align-items-center">
									<div class="power-ic">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="ms-3">
										<span>Deadline</span>
										<h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
									</div>
								</div>
							</div>
							<div class="col-xl-2 my-2 col-xxl-3 col-lg-6 col-sm-6">
								<div class="d-flex project-status align-items-center">
									<a  href="javascript:void(0);" class="btn btn-danger light status-btn">CLOSED</a>
									<div class="dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div>	
		</div>
		<!-- <div class="tab-pane fade" id="boxed">
			<div class="tab-content" id="BoxedViewTabLink">
				<div class="tab-pane fade show active" id="boxed_navpills-1">
					<div class="row">
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-info">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-primary">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-warning">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-danger">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-info">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="boxed_navpills-2">
					<div class="row">
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-info">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-info">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="boxed_navpills-3">
					<div class="row">
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-warning">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-warning">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-warning">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-warning">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="boxed_navpills-4">
					<div class="row">
						<div class="col-xl-3 col-xxl-4">
							<div class="card project-boxed">
								<div class="img-bx">
									<img src="{{ asset('images/big/img1.jpg')}}" alt="" class="w-100 ">
									<span class="badge badge-danger">Progress</span>
								</div>
								<div class="card-header align-items-start">
									<div>
										<p class="fs-14 mb-2 text-primary">#P-000441425</p>
										<h6 class="fs-18 font-w500 mb-3">
											<a href="javascript:void(0);" class="text-black user-name">Build Branding Persona for Etza.id</a>
										</h6>
										<div class="text-dark fs-14 text-nowrap">
											<i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>
											Created on Sep 8th, 2020
										</div>
									</div>
									<div class="dropdown">
										<a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body p-0 pb-3">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">
											<span class="mb-0 title">Deadline</span> :
											<span class="text-black ml-2">Monday, Sep 26th 2020</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Client</span> :
											<span class="text-black ml-2">Kevin Sigh</span>
										</li>
										<li class="list-group-item">
											<span class="mb-0 title">Person in charge</span> :
											<span class="text-black desc-text ml-2">Yuri Hanako</span>
										</li>
									</ul>
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

@push('scripts')
<script>
	jQuery('a[data-bs-toggle="tab"]').on('shown.bs.tab',function(e){
		var hrefTarget = jQuery(this).attr('href');
		if(hrefTarget == '#boxed'){
			jQuery('#BoxedViewTabLink').removeClass('d-none');
			jQuery('#ListViewTabLink').addClass('d-none');
			
		}else if(hrefTarget == '#list'){
			jQuery('#ListViewTabLink').removeClass('d-none');
			jQuery('#BoxedViewTabLink').addClass('d-none');
		}
		
	});
</script>
@endpush