@component('mail::message')
# {{ $details['title'] }}

{{ $details['body'] }}


@if(isset( $details['button']))
@component('mail::button', ['url' => $details['url']])
{{ $details['button'] }}
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
