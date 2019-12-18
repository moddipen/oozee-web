@component('mail::message')
    # Hello!

    {{ $message }}

    Thanks,
    {{ config('app.name') }}
@endcomponent