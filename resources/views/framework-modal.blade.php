<h3>{{ $framework['name'] ?? 'N/A' }}</h3>
<span class="badge bg-secondary">{{ ucfirst($framework['status']) }}</span>

<div class="row mt-4">
    <div class="col-md-6">
        <h5>Description</h5>
        <p>{{ $framework['description'] ?? 'No description available.' }}</p>
    </div>

    <div class="col-md-6">
        <h5>Framework Details</h5>
        <ul class="list-unstyled">
            <li><strong>Version:</strong> {{ $framework['version'] ?? '-' }}</li>
            <li><strong>Created By:</strong> {{ $framework['user_username'] ?? '-' }}</li>
        </ul>
    </div>
</div>

@if (!empty($framework['governance_frameworks']))
    <h5 class="mt-4">Governance Frameworks</h5>
    @foreach ($framework['governance_frameworks'] as $gf)
        <span class="badge bg-primary me-1">{{ $gf }}</span>
    @endforeach
@endif

@if (!empty($framework['custom_rules']))
    <h5 class="mt-4">Custom Rules</h5>
    @foreach ($framework['custom_rules'] as $rule)
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between">
                <strong>{{ $rule['name'] }}</strong>
                <span class="badge bg-danger">{{ ucfirst($rule['severity']) }}</span>
            </div>
            <div class="card-body">
                <p>{{ $rule['description'] }}</p>
                <p><strong>Category:</strong> {{ $rule['category'] }}</p>
                <p><strong>Keywords:</strong>
                    @foreach ($rule['keywords'] as $kw)
                        <span class="badge bg-secondary">{{ $kw }}</span>
                    @endforeach
                </p>
            </div>
        </div>
    @endforeach
@endif