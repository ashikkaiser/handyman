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
    <h5 class="text-black mt-4 text-center">Your Documents</h5>
    @php
        $documents = json_decode($company->bin_images);
    @endphp

    @forelse ($documents as $item)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if ($company->verified == 1)
                        @php
                            $documents = json_decode($company->bin_images);
                        @endphp
                        @foreach ($documents as $item)
                            <h4 class="text-center text-success">Your Documents have been verified.</h4>
                            <div class="col-md-6">
                                <div class="">
                                    <div>
                                        <img src="/{{ $item }}" width="100%" style="border-radius: 10px">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <form action="{{ route('tasker.uploadDoc') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h4 class="text-center text-danger">Awaiting Approval.</h4>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Upload your Document</label>
                                    <div id="bin_images" class="row"></div>
                                </div>
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('tasker.uploadDoc') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Upload your Document</label>
                                <div id="uploadimage" class="row"></div>
                            </div>
                            <button class="btn btn-primary">Upload</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endforelse
@endsection


@section('js')
    <script src="/assets/js/upload.js"></script>

    <script>
        $("#bin_images").spartanMultiImagePicker({
            fieldName: 'bin_images[]',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-4',
            maxFileSize: '',
            dropFileLabel: "Drop Here",
            placeholderImage: {
                image: '/{{ json_decode($company->bin_images)[0] ?? '' }}',
                width: '100%',
                height: '100%'
            },
        });
        $("#uploadimage").spartanMultiImagePicker({
            fieldName: 'bin_images[]',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-4',
            maxFileSize: '',
            dropFileLabel: "Drop Here",
        });
    </script>
@endsection
