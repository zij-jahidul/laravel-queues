@component('mail::message')
    # Welcome to Your App, {{ $user->name }}!

    Thank you for registering. We're glad to have you on board!

    @component('mail::button', ['url' => url('/')])
        Visit Your App
    @endcomponent

    Regards,
    Your App Team
@endcomponent
