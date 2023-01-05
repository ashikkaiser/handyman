@extends('frontend.layouts.tasker')
@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="assets/css/skill.css" />
    <style>
        .member-card {
            width: 60% !important;
            margin: 0 auto;
        }

        .member-btn-box button {
            border: none;
            padding: 10px 15px;
            background-color: #204746;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
        }

        @media only screen and (max-width: 490px) {
            .member-card {
                width: 95% !important;
                margin: 20px auto;
            }
        }
    </style>
@endsection
@section('page_title', 'My Skills')

@section('content')
    @forelse ($savedJobs as $item)
        <div class="single-comment">
            <div class="comment-content-box">

                <div class="comment-content">
                    <h5>{{ $item->subcategory->name }}</h5>
                    <h6>Name : {{ $item->name }}</h6>
                    <p class="pb-3">{{ $item->post_code }}</p>
                    <p class="reviews pb-3">{{ $item->description }}</p>
                    <div class="comment-button">
                        @if (checkIsApplied($item->id))
                            <button class="btn btn-success" style="background-color: red">
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
            <div class="heart-icon">
                <a href="javascript:void(0)" onclick="saveJob({{ $item->id }})"><i
                        class="fas fa-heart fs-1 on-hover-heart" style="color: #204746"></i></a>
            </div>

        </div>
    @empty
        <div class="single-comment">
            <div class="comment-content-box">
                <div class="comment-content">
                    <h5>No Saved Jobs</h5>
                </div>
            </div>
        </div>
    @endforelse

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

@endsection
