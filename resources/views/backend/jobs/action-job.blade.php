@if ($job->status == 'pending')
    <button href="" onclick="jobApprove({{ $job->id }})" class="btn btn-sm btn-primary me-2"><i
            class="fas fa-check"></i></button>
    <button class="btn btn-sm btn-warning me-2 job-modal" job_id="{{ $job->id }}" data-bs-toggle="modal"
        data-bs-target="#jobModal"><i class="fas fa-eye"></i></button>
    <button onclick="jobDelete({{ $job->id }})" class="btn btn-sm btn-danger me-2"><i
            class="fas fa-times"></i></button>
@endif
@if ($job->status == 'approved')
    <button class="btn btn-sm btn-warning me-2 job-modal" job_id="{{ $job->id }}" data-bs-toggle="modal"
        data-bs-target="#jobModal"><i class="fas fa-eye"></i></button>
    <button onclick="jobDelete({{ $job->id }})" class="btn btn-sm btn-danger me-2"><i
            class="fas fa-times"></i></button>
@endif
