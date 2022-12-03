@extends('emails.layouts.app')
@section('title', $details['title'])

@if (isset($details['cover_letter']))
    @section('name', $details['user']->name)
    @section('bodyCompany', $details['company']->business_name)
    @section('phone', $details['company']->business_phone)

    @section('company')
        @include('emails.layouts.company', [
            'company' => $details['company'],
        ])
    @endsection
    @section('mailBody')
        @include('emails.layouts.taskerBody', [
            'name' => $details['user']->name,
            'bodyCompany' => $details['company']->business_name,
            'phone' => $details['company']->business_phone,
        ])
    @endsection
    @section('feedback')
        @include('emails.layouts.feedback')
    @endsection
@endif
@if (isset($details['jobuser']))

    @section('company')
        @include('emails.layouts.user', [
            'user' => $details['jobuser'],
        ])
    @endsection
@endif

@if (isset($details['myself']))
    @section('mailBody')
        @include('emails.layouts.jobnotify', [
            'name' => $details['user']->name,
            'bodyCompany' => $details['body'],
            'link' => route('login'),
            'linkText' => 'Login',
        ])
    @endsection
@endif
