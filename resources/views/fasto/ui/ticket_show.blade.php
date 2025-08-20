@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header"><h5 class="card-title">Ticket Information</h5></div>
        <div class="card-body">
          <div class="row mb-2"><div class="col-4">Ticket ID:</div><div class="col-8">{{ $ticket['id'] ?? $ticket['_id'] ?? '' }}</div></div>
          <div class="row mb-2"><div class="col-4">Subject:</div><div class="col-8">{{ $ticket['subject'] ?? '' }}</div></div>
          <div class="row mb-2"><div class="col-4">Department:</div><div class="col-8">{{ $ticket['department']['name'] ?? $ticket['department'] ?? 'Unknown' }}</div></div>
          <div class="row mb-2"><div class="col-4">Status:</div><div class="col-8"><span class="badge bg-secondary">{{ $ticket['status'] ?? 'Unknown' }}</span></div></div>
          <div class="row mb-2"><div class="col-4">Priority:</div><div class="col-8">{{ $ticket['priority']['name'] ?? $ticket['priority'] ?? 'Unknown' }}</div></div>
          <div class="row mb-2"><div class="col-4">Created:</div><div class="col-8">{{ isset($ticket['created_at']) ? \Carbon\Carbon::parse($ticket['created_at'])->format('n/j/Y, g:i:s A') : '' }}</div></div>
          <div class="mt-3"><strong>Description</strong><div class="mt-2">{!! nl2br(e($ticket['description'] ?? $ticket['contents'] ?? '')) !!}</div></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header"><h5 class="card-title">Conversation History</h5></div>
        <div class="card-body">
          @forelse($messages as $msg)
            <div class="mb-3">
              <div class="text-muted small">{{ $msg['author'] ?? ($msg['user']['name'] ?? 'Support Agent') }} — {{ isset($msg['created_at']) ? \Carbon\Carbon::parse($msg['created_at'])->format('n/j/Y, g:i:s A') : '' }}</div>
              <div class="mt-1">{!! nl2br(e($msg['message'] ?? $msg['contents'] ?? '')) !!}</div>
              @if (!empty($msg['attachments']) && is_array($msg['attachments']))
                <div class="mt-2">
                  <strong>Attachments</strong>
                  <ul class="list-unstyled mb-0">
                    @foreach ($msg['attachments'] as $att)
                      <li>
                        <a href="{{ $att['url'] ?? '#' }}" target="_blank">{{ $att['name'] ?? basename($att['url'] ?? '') }}</a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          @empty
            <div class="text-muted">No conversation yet.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header"><h5 class="card-title">Add Reply</h5></div>
        <div class="card-body">
          <form action="{{ route('tickets.reply', ['id' => $ticket['id'] ?? $ticket['_id'] ?? '']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label">Message</label>
              <textarea name="message" class="form-control" rows="4" placeholder="Type your reply here..."></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Attachments (Optional)</label>
              <input type="file" name="attachments[]" class="form-control" multiple />
            </div>
            <button type="submit" class="btn btn-primary">Submit Reply</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


