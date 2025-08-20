@php
    $controller = DzHelper::controller();
    $page = $action = DzHelper::action();
    $action = $controller.'_'.$action;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- PAGE TITLE HERE -->
	<title> Carlo PEaas|Admin</title>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard" />
	<meta name="author" content="DexignZone" />
	<meta name="robots" content="index, follow" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="@yield('page_description', $page_description ?? '')"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="fasto : sass Admin Dashboard  Bootstrap 5 Laravel Template" />
	<meta property="og:title" content="fasto : sass Admin Dashboard  Bootstrap 5 Laravel Template" />
	<meta property="og:description" content="fasto : sass Admin Dashboard  Bootstrap 5 Laravel Template" />
	<meta property="og:image" content="https://fasto.dexignzone.com/laravel/social-image.png"/>
	<meta name="format-detection" content="telephone=no">

	<!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.jpg')}}">

	@if(!empty(config('dz.public.pagelevel.css.'.$action))) 
        @foreach(config('dz.public.pagelevel.css.'.$action) as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif

    {{-- Global Theme Styles (used by all pages) --}}
    @if(!empty(config('dz.public.global.css'))) 
        @foreach(config('dz.public.global.css') as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif

</head>

<script>
// Global AJAX 401 handler: redirect to login if token is invalid/expired
if (window.jQuery) {
  $(document).ajaxError(function(event, jqxhr) {
    if (jqxhr.status === 401) {
      window.location.href = '/login';
    }
  });
}
// For fetch API (vanilla JS)
window.addEventListener('unhandledrejection', function(event) {
  if (event.reason && event.reason.status === 401) {
    window.location.href = '/login';
  }
});
</script>
<!-- <body class="{{ session('theme', 'light') === 'dark' ? 'bg-dark text-light' : 'bg-light text-dark' }}">

    @stack('scripts') Theme Toggle Styles -->
    <style>
        .dark-theme {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }
        
        .dark-theme .deznav {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
        }
        
        .dark-theme .deznav .metismenu > li > a {
            color: #ffffff !important;
        }
        
        .dark-theme .deznav .metismenu > li > a:hover {
            background-color: #3d3d3d !important;
        }
        
        .dark-theme .header {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
        }
        
        .dark-theme .content-body {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }
        
        .dark-theme .card {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
            border-color: #3d3d3d !important;
        }
        
        .dark-theme .form-control {
            background-color: #3d3d3d !important;
            color: #ffffff !important;
            border-color: #4d4d4d !important;
        }
        
        .dark-theme .form-select {
            background-color: #3d3d3d !important;
            color: #ffffff !important;
            border-color: #4d4d4d !important;
        }
        
        .dark-theme .btn {
            border-color: #4d4d4d !important;
        }
        
        .dark-theme .btn-primary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
        
        .dark-theme .btn-secondary {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
        }
        
        .dark-theme .btn-success {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }
        
        .dark-theme .modal-content {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
        }
        
        .dark-theme .modal-header {
            border-bottom-color: #3d3d3d !important;
        }
        
        .dark-theme .modal-footer {
            border-top-color: #3d3d3d !important;
        }
        
        .dark-theme .nav-tabs .nav-link {
            color: #ffffff !important;
        }
        
        .dark-theme .nav-tabs .nav-link.active {
            background-color: #007bff !important;
            color: #ffffff !important;
        }
        
        .dark-theme .dropdown-menu {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
            border-color: #3d3d3d !important;
        }
        
        .dark-theme .dropdown-item {
            color: #ffffff !important;
        }
        
        .dark-theme .dropdown-item:hover {
            background-color: #3d3d3d !important;
        }
        
        #themeToggle {
            transition: all 0.3s ease;
        }
        
        #themeToggle:hover {
            transform: scale(1.1);
        }
        
        .dark-theme #themeToggle {
            background-color: #007bff !important;
            color: #ffffff !important;
        }
        
        .light-theme #themeToggle {
            background-color: #6c757d !important;
            color: #ffffff !important;
        }
    </style>
    
    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const body = document.body;
            
            // Check for saved theme preference or default to light
            const currentTheme = localStorage.getItem('theme') || 'light';
            body.className = currentTheme === 'dark' ? 'dark-theme' : 'light-theme';
            updateThemeIcon(currentTheme);
            
            themeToggle.addEventListener('click', function() {
                const currentTheme = body.classList.contains('dark-theme') ? 'dark' : 'light';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                // Toggle theme
                body.className = newTheme === 'dark' ? 'dark-theme' : 'light-theme';
                
                // Save to localStorage
                localStorage.setItem('theme', newTheme);
                
                // Update icon
                updateThemeIcon(newTheme);
                
                // Send to server to save in session
                fetch('{{ route("theme.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ theme: newTheme })
                }).catch(error => {
                    console.log('Theme saved locally');
                });
            });
            
            function updateThemeIcon(theme) {
                if (theme === 'dark') {
                    themeIcon.className = 'fas fa-sun';
                    themeToggle.title = 'Switch to Light Mode';
                } else {
                    themeIcon.className = 'fas fa-moon';
                    themeToggle.title = 'Switch to Dark Mode';
                }
            }
        });
    </script>
</body> 
<body class="{{ session('theme', 'light') === 'dark' ? 'dark-theme' : 'light-theme' }}">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
    <a href="{{ url('index') }}" class="brand-logo">
        <img src="{{ asset('images/logo.jpg')}}" alt="Logo" style="height:100px;" />
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		@include('elements.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
		@include('elements.sidebar')	
        <!--**********************************
            Sidebar end
        ***********************************-->
		@php
            $body_class = '';
            if($page == 'ui_button'){ $body_class = 'btn-page';} 
            if($page == 'ui_badge'){ $body_class = 'badge-demo';}
        @endphp
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body {{ $body_class }}">
			@yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

		@stack('modals')

        <!--**********************************
            Footer start
        ***********************************-->
        @include('elements.footer')
        <!--**********************************
            Footer end
        ***********************************-->
	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->


    <!--**********************************
        Scripts
    ***********************************-->
	<!-- Required vendors -->
    @if(!empty(config('dz.public.global.js.top')))
        @foreach(config('dz.public.global.js.top') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.js.'.$action)))
        @foreach(config('dz.public.pagelevel.js.'.$action) as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.global.js.bottom')))
        @foreach(config('dz.public.global.js.bottom') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif

    @stack('scripts')

<!-- -------------------------------------------------------------------------------------------------------------- -->

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
                  <select name="industry_domain"  class="form-select" required>
                    <option value="">Select</option>
                   <option value="Healthcare & MedTech">Healthcare & MedTech</option>
                    <option>Finance</option>
                    <option>Education</option>
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

                   <!-- <style>
                    
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
                   </style> -->
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





















	
</body>
</html>