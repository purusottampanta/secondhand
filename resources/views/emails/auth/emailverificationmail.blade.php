@component('mail::message')
# Dear {{ $user->getFirstNameAttribute() }},

Please! click the button below to confirm your email address.

@component('mail::button', ['url' => route('auth.confirm', $user->confirmation_code)])
confirm
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent