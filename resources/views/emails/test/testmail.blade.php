@component('mail::message')
# SMTP Test

Engr. Paul,

Calm down! Software Engineers are not magicians.

Anyways, this is an automated message. Your SMTP works now!

Congratulations!

@component('mail::button', ['url' => 'https://stratt.ng'])
Go to Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent