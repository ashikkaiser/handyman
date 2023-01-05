@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/account.css" />
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Multi Column with Form Separator -->
                <div class="col-md-12">
                    <div class="card mb-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif
                        <h5 class="card-header title">Edit User</h5>
                        <form class="card-body" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="row g-3">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        class="form-control" required placeholder="Name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                                        class="form-control" required placeholder="Email" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                                        class="form-control" required placeholder="Phone" />
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="post_code">Post code</label>
                                    <input type="text" name="post_code" id="post_code" value="{{ $user->post_code }}"
                                        class="form-control" required placeholder="Post Code" />
                                    @if ($errors->has('post_code'))
                                        <span class="text-danger">{{ $errors->first('post_code') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Role</label>
                                    <input type="text" name="role" id="role" value="{{ $user->role }}"
                                        class="form-control" required placeholder="Role" />
                                    @if ($errors->has('role'))
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="stripe_id">Stripe </label>
                                    <input type="text" name="stripe_id" id="stripe_id" value="{{ $user->stripe_id }}"
                                        class="form-control" placeholder="stripe id" />
                                    @if ($errors->has('stripe_id'))
                                        <span class="text-danger">{{ $errors->first('stripe_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password">password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="password" />
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>




                            </div>

                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 submitButton">Submit</button>
                                {{-- <button type="button" class="btn btn-warning me-sm-3 me-1 resetButton">Reset</button> --}}
                            </div>
                        </form>
                    </div>
                </div>


                <!--/ Activity Timeline -->
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
