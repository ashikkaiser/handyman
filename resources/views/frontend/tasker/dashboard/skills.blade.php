@extends('frontend.layouts.tasker')
@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/skill.css" />
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
    <form action="" class="skill-form mt-4" method="POST">
        @csrf
        <div id="form-body">
            <h6 class="badge bg-secondary fst-italic p-3"> If you want to add more skills, please go to your <a
                    class="text-white" href="{{ route('tasker.account') }}" style="font-weight: 400"> Account
                    details</a>
                and add more categories.</h6>
            </h6>
            <h5>Current Skills ({{ count(json_decode($company->business_subcategory)) }})</h5>
            <ul>
                @foreach (json_decode($company->business_subcategory) as $item)
                    <li class="mb-2">{{ $subcategories->find($item)->name }}

                        <a href="{{ route('tasker.removeSkill', $item) }}"> <i class="fas fa-times"
                                style="color: red;cursor:pointer"></i></a>

                        {{-- <button
                            class="btn btn-sm btn-primary">Remove</button> --}}

                    </li>
                @endforeach

            </ul>
            @php
                $subcats = $subcategories->whereIn('parent_id', json_decode($company->business_category))->whereNotIn('id', json_decode($company->business_subcategory));
                //
            @endphp
            <div id="input1" class="form-input-box mt-5">
                <p class="col-md-3">Add a Skill: </p>

                <select name="subcategories" id="" class="form-control" required>
                    <option value="">Select a Skill</option>
                    @foreach ($subcats as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                {{-- <input type="text" name="skill1" placeholder="Add your skill..."> --}}


                {{-- <div onclick="add_more_skill()">Add more skill+</div> --}}
            </div>
        </div>
        <input class="submit-btn" type="submit" value="Add Skill">
    </form>

@endsection

@section('js')
    <script>
        var count = 1;

        function add_more_skill() {
            count += 1;

            var html = `<div id="input${count}" class="form-input-box">
                        <p>Add a Skill: </p>
                        <input type="text" name="skill${count}" placeholder="Add your skill...">
                        <div onclick="add_more_skill()">Add more skill+</div>
                    </div>`

            var form_body = document.getElementById("form-body");

            form_body.innerHTML += html;
        }
    </script>
@endsection
