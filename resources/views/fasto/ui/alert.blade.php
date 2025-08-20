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
                                <th><strong>Category</strong></th>
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
                                                <a class="dropdown-item text-danger ticket-delete" data-id="{{ $ticket['id'] }}" href="javascript:void(0);">Delete</a>
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