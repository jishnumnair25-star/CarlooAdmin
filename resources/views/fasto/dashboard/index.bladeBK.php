@extends('layouts.default')
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    {{ $errors->first() }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<meta name="access-token" content="{{ session('access_token') }}">
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	
 

<!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css"> -->
<!-- -----------------------------------Creating the project ------------------------------------------------- -->
<!-- Inside your Blade file -->

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
       
 <form method="POST" action="{{ route('projects.store') }}">
    @csrf

    <!-- Subscription -->
    <div class="mb-3">
        <label for="subscription_id" class="form-label">Subscription</label>
      <select name="subscription_id" class="form-select" required>
    <option value="">Select Subscription</option>
  
</select>

    </div>

    <!-- Project Name -->
    <div class="mb-3">
        <label for="project_name" class="form-label">Project Name</label>
        <input type="text" name="project_name" class="form-control" required>
    </div>

    <!-- Project Description -->
    <div class="mb-3">
        <label for="project_description" class="form-label">Project Description</label>
        <textarea name="project_description" class="form-control" required></textarea>
    </div>

    <!-- Industry Domain -->
    <div class="mb-3">
        <label for="industry_domain" class="form-label">Industry Domain</label>
        <select name="industry_domain" class="form-select" required>
            <option value="">Select</option>
            <option value="Finance & Banking">Finance & Banking</option>
            <option value="Healthcare & MedTech">Healthcare & MedTech</option>
            <option value="Legal & Compliance">Legal & Compliance</option>
            <option value="Retail & E-commerce">Retail & E-commerce</option>
            <option value="Government & Public Sector">Government & Public Sector</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- Technology -->
    <div class="mb-3">
        <label for="ai_models" class="form-label">AI Models</label>
        <input type="text" name="technology_stack[ai_models]" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="apis" class="form-label">APIs</label>
        <input type="text" name="technology_stack[apis]" class="form-control" required>
    </div>

    <!-- Infrastructure -->
    <div class="mb-3">
        <label for="deployment_type" class="form-label">Deployment Type</label>
        <select name="infrastructure[deployment_type]" class="form-select" required>
            <option value="">Select</option>
            <option value="On-Premises">On-Premises</option>
            <option value="Cloud-based">Cloud-based</option>
            <option value="Hybrid">Hybrid</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="structure_type" class="form-label">Structure Type</label>
        <select name="infrastructure[structure_type]" class="form-select" required>
            <option value="">Select</option>
            <option value="Monolithic">Monolithic</option>
            <option value="Microservices">Microservices</option>
            <option value="Serverless">Serverless</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="access_type" class="form-label">Access Type</label>
        <select name="infrastructure[access_type]" class="form-select" required>
            <option value="">Select</option>
            <option value="Public">Public</option>
            <option value="Private">Private</option>
            <option value="Restricted">Restricted</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="processing_type" class="form-label">Processing Type</label>
        <select name="infrastructure[processing_type]" class="form-select" required>
            <option value="">Select</option>
            <option value="Batch">Batch</option>
            <option value="Real-time">Real-time</option>
            <option value="Near real-time">Near real-time</option>
        </select>
    </div>

    <!-- Bias/Risk -->
    <div class="mb-3">
        <label class="form-label">Bias / Risk Factors</label><br>
        <input type="checkbox" name="bias_risk_factors[identified]" value="1" id="bias_identified">
        <label for="bias_identified">Bias Identified?</label>
    </div>

    <div class="mb-3">
        <label for="bias_description" class="form-label">Bias Risk Description</label>
        <textarea name="bias_risk_factors[description]" class="form-control"></textarea>
    </div>

    <!-- Status -->
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="Draft">Draft</option>
            <option value="Pending Review">Pending Review</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            <option value="Archived">Archived</option>
        </select>
    </div>

    <!-- Submit -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Create Project</button>
    </div>
</form>


<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Submission and Navigation Script -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll('#projectTabs .nav-link');
    const panes = document.querySelectorAll('.tab-pane');
    let current = 0;

    const showTab = i => {
      tabs.forEach((tab, idx) => {
        tab.classList.toggle("active", i === idx);
        panes[idx].classList.toggle("show", i === idx);
        panes[idx].classList.toggle("active", i === idx);
      });
      current = i;
    };

    document.querySelectorAll('.next-btn').forEach(btn => btn.addEventListener("click", () => {
      if (current < tabs.length - 1) showTab(current + 1);
    }));

    document.querySelectorAll('.prev-btn').forEach(btn => btn.addEventListener("click", () => {
      if (current > 0) showTab(current - 1);
    }));

    document.getElementById("dataEncryptionToggle").addEventListener("change", function () {
      document.getElementById("encryptionTypeContainer").style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById("biasToggle").addEventListener("change", function () {
      document.getElementById("biasRiskDescriptionContainer").style.display = this.checked ? 'block' : 'none';
    });



    // Handle form submission
//    document.querySelector(".create-btn").addEventListener("click", async function (e) {
//   e.preventDefault();

//   const form = document.getElementById("createProjectForm");

//   const getMulti = name => Array.from(form.querySelectorAll(`[name="${name}[]"] option:checked`)).map(o => o.value);

//   const payload = {
//     subscription_id: form.subscription_id.value,
//     project_name: form.project_name.value,
//     project_description: form.project_description.value,
//     industry_domain: form.industry_domain.value,
//         technology_stack: {
//           backend: getMulti("backend"),
//           frontend: getMulti("frontend"),
//           database: getMulti("database"),
//           ai_models: getMulti("ai_models"),
//           apis: getMulti("apis")
//         },
//         programming_languages: getMulti("programming_languages"),
//         infrastructure: {
//           deployment_type: form.deployment_type.value,
//           cloud_provider: getMulti("cloud_provider"),
//           containerization: getMulti("containerization")
//         },
//         apis_integrations: getMulti("apis_integrations"),
//         data_sources: {
//           structure_type: getMulti("structure_type"),
//           access_type: getMulti("access_type"),
//           processing_type: getMulti("processing_type")
//         },
//         data_storage_location: form.data_storage_location.value,
//         data_sensitivity: getMulti("data_sensitivity"),
//         data_encryption: {
//           enabled: form.data_encryption.checked,
//           type: form.encryption_type?.value || null
//         },
//         access_control: getMulti("access_control"),
//         audit_logging: form.audit_logging?.checked || false,
//         user_consent_mechanism: form.user_consent_mechanism?.checked || false,
//         compliance_standards: getMulti("compliance_standards"),
//         bias_risk_factors: {
//           identified: form.bias_risk_factors?.checked || false,
//           description: form.bias_risk_description?.value || null
//         },
//         fairness_transparency_practices: form.fairness_transparency_practices?.checked || false,
//         has_ai_ml: form.has_ai_ml?.checked || false,
//         ai_model_type: getMulti("ai_model_type"),
//         training_data_source: getMulti("training_data_source"),
//         model_monitoring: form.model_monitoring?.checked || false,
//         bias_detection: form.bias_detection?.checked || false,
//         automated_decision_making: form.automated_decision_making?.checked || false,
//         webhooks_notifications: form.webhooks_notifications?.checked || false,
//         custom_rules: form.custom_rules?.checked || false,
//         third_party_plugins: form.third_party_plugins?.checked || false,
//         compliance_consultation: form.compliance_consultation?.checked || false,
//         status: form.status.value
//   };

//   try {
//     const response = await fetch("/submit-project", {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
//       },
//       body: JSON.stringify(payload)
//     });

//     const result = await response.json();

//     if (result.success) {
//       alert("Project created successfully!");
//       window.location.href = "/projects"; // ✅ redirect to project list
//     } else {
//       alert("Error creating project: " + result.error);
//     }
//   } catch (error) {
//     console.error("Request failed:", error);
//     alert("Unexpected error occurred.");
//   }
// });
  });
</script>
<!-- -------------------------------------------------End Model--------------------------------------------------------------------- -->








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
	<!-- <div class="row">
		<div class="col-xl-6 col-xxl-12">
			<div class="card">
				<div class="card-header d-block border-0 pb-0">
					<div class="d-flex justify-content-between pb-3">
						<h4 class="mb-0 text-black fs-20">Project Created</h4>
						<div class="dropdown">
							<a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</a>
							<div class="dropdown-menu dropdown-menu-left">
								<a class="dropdown-item" href="javascript:void(0);">Edit</a>
								<a class="dropdown-item" href="javascript:void(0);">Delete</a>
							</div>
						</div>
					</div>
					<div class="d-flex align-items-center">
						<span class="fs-36 text-black font-w600 me-4">25%</span>
						<div>
							<svg class="me-2" width="27" height="14" viewBox="0 0 27 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0 13.435L13.435 0L26.8701 13.435H0Z" fill="#2FCA51"></path>
							</svg>
							<span>last month $563,443</span>
						</div>
					</div>
				</div>
				<div class="card-body pb-0 px-2 pt-2">
					<div id="chartTimeline" class="timeline-chart"></div>
				</div>
			</div>		
		</div>
		<div class="col-xl-3 col-xxl-6 col-sm-6">
			<div class="card">	
				<div class="card-header border-0 pb-0">
					<h4 class="fs-20 mb-0 text-black">New Clients</h4>
					<div class="dropdown">
						<a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</a>
						<div class="dropdown-menu dropdown-menu-left">
							<a class="dropdown-item" href="javascript:void(0);">Edit</a>
							<a class="dropdown-item" href="javascript:void(0);">Delete</a>
						</div>
					</div>
				</div>
				<div class="card-body text-center pb-0 px-2 pt-2">
					<div id="widgetChart1" class="widgetChart1 dashboard-chart"></div>
				</div>
			</div>
		</div>		
		<div class="col-xl-3 col-xxl-6 col-sm-6">
			<div class="card">	
				<div class="card-header border-0 pb-0">
					<h4 class="fs-20 mb-0 text-black">Monthly Target</h4>
					<div class="dropdown">
						<a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</a>
						<div class="dropdown-menu dropdown-menu-left">
							<a class="dropdown-item" href="javascript:void(0);">Edit</a>
							<a class="dropdown-item" href="javascript:void(0);">Delete</a>
						</div>
					</div>
				</div>
				<div class="card-body text-center pt-0">
					<div id="radialChart" class="monthly-project-chart"></div>
					<span class="fs-14 text-black d-block op5">100 Projects/ monthy</span>
				</div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-xl-6 col-xxl-12">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">	
						<div class="card-header border-0">
							<h4 class="fs-16 text-black font-w500">Project Released</h4>
							<div class="d-flex align-items-center">
								<svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.90735e-06 0.499999L7 7.5L14 0.5" fill="#FF6746"/>
								</svg>
								<span class="fs-28 font-w600 ms-2 text-black">4%</span>
							</div>
						</div>
						<div class="card-body text-center pb-0 p-0">
							<div id="widgetChart2" class="dashboard-chart"></div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body text-center d-flex align-items-center justify-content-between">
							<div class="d-inline-block position-relative donut-chart-sale">
								<span class="donut1" data-peity='{ "fill": ["rgb(67, 220, 128, 1)", "rgba(241, 241, 241,1)"],   "innerRadius": 33, "radius": 10}'>3/8</span>
								<small class="text-primary">29%</small>
							</div>
							<div>
								<h2 class="fs-28 font-w600 mb-0 text-end text-black">567</h2>
								<p class="mb-0 fs-14 font-w400 text-black">Contacts Added</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12">
					<div class="card message-bx">
						<div class="card-header border-0 d-sm-flex d-block pb-0">
							<div>
								<h4 class="fs-20 mb-0  text-black mb-sm-0 mb-2">Recent Messages</h4>
							</div>
							<a href="{{ url('contacts')}}" class="btn btn-primary shadow-primary btn-rounded text-white">+ New Message</a>
						</div>
						<div class="card-body">
							<div class="media mb-3 pb-3 border-bottom">
								<div class="image-bx me-sm-4 me-2">
									<img src="{{ asset('images/profile/Untitled-1.jpg')}}" alt="" class="rounded-circle img-1">
									<span class="active"></span>
								</div>
								<div class="media-body d-sm-flex justify-content-between d-block align-items-center">
									<div class="me-sm-3 me-0">
										<h6 class="fs-16 font-w600 mb-sm-2 mb-0"><a href="{{ url('messages')}}" class="text-black">Laura Chyan</a></h6>
										<p class="text-black mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
										<span class="fs-14">5m ago</span>
									</div>
								</div>
							</div>
							<div class="media mb-3 pb-3 border-bottom">
								<div class="image-bx me-sm-4 me-2">
									<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle img-1">
								</div>
								<div class="media-body d-sm-flex justify-content-between d-block align-items-center">
									<div class="me-sm-3 me-0">
										<h6 class="fs-16 font-w600 mb-sm-2 mb-0"><a href="{{ url('messages')}}" class="text-black">Olivia Rellaq</a></h6>
										<p class="text-black mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
										<span class="fs-14">41m ago</span>
									</div>
								</div>
							</div>
							<div class="media">
								<div class="image-bx me-sm-4 me-2">
									<img src="{{ asset('images/profile/Untitled-3.jpg')}}" alt="" class="rounded-circle img-1">
									<span class="active"></span>
								</div>
								<div class="media-body d-sm-flex justify-content-between d-block align-items-center">
									<div class="me-sm-3 me-0">
										<h6 class="fs-16 font-w600 mb-sm-2 mb-0"><a href="{{ url('messages')}}" class="text-black">Keanu Tipes</a></h6>
										<p class="text-black mb-1">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum...</p>
										<span class="fs-14">25m ago</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-xxl-12">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header border-0 pb-0">
							<div class="me-2">
								<h4 class="fs-20 mb-0 font-w500 text-black">Upcoming Projects</h4>
							</div>
						</div>
						<div class="card-body">
							<div class="border-bottom up-project-bx pb-4 mb-4">
								<span class="fs-16 text-primary mb-2 d-block sub-title font-w500">Yoast Esac</span>
								<div class="d-flex">
									<p class="font-w500 me-auto mb-2 title fs-20"><a href="{{ url('post-details')}}" class="text-black">Redesign Kripton Mobile App</a></p>
									<div class="dropdown mb-3">
										<a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-left">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="mb-3"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								<div class="media align-items-center">
									<div class="power-ic me-3">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="media-body">
										<p class="mb-1">Deadline</p>
										<span class="text-black font-w600">Tuesday,  Sep 29th 2020</span>
									</div>
								</div>
							</div>
							<div class="border-bottom up-project-bx pb-4 mb-4">
								<span class="fs-16 text-primary mb-2 d-block sub-title font-w500">Yoast Esac</span>
								<div class="d-flex">
									<p class="font-w500 me-auto title mb-2 fs-20"><a href="{{ url('post-details')}}" class="text-black">Build Branding Persona for Etza.id</a></p>
									<div class="dropdown mb-3">
										<a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-left">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="mb-3"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								<div class="media align-items-center">
									<div class="power-ic me-3">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="media-body">
										<p class="mb-1">Deadline</p>
										<span class="text-black font-w600">Tuesday,  Sep 29th 2020</span>
									</div>
								</div>
							</div>
							<div class="up-project-bx">
								<span class="fs-16 text-primary sub-title mb-2 d-block font-w500">Yoast Esac</span>
								<div class="d-flex">
									<p class="font-w500 me-auto title mb-2 fs-20"><a href="{{ url('post-details')}}" class="text-black">Manage SEO for Eclan Company Profile</a></p>
									<div class="dropdown mb-3">
										<a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 	6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<div class="dropdown-menu dropdown-menu-left">
											<a class="dropdown-item" href="javascript:void(0);">Edit</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<div class="mb-3"><i class="far fa-calendar me-3" aria-hidden="true"></i>Created on Sep 8th, 2020</div>
								<div class="media align-items-center">
									<div class="power-ic me-3">
										<i class="fa fa-bolt" aria-hidden="true"></i>
									</div>
									<div class="media-body">
										<p class="mb-1">Deadline</p>
										<span class="text-black font-w600">Tuesday,  Sep 29th 2020</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card kanbanPreview-bx">
						<div class="card-body">
							<div class="sub-card bg-secondary d-flex text-white">
								<div class="me-auto pe-2">
									<h4 class="fs-20 mb-0 font-w600 text-white">Quick To-Do List</h4>
									<span class="fs-14 op6 font-w200">Lorem ipsum dolor sit amet</span>
								</div>
								<a href="{{ url('contacts')}}" class="plus-icon"><i class="fa fa-plus" aria-hidden="true"></i></a>
							</div>
							<div class="sub-card">
								<span class="text-warning sub-title fs-14">Graphic Deisgner</span>
								<p class="font-w500"><a href="{{ url('post-details')}}" class="text-black">Visual Graphic for Presentation to Client</a></p>
								<div class="row justify-content-between align-items-center">
									<div class="col-6">
										<span>Aug 4, 2021</span>
									</div>
									<ul class="users col-6">
										<li><img src="{{ asset('images/profile/Untitled-4.jpg')}}" alt=""></li>
										<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
										<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
										<li><img src="{{ asset('images/profile/Untitled-7.jpg')}}" alt=""></li>
									</ul>
									
								</div>
							</div>
							<div class="sub-card">
								<span class="text-primary sub-title fs-14">Database Engineer</span>
								<p class="font-w500"><a href="{{ url('post-details')}}" class="text-black">Build Database Design for Fasto Admin v2</a></p>
								<div class="row justify-content-between align-items-center">
									<div class="col-6">
										<span>Aug 4, 2021</span>
									</div>
									<ul class="users col-6">
										<li><img src="{{ asset('images/profile/Untitled-4.jpg')}}" alt=""></li>
										<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
										<li><img src="{{ asset('images/profile/Untitled-6.jpg')}}" alt=""></li>
									</ul>
								</div>
							</div>
							<div class="sub-card">
								<span class="text-secondary sub-title fs-14">Digital Marketing</span>
								<p class="font-w500"><a href="{{ url('post-details')}}" class="text-black">Make Promotional Ads for Instagram Fasto’s</a></p>
								<div class="row justify-content-between align-items-center mb-4">
									<div class="col-6">
										<span>Aug 4, 2021</span>
									</div>
									<ul class="users col-6">
										<li><img src="{{ asset('images/profile/Untitled-4.jpg')}}" alt=""></li>
										<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
										<li><img src="{{ asset('images/profile/Untitled-6.jpg')}}" alt=""></li>
									</ul>
								</div>
								<span><i class="far fa-comment me-2"></i>2 Comment</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
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
        <h5>Performance Line Chart</h5>
        <canvas id="lineChart"></canvas>
      </div>
      <div class="card p-3">
        <div class="d-flex justify-content-between">
          <h5>Market Overview</h5>
          <button class="btn btn-outline-dark btn-sm">This Month</button>
        </div>
        <h3>$36,2531.00 <span class="text-success">(+1.37%)</span></h3>
        <canvas id="barChart"></canvas>
      </div>
      <div class="card p-3 text-center">
        <h5>Enhance your <strong>Campaign</strong> for better outreach</h5>
       <a href="{{ url('ui-card')}}"> <button class="btn btn-primary mt-3">Upgrade Account</button></a>
      </div>
     <div class="card p-3">
  <h5>Recent Compliance Activity</h5>
  <div class="d-flex justify-content-end mb-2">
    <button class="btn btn-primary btn-sm">+ Add new member</button>
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
        <h5>Type By Amount</h5>
        <canvas id="donutChart"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  // Line Chart
  new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
      labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
      datasets: [{
        label: 'This week',
        borderColor: '#2563eb',
        data: [60, 80, 70, 90, 65, 85, 78],
        fill: false,
      }, {
        label: 'Last week',
        borderColor: '#94a3b8',
        data: [40, 60, 50, 70, 55, 65, 60],
        fill: false,
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { labels: { color: '#0f172a' } } },
      scales: {
        x: { ticks: { color: '#0f172a' } },
        y: { ticks: { color: '#0f172a' } }
      }
    }
  });

  // Bar Chart
  new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV'],
      datasets: [
        { label: 'Last week', backgroundColor: '#cbd5e1', data: [200, 220, 180, 260, 240, 200, 210, 220, 230, 250, 270] },
        { label: 'This week', backgroundColor: '#2563eb', data: [210, 230, 200, 270, 260, 210, 220, 230, 250, 270, 290] }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { labels: { color: '#0f172a' } } },
      scales: {
        x: { ticks: { color: '#0f172a' } },
        y: { ticks: { color: '#0f172a' } }
      }
    }
  });

  // Donut Chart
  new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
      labels: ['Total', 'Not Met', 'Grades A', 'Grades B'],
      datasets: [{
        backgroundColor: ['#2563eb', '#ef4444', '#10b981', '#f59e0b'],
        data: [40, 20, 25, 15]
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { labels: { color: '#0f172a' } } }
    }
  });
});
</script>
</div>
@endsection

@push('scripts')
	
@endpush