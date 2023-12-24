@component('mail::message')
    # Welcome to New Member, {{ $user->name }}!

    Thank you for registering. We're glad to have you on board!

    @component('mail::button', ['url' => url('/')])
        Visit New Member
    @endcomponent

    Regards,
    New Member Team
@endcomponent
