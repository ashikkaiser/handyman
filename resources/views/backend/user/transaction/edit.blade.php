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
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif
                        <h5 class="card-header title">Edit Transaction</h5>
                        <form class="card-body" method="POST" action="{{ route('admin.transactions.update',$transaction->id) }}">
                            @method('PUT')
                          
                            @csrf
                            <input type="hidden" name="id">
                            <div class="row g-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_name">Transaction ID</label>
                                    <input type="text" name="transaction_id" id="transaction_id" value="{{ $transaction->transaction_id }}" class="form-control" required
                                        placeholder="transaction id" />
                                    @if ($errors->has('transaction_id'))
                                        <span class="text-danger">{{ $errors->first('transaction_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="receipt_url">Recipt Url</label>
                                    <input type="url" name="receipt_url" id="receipt_url" value="{{ $transaction->receipt_url }}" class="form-control" required
                                        placeholder="Receipt url" />
                                    @if ($errors->has('receipt_url'))
                                        <span class="text-danger">{{ $errors->first('receipt_url') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{ $transaction->email }}" class="form-control" required
                                        placeholder="Email" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{ $transaction->phone }}" class="form-control" required
                                        placeholder=" Phone" />
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $transaction->name }}" class="form-control" required
                                        placeholder="name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label" for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" value="{{ $transaction->amount }}" class="form-control" required
                                        placeholder="Amount" />
                                    @if ($errors->has('amount'))
                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
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
