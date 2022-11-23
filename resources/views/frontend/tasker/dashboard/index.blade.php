@extends('frontend.layouts.tasker')
@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <style>
        .rate-input-box input,
        .rate-input-box textarea {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #204746;
            border-radius: 5px;
            padding: 15px 25px;
            resize: none;
        }

        .rate-input-box input:focus,
        .rate-input-box textarea:focus {
            outline: none;
            box-shadow: none;

        }
    </style>
@endsection
@section('page_title', 'Dashboard')

@section('content')
    <h5 class="text-black mt-4 text-center">Recently posted jobs that fit your skills
    </h5>

    @forelse ($jobs as $item)
        <div class="single-comment">
            <div class="comment-content-box">

                <div class="comment-content">
                    <h5>{{ $item->subcategory->name }}</h5>
                    <h6>Name : {{ $item->name }}</h6>
                    {{-- <h6>Email : {{ $item->email }}</h6> --}}
                    <p class="pb-3">{{ $item->post_code }}</p>
                    <p class="reviews pb-3">{{ $item->description }}</p>
                    <div class="comment-button">
                        @if (checkIsApplied($item->id))
                            <button class="btn btn-success" style="background-color: #204746">
                                <i class="fas fa-check"></i>You Have Already Sent Your Proposal
                            </button>
                        @else
                            @if (creditCalculation() > 0)
                                <button onclick="applyModal({{ $item }})">
                                    <img src="/assets/images/elc/icon2.gif" alt="">Send a
                                    quote ({{ creditCalculation() }} Left)
                                </button>
                            @else
                                <a href="{{ route('tasker.credits') }}">
                                    <img src="/assets/images/elc/icon2.gif" alt=""> Insufficient Credit(Top Up)
                                </a>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
            @php
                $saved = false;
                foreach ($savedJobs as $savedJob) {
                    if ($savedJob->id == $item->id) {
                        $saved = true;
                    }
                }
            @endphp
            @if ($saved)
                <div class="heart-icon">
                    <a href="javascript:void(0)" onclick="saveJob({{ $item->id }})"><i
                            class="fas fa-heart fs-1 on-hover-heart" style="color: #204746"></i></a>
                </div>
            @else
                <div class="heart-icon">
                    <a href="javascript:void(0)" onclick="saveJob({{ $item->id }})"><i
                            class="fas fa-heart fs-1 on-hover-heart"></i></a>
                </div>
            @endif
        </div>
    @empty
        <div class="single-comment">
            <div class="comment-content-box">

                <div class="comment-content items-center">

                    <p class="pb-3"></p>
                    <p class="reviews pb-3 "> No jobs found that fit your skills</p>

                </div>
            </div>


        </div>
    @endforelse


    <!-- Modal -->
    <div class="modal fade" id="applyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" id="applySendForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="applyModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">Description: <span class="jobDescription"></span></p>
                        <input type="hidden" name="job_id" class="job_id">
                        <div class="rate-input-box">
                            <textarea name="cover_letter" id="cover_letter" cols="33" rows="10" class="form-control"
                                placeholder="Cover Letter" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class=" btn tasker-btn">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>
        function saveJob(id) {
            $.ajax({
                url: '/save-job/' + id,
                type: 'GET',
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <script>
        var myToastEls = document.getElementById('javaToast')
        var tost = new bootstrap.Toast(myToastEls)

        function applyModal(job) {
            $('#applyModal').modal('show');
            $('#applyModalLabel').html('Send Quote to ' + job.name);
            $('.jobDescription').html(job.description);
            $('.job_id').val(job.id);
        }

        $('#applySendForm').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: "{{ route('tasker.applyJob') }}",
                type: "POST",
                data: data,

                success: function(data) {
                    swal(data.title, data.success, data?.type ? 'success' : 'error');


                    tost.show();
                    $("#javaToastMessage").html(data.success);
                    $('#applyModal').modal('hide');
                    if (data.redirect) {
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }

                    // myToast.show()
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
