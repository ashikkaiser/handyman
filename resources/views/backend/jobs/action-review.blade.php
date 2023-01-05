@if ($review->published == false)
    <button href="" onclick="reviewApprove({{ $review->id }})" class="btn btn-sm btn-primary me-2"><i
            class="fas fa-check"></i></button>
    <button class="btn btn-sm btn-info me-2 edit-modal" review_id="{{ $review->id }}" data-bs-toggle="modal"
        data-bs-target="#editModal"><i class="fas fa-pen"></i></button>
    <button class="btn btn-sm btn-warning me-2 review-modal" review_id="{{ $review->id }}" data-bs-toggle="modal"
        data-bs-target="#reviewModal"><i class="fas fa-eye"></i></button>
    <button onclick="reviewDelete({{ $review->id }})" class="btn btn-sm btn-danger me-2"><i
            class="fas fa-times"></i></button>
@endif
@if ($review->published == true)
    <button class="btn btn-sm btn-info me-2 edit-modal" review_id="{{ $review->id }}" data-bs-toggle="modal"
        data-bs-target="#editModal"><i class="fas fa-pen"></i></button>
    <button class="btn btn-sm btn-warning me-2 review-modal" review_id="{{ $review->id }}" data-bs-toggle="modal"
        data-bs-target="#reviewModal"><i class="fas fa-eye"></i></button>
    <button onclick="reviewDelete({{ $review->id }})" class="btn btn-sm btn-danger me-2"><i
            class="fas fa-times"></i></button>
@endif
