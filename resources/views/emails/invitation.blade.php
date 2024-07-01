<x-mail::message>
{{ __('bz-user-management::bz-user-management.invite_mail.You have been invited to join') }} {{ config('app.name') }}

{{ __('bz-user-management::bz-user-management.invite_mail.To accept the invitation - click on the button below and create an account:') }}

<x-mail::button :url="$acceptUrl">
    {{ __('bz-user-management::bz-user-management.invite_mail.Create Account') }}
</x-mail::button>

{{ __('bz-user-management::bz-user-management.invite_mail.If you did not expect to receive an invitation to this app, you may discard this email') }}
</x-mail::message>
