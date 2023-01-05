<form action="{{ route('admin.reviews.modify') }}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Edit Review Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="id" value="{{ $review->id ?? '' }}">
                <input type="hidden" name="user_id" value="{{ $review->user_id ?? '' }}">
                <input type="hidden" name="company_id" value="{{ $review->company_id ?? '' }}">
                <input type="hidden" name="category_id" value="{{ $review->category_id ?? '' }}">
                <div class="mb-3">
                    <label class="form-label">USER NAME</label>
                    <input type="text" class="form-control" placeholder="{{ $review->user->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">COMPANY NAME</label>
                    <input type="text" class="form-control" placeholder="{{ $review->company->business_name }}"
                        readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">CATEGORY NAME</label>
                    <input type="text" class="form-control" placeholder="{{ $review->category->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">REVIEW TITLE</label>
                    <input type="text" class="form-control" name="review_title"
                        value="{{ $review->review_title ? $review->review_title : 'N/A' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">REVIEW</label>
                    {{-- <input type="text" class="form-control" placeholder="{{ $review->review }}"> --}}
                    <textarea class="form-control" rows="3" name="review">{{ $review->review }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">PHONE</label>
                    <input type="text" class="form-control" name="phone" value="{{ $review->phone }}">
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Workmanship</label>
                        <input type="text" class="form-control" name="workmanship"
                            value="{{ $review->workmanship }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tidiness</label>
                        <input type="text" class="form-control" name="tidiness" value="{{ $review->tidiness }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Reliability</label>
                        <input type="text" class="form-control" name="reliability"
                            value="{{ $review->reliability }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Courtesy</label>
                        <input type="text" class="form-control" name="courtesy" value="{{ $review->courtesy }}">
                    </div>
                </div>

            </div>


        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-label-primary">
            Save
        </button>
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
            Close
        </button>
    </div>
</form>
