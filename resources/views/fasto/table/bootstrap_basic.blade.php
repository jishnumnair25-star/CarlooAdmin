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
                <p class="mb-0">Your business dashboard template</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Bootstrap</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Subscription</h4>
                </div>
                <div class="d-flex  align-items-center flex-wrap mb-3 px-3">
   
@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Subscription</h4>
        </div>

        <!-- <style>
            .btn-purple {
    background-color: #8e44ad;
    border-color: #8e44ad;
    color: #fff;
}
.btn-purple:hover {
    background-color: #732d91;
    border-color: #732d91;
}
        </style> -->

        <div class="card-body">

            <!-- Filter Form -->
            <form method="GET" class="d-flex flex-wrap gap-2 align-items-center mb-4">
                <!-- Search -->
                <div class="input-group" style="max-width: 280px;">
                    <input type="text" name="search" class="form-control" placeholder="Search subscriptions..." value="{{ request('search') }}">
                    <button class="btn btn-light border-start" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

                <!-- Status Dropdown -->
                <div>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>

                <!-- Plan Dropdown -->
                <div>
                    <select name="plan" class="form-select" onchange="this.form.submit()">
                        <option value="">All Plans</option>
                        <option value="seed" {{ request('plan') == 'seed' ? 'selected' : '' }}>Seed</option>
                        <option value="grow" {{ request('plan') == 'grow' ? 'selected' : '' }}>Grow</option>
                        <option value="enterprise" {{ request('plan') == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                    </select>
                </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th><strong>Ward No.</strong></th>
                            <th><strong>Plan</strong></th>
                            <th><strong>Amount</strong></th>
                            <th><strong>Projects</strong></th>
                            <th><strong>Status</strong></th>
                            <th><strong>Auto Renew</strong></th>
                            <th><strong>Payment Method</strong></th>
                            <th><strong>Next Payment</strong></th>
                            <th><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions as $index => $item)
                            @php $sub = $item['subscription']; @endphp
                            <tr>
                                <td><strong>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</strong></td>
                                <td><span class="w-space-no">{{ $sub['pricing_tier'] }}</span></td>
                                <td>${{ $sub['amount'] }} / {{ $sub['billing_cycle'] }}</td>
                                <td>{{ $sub['project_count'] ?? 'N/A' }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($sub['status'] === 'active')
                                            <i class="fa fa-circle text-success me-1"></i> Successful
                                        @elseif($sub['status'] === 'pending')
                                            <i class="fa fa-circle text-warning me-1"></i> Pending
                                        @else
                                            <i class="fa fa-circle text-danger me-1"></i> Cancelled
                                        @endif
                                    </div>
                                </td>
                                <td>Enabled</td>
                                <td>{{ $sub['payment_method'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($sub['next_payment_date'])->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        
                                        @php
                                            $subscriptionId = isset($sub['subscription_id']) ? $sub['subscription_id'] : (isset($sub['id']) ? $sub['id'] : null);
                                        @endphp
                                        @if(!empty($subscriptionId))
                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-subscription-btn" data-subscription-id="{{ $subscriptionId }}"><i class="fa fa-trash text-white"> delete</i></a>
                                        @endif
@php
$token = session('access_token');
@endphp
<script>
const SUBSCRIPTION_API_TOKEN = @json($token);
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-subscription-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this subscription?')) return;
            const subId = btn.getAttribute('data-subscription-id');
            btn.disabled = true;
            fetch('https://carlo.algorethics.ai/api/subscription/' + subId, {
                method: 'DELETE',
                headers: {
                    ...(SUBSCRIPTION_API_TOKEN ? { 'Authorization': 'Bearer ' + SUBSCRIPTION_API_TOKEN } : {})
                }
            })
            .then(res => res.json())
            .then(data => {
                console.log('Delete API response:', data);
                if (data.success) {
                    // Remove the row from the table
                    const row = btn.closest('tr');
                    if (row) row.remove();
                } else {
                    alert('Failed to delete subscription.');
                    btn.disabled = false;
                }
            })
            .catch((err) => {
                console.error('Delete API error:', err);
                alert('Error connecting to subscription service.');
                btn.disabled = false;
            });
        });
    });
});
</script>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center">No subscriptions found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection






        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Kolor Tea Shirt For Man</td>
                                    <td><span class="badge badge-primary light">Sale</span>
                                    </td>
                                    <td>January 22</td>
                                    <td class="color-primary">$21.56</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Kolor Tea Shirt For Women</td>
                                    <td><span class="badge badge-success">Tax</span>
                                    </td>
                                    <td>January 30</td>
                                    <td class="color-success">$55.32</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Blue Backpack For Baby</td>
                                    <td><span class="badge badge-danger">Extended</span>
                                    </td>
                                    <td>January 25</td>
                                    <td class="color-danger">$14.85</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Striped</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Kolor Tea Shirt For Man</td>
                                    <td><span class="badge badge-primary">Sale</span>
                                    </td>
                                    <td>January 22</td>
                                    <td class="color-primary">$21.56</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Kolor Tea Shirt For Women</td>
                                    <td><span class="badge badge-success light">Tax</span>
                                    </td>
                                    <td>January 30</td>
                                    <td class="color-success">$55.32</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Blue Backpack For Baby</td>
                                    <td><span class="badge badge-danger">Extended</span>
                                    </td>
                                    <td>January 25</td>
                                    <td class="color-danger">$14.85</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Bordered</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Kolor Tea Shirt For Man</td>
                                    <td><span class="badge badge-primary">Sale</span>
                                    </td>
                                    <td>January 22</td>
                                    <td class="color-primary">$21.56</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Kolor Tea Shirt For Women</td>
                                    <td><span class="badge badge-success">Tax</span>
                                    </td>
                                    <td>January 30</td>
                                    <td class="color-success">$55.32</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Blue Backpack For Baby</td>
                                    <td><span class="badge badge-danger">Extended</span>
                                    </td>
                                    <td>January 25</td>
                                    <td class="color-danger">$14.85</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Hover</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Kolor Tea Shirt For Man</td>
                                    <td><span class="badge badge-primary light">Sale</span>
                                    </td>
                                    <td>January 22</td>
                                    <td class="color-primary">$21.56</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Kolor Tea Shirt For Women</td>
                                    <td><span class="badge badge-success">Tax</span>
                                    </td>
                                    <td>January 30</td>
                                    <td class="color-success">$55.32</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Blue Backpack For Baby</td>
                                    <td><span class="badge badge-danger light">Extended</span>
                                    </td>
                                    <td>January 25</td>
                                    <td class="color-danger">$14.85</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Hover Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table header-border table-hover verticle-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Popularity</th>
                                    <th scope="col">Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Air Conditioner</td>
                                    <td>
                                        <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                            <div class="progress-bar" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-primary light">70%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Textiles</td>
                                    <td>
                                        <div class="progress" style="background: rgba(76, 175, 80, .1)">
                                            <div class="progress-bar bg-success" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-success">70%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Milk Powder</td>
                                    <td>
                                        <div class="progress" style="background: rgba(70, 74, 83, .1)">
                                            <div class="progress-bar bg-dark" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-dark light">70%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <td>Vehicles</td>
                                    <td>
                                        <div class="progress" style="background: rgba(255, 87, 34, .1)">
                                            <div class="progress-bar bg-danger" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-danger">70%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>5</th>
                                    <td>Boats</td>
                                    <td>
                                        <div class="progress" style="background: rgba(255, 193, 7, .1)">
                                            <div class="progress-bar bg-warning" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-warning">70%</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bordered Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Deadline</th>
                                    <th scope="col">Label</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Air Conditioner</td>
                                    <td>
                                        <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                            <div class="progress-bar bg-primary" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Apr 20,2018</td>
                                    <td><span class="badge badge-primary light">70%</span>
                                    </td>
                                    <td>
                                        <span>
                                            <a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a>
                                            <a href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Textiles</td>
                                    <td>
                                        <div class="progress" style="background: rgba(76, 175, 80, .1)">
                                            <div class="progress-bar bg-success" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>May 27,2018</td>
                                    <td><span class="badge badge-success">70%</span>
                                    </td>
                                    <td><span><a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a><a
                                                href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Milk Powder</td>
                                    <td>
                                        <div class="progress" style="background: rgba(70, 74, 83, .1)">
                                            <div class="progress-bar bg-dark" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>May 18,2018</td>
                                    <td><span class="badge badge-dark light">70%</span>
                                    </td>
                                    <td><span><a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a><a
                                                href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vehicles</td>
                                    <td>
                                        <div class="progress" style="background: rgba(255, 87, 34, .1)">
                                            <div class="progress-bar bg-danger" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Mar 27,2018</td>
                                    <td><span class="badge badge-danger">70%</span>
                                    </td>
                                    <td><span><a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a><a
                                                href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Boats</td>
                                    <td>
                                        <div class="progress" style="background: rgba(255, 193, 7, .1)">
                                            <div class="progress-bar bg-warning" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jun 28,2018</td>
                                    <td><span class="badge badge-warning">70%</span>
                                    </td>
                                    <td><span><a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a><a
                                                href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Stripped</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Deadline</th>
                                    <th scope="col">Label</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Air Conditioner</td>
                                    <td>
                                        <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                            <div class="progress-bar bg-primary" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Apr 20,2018</td>
                                    <td><span class="badge badge-primary">70%</span>
                                    </td>
                                    <td><span><a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a><a
                                                href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Textiles</td>
                                    <td>
                                        <div class="progress" style="background: rgba(76, 175, 80, .1)">
                                            <div class="progress-bar bg-success" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>May 27,2018</td>
                                    <td><span class="badge badge-success">70%</span>
                                    </td>
                                    <td><span><a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a><a
                                                href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Milk Powder</td>
                                    <td>
                                        <div class="progress" style="background: rgba(70, 74, 83, .1)">
                                            <div class="progress-bar bg-dark" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>May 18,2018</td>
                                    <td><span class="badge badge-dark">70%</span>
                                    </td>
                                    <td><span><a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a><a
                                                href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Boats</td>
                                    <td>
                                        <div class="progress" style="background: rgba(255, 193, 7, .1)">
                                            <div class="progress-bar bg-warning" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jun 28,2018</td>
                                    <td><span class="badge badge-warning">70%</span>
                                    </td>
                                    <td><span><a href="javascript:void()" class="me-4" data-bs-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fas fa-pencil-alt color-muted"></i> </a><a
                                                href="javascript:void()" data-bs-toggle="tooltip"
                                                data-placement="top" title="Close"><i
                                                    class="fas fa-times"></i></a></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Responsive Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table header-border table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="javascript:void(0)">Order #26589</a>
                                    </td>
                                    <td>Herman Beck</td>
                                    <td><span class="text-muted">Oct 16, 2017</span>
                                    </td>
                                    <td>$45.00</td>
                                    <td><span class="badge badge-success">Paid</span>
                                    </td>
                                    <td>EN</td>
                                </tr>
                                <tr>
                                    <td><a href="javascript:void(0)">Order #58746</a>
                                    </td>
                                    <td>Mary Adams</td>
                                    <td><span class="text-muted">Oct 12, 2017</span>
                                    </td>
                                    <td>$245.30</td>
                                    <td><span class="badge badge-info light">Shipped</span>
                                    </td>
                                    <td>CN</td>
                                </tr>
                                <tr>
                                    <td><a href="javascript:void(0)">Order #98458</a>
                                    </td>
                                    <td>Caleb Richards</td>
                                    <td><span class="text-muted">May 18, 2017</span>
                                    </td>
                                    <td>$38.00</td>
                                    <td><span class="badge badge-danger">Shipped</span>
                                    </td>
                                    <td>AU</td>
                                </tr>
                                <tr>
                                    <td><a href="javascript:void(0)">Order #32658</a>
                                    </td>
                                    <td>June Lane</td>
                                    <td><span class="text-muted">Apr 28, 2017</span>
                                    </td>
                                    <td>$77.99</td>
                                    <td><span class="badge badge-success">Paid</span>
                                    </td>
                                    <td>FR</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Heading With Background</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-info">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Primary Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table primary-table-bordered">
                            <thead class="thead-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Primary Table Hover</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table primary-table-bg-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                <tr>
                                    <th>5</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                <tr>
                                    <th>5</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contextual Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table header-border" style="min-width: 500px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Column heading</th>
                                    <th>Column heading</th>
                                    <th>Column heading</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-active">
                                    <td>1</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-primary">
                                    <td>1</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-success">
                                    <td>2</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-info">
                                    <td>3</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-warning">
                                    <td>4</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-danger">
                                    <td>5</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection