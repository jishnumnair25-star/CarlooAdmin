

@extends('layouts.default')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <a class="dropdown-item" href="#">Accept User Framework</a>
                    <a class="dropdown-item" href="#">Reject Order</a>
                    <a class="dropdown-item" href="#">View Details</a>
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
        <div class="text-center">
          <div class="spinner-border" role="status"></div>
        </div>
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
                if (response.html) {
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
                                <option value="Published">Published</option>
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
        e.preventDefault(); // stop page refresh

        var form = this;
        var formData = new FormData(form);

        $.ajax({
            url: form.action,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                alert('Framework created successfully!');
                $('#userFrameworkModal').modal('hide');
                location.reload(); // Reload table/list
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseText);
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
                    <input type="text" name="custom_rules[${ruleIndex}][severity]" class="form-control" value="Low">
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
