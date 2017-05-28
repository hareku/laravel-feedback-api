@component('mail::message')
# Received a feedback

Feedback ID: {{ $feedback->id }}

Feedback created at: {{ $feedback->created_at }}

@component('mail::panel')
{{ $feedback->message }}
@endcomponent

@endcomponent
