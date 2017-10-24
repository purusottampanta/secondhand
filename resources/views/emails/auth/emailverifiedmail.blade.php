@component('mail::message')
# Congratulations

You have successfully completed our registration process. Please! click the button below to login to {{ config('app.name') }} .

@component('mail::button', ['url' => '/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
